<?php
$DB_PLUGIN_NEWS = getcong('p-news');
$DB_PLUGIN_LISTS = getcong('p-lists');
$DB_PLUGIN_POLLS =getcong('p-polls');
$DB_PLUGIN_VIDEOS = getcong('p-videos');
$DB_PLUGIN_QUIZS= getcong('p-quizzes');
?>
@extends("app")
@section('content')
    <div class="content" >
        <div class="container" style="padding:150px 0 350px 0;text-align: center">
        	 <i class="fa fa-futbol-o" style="font-size:85px;"></i>
        	 <br><br>
            <h1>{!! trans('updates.page_not_found') !!}</h1>
            <p>
            <h4>{!! trans('updates.own_goal_404') !!}</h2>
            </p>
            <a href="/"  style="margin-top:50px" class="button button-big button-black">{!! trans('updates.go_back_home') !!}</a>
        </div>
    </div>
@endsection
