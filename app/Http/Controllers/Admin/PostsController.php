<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Events\PostUpdated;
use Carbon\Carbon;
use App\Posts;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostsController extends MainAdminController{

public function __construct(){

    parent::__construct();

}


public function features(){

    return view('_admin.pages.posts')->with([
        'title' => trans('admin.FeaturesPosts'),
        'desc' => '',
        'type' => 'features',
        'pagetype' => 'featured_at'
        ]);

}
public function unapprove(){

    return view('_admin.pages.posts')->with([
        'title' => trans('admin.Posts'), 
        'desc' => '', 
        'type' => 'all',
        'pagetype' => 'created_at'
        ]);

}
public function all(){

    return view('_admin.pages.posts')->with([
        'title' => trans('admin.AllPosts'), 
        'desc' => '', 
        'type' => 'all',
        'pagetype' => 'created_at'
        ]);

}
public function showcatposts($name){

    $cats = Categories::where('name_slug', $name)->first();

    if(!$cats){
        return redirect()->back();
    }

    return view('_admin.pages.posts')->with([
        'title' => $cats->name, 
        'desc' => $cats->name, 
        'type' => $cats->type,
        'pagetype' => 'created_at'
        ]);

}


public function approvepost($id){

    $post = Posts::findOrFail($id);

    if($post->approve == 'no'){
        $post->approve = 'yes';
        $post->save();

        try{
            event(new PostUpdated($post, trans('admin.approved')));
        }catch(\Exception $e){

        }


    }else{
        $post->approve = 'no';
        $post->save();

    }

    \Session::flash('success.message', trans('admin.approved'));

    return redirect()->back();

}

public function showhomepage($id){

    $post = Posts::findOrFail($id);

    if($post->show_in_homepage == null){

        $post->show_in_homepage = 'yes';

    }else{
        $post->show_in_homepage = null;
    }

    $post->save();

    \Session::flash('success.message', trans('admin.ChangesSaved'));

    return redirect()->back();

}

public function pickfeatured($id){

    $post = Posts::findOrFail($id);

    if($post->featured_at == null){

        $post->featured_at = Carbon::now();

    }else{
        $post->featured_at = null;
    }

    $post->save();

    \Session::flash('success.message', trans('admin.ChangesSaved'));

    return redirect()->back();

}

public function sendtrashpost($id){
    $post = Posts::withTrashed()->findOrFail($id);

    if($post->deleted_at == null){
        $post->approve = 'no';
        $post->delete();
    }else{
        $post->approve = 'yes';
        $post->restore();
    }

    try{
        event(new PostUpdated($post, 'Trash'));

    }catch(Exception $e){

    }



    \Session::flash('success.message', trans('admin.ChangesSaved'));

    return redirect()->back();

}

public function forcetrashpost($id){

    $post = Posts::withTrashed()->where('id', $id)->first();

    foreach($post->entry as $entr){

        if($entr->type == 'image'){

            \File::delete(public_path() .'/upload/media/entries/'.$entr->image);

        }
        $entr->forceDelete(); //del entry
    }

    \File::delete(public_path() .'/upload/media/posts/'.$post->thumb.'-b.jpg');
    \File::delete(public_path() .'/upload/media/posts/'.$post->thumb.'-s.jpg');

    $post->forceDelete();

    \Session::flash('success.message', trans('admin.Deletedpermanently'));

    return redirect()->back();

}


/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function getdata(Request $request){

    $typew = $request->query('type');
    $type = $typew;



    $only = $request->query('only');


    $post = Posts::leftJoin('users', 'posts.user_id', '=', 'users.id');
    $post->select('posts.*');

    if($typew == 'all'){
//not set
    }elseif($typew !== 'features'){
        $post->where('type', $type);
    }else{
        $post->where('featured_at', '>', '');
    }

    if($only == 'deleted'){
        $post->onlyTrashed();
        
    }else{
        $post->where('deleted_at', null);
    }


    if($only == 'unapprove'){
        $post->where('approve', 'no');
    }

    return Datatables::of($post)

    ->addColumn('thumb', function ($post) {

        return view('._admin._particles.datatable.postlist.thumb', compact('post'))->render();

    })->addColumn('title', function ($post) {

        return view('._admin._particles.datatable.postlist.title', compact('post'))->render();

    })->addColumn('user', function ($post) {

        return view('._admin._particles.datatable.postlist.user', compact('post'))->render();

    })->addColumn('approve', function ($post) {

        return view('._admin._particles.datatable.postlist.approve', compact('post'))->render();

    })->addColumn('created_at', function ($post) {

        return view('._admin._particles.datatable.postlist.created_at', compact('post'))->render();

    })->addColumn('action', function ($post) {

        return view('._admin._particles.datatable.postlist.action', compact('post'))->render();

    })->make(true);

}



}