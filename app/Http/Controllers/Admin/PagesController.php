<?php

namespace App\Http\Controllers\Admin;

use App\Pages;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends MainAdminController{

public function __construct(){
    parent::__construct();
}



public function index(){
    $pages = Pages::all();

    return view('_admin.pages.pages', compact('pages'));
}

public function add(){
    return view('_admin.pages.pagesadd');
}

public function edit($id){
    $page = Pages::findOrFail($id);

    return view('_admin.pages.pagesadd', compact('page'));
}

public function delete(Request $request){

    $input = $request->all();
    $id = $input['id'];

    $pages = Pages::findOrFail($id);
    $pages->delete();

    return response()->json([
        'success' => true,
        'message' => trans('admin.Deleted'),
    ], 200); 

}


public function addnew(Request $request){

    $input = $request->all();

    $rules = [];

    if(empty($input['id'])){ 
        $input['slug'] = slug_valid('page', $input['title']);
    }else{
        $input['slug'] = slug_valid('page', $input['slug']);
    }

    //remove textarea html tags
    $input['text_valid'] = strip_tags($input['text']);
    
    $rules['title'] = 'required:title|min:5|max:255';
    $rules['text'] = 'required:text|min:10';
    $rules['description'] = 'required:description';
    $rules['slug'] = 'required:slug|min:3';
    

    $validation = \Validator::make($input, $rules);
    $errors =  json_decode($validation->errors());


   if($validation->passes()){

    if(!empty($input['id'])){
        $pages = Pages::findOrFail($input['id']);
        $pages->title = $input['title'];
        $pages->slug = $input['slug'];
        $pages->description = $input['description'];
        $pages->text = $input['text'];
        $pages->footer = $input['footer'];
        $pages->save();

        $returnMessage = trans('admin.ChangesSaved'); 
        //\Session::flash('success.message', trans('admin.ChangesSaved'));
    }else{
        Pages::create($input);
        $returnMessage = trans('admin.PageSuccesfulyCreateted'); 
        //\Session::flash('success.message', trans('admin.PageSuccesfulyCreateted'));
    }

}


    if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $errors,
                ], 422);
    }else{
                return response()->json([
                    'success' => true,
                    'message' => $returnMessage,
                    'url' => action('Admin\PagesController@index'),
                ], 200); 
    }




}


}