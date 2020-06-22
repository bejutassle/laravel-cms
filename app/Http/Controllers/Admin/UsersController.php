<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UsersController extends MainAdminController{

    public function __construct(Request $request){

        if((NULL !== $request->query('userlock')) || (NULL !== $request->query('userunlock')) || 
            (NULL !== $request->query('useradmin')) || (NULL !== $request->query('userunadmin')) || 
            (NULL !== $request->query('staff')) || (NULL !== $request->query('unstaff')) || 
            (NULL !== $request->query('verify')) || (NULL !== $request->query('unverify'))
        ){

        }

        parent::__construct();

    }

    public function users(Request $request){

        if(NULL !== $request->query('userlock')){

            $post = User::findOrFail($request->query('userlock'));
            $post->usertype = 'banned';
            $post->save();
            \Session::flash('success.message', trans("admin.Banned"));
            return redirect()->back();

        }elseif(NULL !== $request->query('userunlock')){

            $post = User::findOrFail($request->query('userunlock'));
            $post->usertype = NULL;
            $post->save();
            \Session::flash('success.message', trans("admin.Unlocked"));
            return redirect()->back();

        }elseif(NULL !== $request->query('useradmin')){

            $post = User::findOrFail($request->query('useradmin'));
            $post->usertype = 'Admin';
            $post->save();
            \Session::flash('success.message', trans("admin.ChangesSaved"));
            return redirect()->back();

        }elseif(NULL !== $request->query('userunadmin')){

            $post = User::findOrFail($request->query('userunadmin'));
            $post->usertype = 'approve';
            $post->save();
            \Session::flash('success.message', trans("admin.Nowuserisnotadmin"));
            return redirect()->back();

        }elseif(NULL !== $request->query('staff')){

            $post = User::findOrFail($request->query('staff'));
            $post->usertype = 'Staff';
            $post->save();
            \Session::flash('success.message', trans("admin.ChangesSaved"));
            return redirect()->back();

        }elseif(NULL !== $request->query('unstaff')){

            $post = User::findOrFail($request->query('unstaff'));
            $post->usertype = 'approve';
            $post->save();
            \Session::flash('success.message', trans("admin.ChangesSaved"));
            return redirect()->back();

        }elseif(NULL !== $request->query('verify')){

            $post = User::findOrFail($request->query('verify'));
            $post->verified = 1;
            $post->save();
            \Session::flash('success.message', trans("admin.ChangesSaved"));
            return redirect()->back();

        }elseif(NULL !== $request->query('unverify')){

            $post = User::findOrFail($request->query('unverify'));
            $post->verified = 0;
            $post->save();
            \Session::flash('success.message', trans("admin.ChangesSaved"));
            return redirect()->back();

        }elseif(NULL !== $request->query('remove')){

            $post = User::findOrFail($request->query('remove'));
            $post->delete();
            \Session::flash('success.message', trans("admin.ChangesSaved"));
            return redirect()->back();

        }


        $typew = $request->query('only');

        return view('_admin.pages.users')->with(['type' =>$typew]);

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getdata(){

        $type = \Request::query('only');

        $user = DB::table('users');
        $user->select('*');

        if($type=='admins'){
            $user->where('usertype', '=', 'Admin');
        }elseif($type=='staff'){
            $user->where('usertype', '=', 'Staff');
        }elseif($type=='banned'){
            $user->where('usertype','=', 'banned');
        }



        return Datatables::of($user)

        ->addColumn('icon', function ($user) {

        return view('._admin._particles.datatable.userlist.icon', compact('user'))->render();

        })->addColumn('username', function ($user) {

        return view('._admin._particles.datatable.userlist.username', compact('user'))->render();

        })->addColumn('email', function ($user) {

        return view('._admin._particles.datatable.userlist.email', compact('user'))->render();

        })->addColumn('status', function ($user) {

        return view('._admin._particles.datatable.userlist.status', compact('user'))->render();

        })->addColumn('created_at', function ($user) {

        return view('._admin._particles.datatable.userlist.created_at', compact('user'))->render();

        })->addColumn('updated_at', function ($user) {

        return view('._admin._particles.datatable.userlist.updated_at', compact('user'))->render();

        })->addColumn('action', function ($user) {

        return view('._admin._particles.datatable.userlist.action', compact('user'))->render();

        })->make(true);

    }
}
