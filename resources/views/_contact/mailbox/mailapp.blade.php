@extends("_admin.adminapp")
@section("content")


<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
{!! trans('admin.mailbox') !!}
<small>{!! trans('admin.new_mail_message', ['unapproveinbox' => $unapproveinbox ]) !!}</small>

</h1>

<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{!! trans('admin.mailbox') !!}</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-3">
<a href="{{action('Admin\ContactController@newmail')}}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-paper-plane" style="margin-right: 5px"></i> {!! trans('admin.send_new_email') !!}</a>

<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title"> {!! trans('admin.folders') !!} </h3>
<div class="box-tools">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
</div>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">

@if($mailcat !== NULL)
@foreach($mailcat as $i => $category)
<li class="{{ Request::segment(3) == $category->name_slug ? 'active' : ''}}">
<a href="{{action('Admin\ContactController@index', $category->name_slug)}}"><i class="fa fa-{{ $category->description }}"></i> {{ $category->name }}
@if($unapproveinbox >0 and $category->name_slug=='inbox')
<span class="label label-primary pull-right">{{ $unapproveinbox }}</span>
@endif
</a>
</li>
@endforeach
@endif

@if($mailprivatecat !== NULL)
@foreach($mailprivatecat as $i => $category)
<li class="{{ Request::segment(3) == $category->name_slug ? 'active' : ''}}"><a href="{{action('Admin\ContactController@index', $category->name_slug)}}"><i class="fa fa-folder" style="color: {{ $category->description }} !important;"></i> {{ $category->name }} </a>

<a style="position: absolute;right:5px;top:5px;padding:3px;border:0" class="btn permanently" href="{{action('Admin\ContactController@maillabeldelete', $category->id)}}"><i class="fa fa-trash"></i></a>

</li>
@endforeach
@endif
<ul class="nav nav-pills nav-stacked">

<li><a href="javascript:" class="addcat" data-type="mailprivatecat"><i class="fa fa-plus"></i> {!! trans('admin.add_folders') !!} </a></li>
</ul>
</ul>
</div><!-- /.box-body -->
</div><!-- /. box -->
<div class="box box-solid">
<div class="box-header with-border">
<h3 class="box-title">{!! trans('admin.labels') !!}</h3>
<div class="box-tools">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
</div>
</div>
<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">
@if($mailsections !== NULL)
@foreach($mailsections as $i => $category)
<li class="{{ Request::segment(3)==$category->name_slug ? 'active' : ''}}"><a href="{{action('Admin\ContactController@index', $category->name_slug)}}"><i class="fa fa-circle-o" style="color: {{ $category->description }} !important;"></i> {{ $category->name }} </a>

<a  style="position: absolute;right:5px;top:5px;padding:3px;border:0" class="btn permanently" href="{{action('Admin\ContactController@maillabeldelete', $category->id)}}"><i class="fa fa-trash"></i></a>

</li>
@endforeach

@endif

<li><a href="javascript:" class="addcat" data-type="maillabel"><i class="fa fa-plus"></i> {!! trans('admin.add_labels') !!}</a></li>
</ul>

</div><!-- /.box-body -->
</div><!-- /.box --><br>
<a href="javascript:" data-item="buzzycontact" class="btn btn-block btn-warning  btn-sm " data-toggle="modal" data-target="#modalbuzzycontact" ><i class="fa fa-cog" style="margin-right:0"></i> {!! trans('admin.Settings') !!}</a>

</div><!-- /.col -->
<div class="col-md-9">
@yield('mailcontent')
</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->

<div class="modal modal-info" id="modalbuzzycontact">
<div class="modal-dialog">
<div class="modal-content">
{!!   Form::open(array('action' => 'Admin\ConfigController@setconfig', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('admin.close') !!}">
<i class="fa fa-remove"></i></button>
<h4 class="modal-title">{!! trans('admin.PluginSettings') !!}</h4>
</div>
<div class="modal-body">
<div class="form-group">
<label class="control-label"> {!! trans('admin.mail_settings_name') !!}</label>
<input type="text" class="form-control input-lg" name="BuzzyContactName" value="{{  getcong('BuzzyContactName') }}">
<p>{!! trans('admin.mail_settings_name_i') !!}</p>
</div>
<div class="form-group">
<label class="control-label">{!! trans('admin.mail_settings_email') !!}</label>
<input type="text" class="form-control input-lg" name="BuzzyContactEmail" value="{{  getcong('BuzzyContactEmail') }}">
<p>{!! trans('admin.mail_settings_email_i') !!}</p>
</div>
<div class="form-group">
<label class="control-label">{!! trans('admin.mail_settings_signature') !!}</label>
<textarea  class="form-control input-lg" name="BuzzyContactSignature">{{  getcong('BuzzyContactSignature') }}</textarea>
<p>{!! trans('admin.mail_settings_signature_i') !!}</p>
</div>
<hr>
<div class="form-group">
<label class="control-label">{!! trans('admin.mail_settings_copy') !!}</label>
<input type="text" class="form-control input-lg" name="BuzzyContactCopyEmail" value="{{  getcong('BuzzyContactCopyEmail') }}">
<p>{!! trans('admin.mail_settings_copy_i') !!}</p>
</div>
<div class="form-group">
<label class="control-label">{!! trans('admin.mail_settings_captcha') !!}</label>
{!! Form::select('BuzzyContactCaptcha', ['on' => trans('admin.yes_use'), 'off' => trans('admin.no_need')], getcong('BuzzyContactCaptcha'), ['class' => 'form-control'])  !!}
</div>
<div class="form-group">
<label class="control-label">Google reCaptcha Api Key</label>
<input type="text" class="form-control input-lg" name="reCaptchaKey" value="{{  getcong('reCaptchaKey') }}">
<p>{!! trans('admin.mail_settings_captcha_i') !!}</p>
</div>
<div class="form-group">
<label class="control-label">Google reCaptcha Api Secret</label>
<input type="text" class="form-control input-lg" name="reCaptchaSecret" value="{{  getcong('reCaptchaSecret')  }}">
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">

<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{!! trans('admin.close') !!}</button>
<input type="submit" value="{!! trans('admin.SaveSettings') !!}" class="btn btn-info btn-outline">

</div>
{!! Form::close() !!}
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
@endsection
@section('footer')

<script src="/adminlte/dist/js/buzzymailbox.js"></script>
@yield('mailfooter')

@endsection