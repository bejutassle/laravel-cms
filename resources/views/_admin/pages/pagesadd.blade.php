@extends('_admin.adminapp')
@section('header')
@endsection
@section('title', trans('admin.adminPageAddTitle'))
@section("content")
 <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ isset($page->title) ? trans('admin.edit').': '. $page->title : trans('admin.CreatePage') }}</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
        <li class="active"> {!! trans('admin.CreatePage') !!}</li>
    </ol>
</section>

<section class="content">
        {!!  Form::open([
        'action' => 'Admin\PagesController@addnew', 
        'method' => 'POST', 
        'enctype' => 'multipart/form-data',
        'data-type' => 'JSON',
        'form' => 'standart'
        ]) !!}
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" name="id" value="{{ isset($page->id) ? $page->id : null }}">
                <input type="hidden" name="text_valid" value="0">
                <div class="panel panel-info">
                    <div class="panel-heading">{!! trans('admin.PageForm') !!}</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label>{!! trans('admin.Title') !!}</label>
                            <input type="text" name="title" class="form-control input-lg" placeholder="{!! trans('admin.Title') !!}" value="{{ isset($page->title) ? $page->title : null }}">
                            <span></span>
                        </div>
                        @if(!empty($page->id))
                        <div class="form-group">
                            <label>{!! trans('admin.TitleSlug') !!}</label>
                            <input type="text" name="slug" class="form-control input-lg" placeholder="{!! trans('admin.TitleSlug') !!}" value="{{ isset($page->slug) ? $page->slug : null }}">
                            <span></span>
                        </div>
                        @endif 
                        <div class="form-group">
                            <label>{!! trans('admin.Descriptiontag') !!}</label>
                            <input type="text" name="description" class="form-control input-lg" placeholder="{!! trans('admin.CategoryDescription') !!}" value="{{ isset($page->description) ? $page->description : null }}">
                            <span></span>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>{!! trans('admin.text') !!}</label>
                           <textarea name="text" class="textarea" id="textarea" data-editor="ck" placeholder="{!! trans('admin.Placesometexthere') !!}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ isset($page->text) ? $page->text : null }}</textarea>
                           <span></span>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Footer Link?</label>
                            {!! Form::select('footer', ['1' => trans('admin.yes'),'0' => trans('admin.no')], isset($page->footer) ? $page->footer : null, ['class' => 'form-control'])  !!}
                            <span></span>
                        </div>

                    </div>
                </div>

                <input type="button" value="{{ isset($page->title) ? trans('admin.SaveChanges') : trans('admin.CreatePage') }}" class="btn btn-block btn-info btn-lg">

            </div><!-- /.col -->

        </div><!-- /.row -->
        {!! Form::close() !!}

</section>
@endsection