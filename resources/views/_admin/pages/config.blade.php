@extends('_admin.adminapp')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{!! trans('admin.Settings') !!}</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>  {!! trans('admin.dashboard') !!}</a></li>
        <li class="active"> {!! trans('admin.Settings') !!}</li>
    </ol>
</section>

<section class="content">
{!!  Form::open([
                        'action' => 'Admin\ConfigController@setconfig',
                        'method' => 'POST', 
                        'enctype' => 'multipart/form-data',
                        'data-type' => 'JSON',
                        'form' => 'settings'
                        ]) !!}

@if($page == 'mail')
@section('title', trans('admin.MailSettings'))

<div class="row">
<div class="col-lg-12">
<div class="panel panel-primary">
<div class="panel-heading">{!! trans('admin.MailSettingsTitle') !!}</div>
<div class="panel-body">

<div class="form-group">
{!! Form::label('mail_driver', trans('admin.MailDriver')) !!}
{!! Form::select('mail_driver', ['smtp' => 'SMTP'], env('MAIL_DRIVER'), ['class' => 'form-control'])  !!}
</div>

<div class="form-group">
{!! Form::label('mail_host', trans('admin.MailHost')) !!}
{!! Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('mail_port', trans('admin.MailPort')) !!}
{!! Form::select('mail_port', ['25' => '25', '465' => '465', '587' => '587'], env('MAIL_PORT'), ['class' => 'form-control'])  !!}
</div>

<div class="form-group">
{!! Form::label('mail_username', trans('admin.MailUsername')) !!}
{!! Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('mail_password', trans('admin.MailPassword')) !!}
{!! Form::password('mail_password', ['class' => 'form-control', 'id' => 'mail_password', 'placeholder' => env('MAIL_PASSWORD')]) !!}
</div>

<div class="form-group">
{!! Form::label('mail_encryption', trans('admin.MailEncryption')) !!}
{!! Form::select('mail_encryption', ['' => trans('admin.Nope'), 'tls' => trans('admin.MailTls'), 'ssl' => trans('admin.MailSsl')], env('MAIL_ENCRYPTION'), ['class' => 'form-control'])  !!}
</div>

<hr>

</div>
</div>

</div><!-- /.col -->

</div><!-- /.row -->


@elseif($page == 'storage')
@section('title', trans('admin.StorageAndCacheSettings'))

<div class="row">
<div class="col-lg-12">
<div class="panel panel-primary">
<div class="panel-heading">{!! trans('admin.StorageAndCache') !!}</div>
<div class="panel-body">

<div class="form-group">
{!! Form::label('themecache', trans('admin.TemplateCacheEngine')) !!}
{!! Form::select('themecache', 
['true' => trans('admin.on'), 
'false' => trans('admin.off')], 
getcong('themecache'), 
['class' => 'form-control'])
!!}
<span></span>
</div>

<div class="form-group">
{!! Form::label('app_filesystem', trans('admin.AppFileSystem')) !!}
{!! Form::select('app_filesystem', 
['local' => trans('admin.LocalFileSystem'), 
's3' => trans('admin.AmazonWebService')],
env('APP_FILESYSTEM'), 
['class' => 'form-control', 
'data-hidden' => 'true'])
!!}
<span></span>
</div>

<div data-hidden-par="s3">
<div class="form-group">
{!! Form::label('s3_key', trans('admin.s3_key')) !!}
{!! Form::text('s3_key', env('S3_KEY'), ['class' => 'form-control']) !!}
<span></span>
</div>

<div class="form-group">
{!! Form::label('s3_secret', trans('admin.s3_secret')) !!}
{!! Form::text('s3_secret', env('S3_SECRET'), ['class' => 'form-control']) !!}
<span></span>
</div>

<div class="form-group">
{!! Form::label('s3_bucket', trans('admin.s3_bucket')) !!}
{!! Form::text('s3_bucket', env('S3_BUCKET'), ['class' => 'form-control']) !!}
<span></span>
</div>

<div class="form-group">
{!! Form::label('s3_region', trans('admin.s3_region')) !!}
{!! Form::text('s3_region', env('S3_REGION'), ['class' => 'form-control']) !!}
<span></span>
</div>
</div>

<hr>

</div>
</div>

</div><!-- /.col -->

</div><!-- /.row -->


@elseif($page == 'others')
@section('title', trans('admin.OptionalConfigurations'))

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">{!! trans('admin.OptionalConfigurations') !!}</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>
                               {!! trans('admin.SitePostsUrlType') !!}
                            </label>

                            {!! Form::select('siteposturl', [
                            '1' => url().'/{type}/{slug} ('.trans('admin.default').')',
                            '2' => url('/').'/{type}/{id}',
                            '3' => url('/').'/{username}/{slug}',
                            '4' => url('/').'/{username}/{id}'
                             ], getcong('siteposturl'), ['class' => 'form-control'])  !!}

                        </div>
                        <span class="help-block">{!! trans('admin.SitePostsUrlTypehelp') !!}</span>

                        <hr>
                        <div class="form-group">
                            <label>
                                {!! trans('admin.Maintenance') !!}
                            </label>
                            {!! Form::select('maintenance', [
                            '1' => trans('admin.yes'),
                            '0' => trans('admin.no')
                            ], getcong('maintenance'), ['class' => 'form-control'])  !!}

                        </div>
                        <span class="help-block">{!! trans('admin.Maintenancehelp') !!}</span>

                      <hr>
                        <div class="form-group">
                            <label>{!! trans('admin.RightClick') !!}</label>
                            {!! Form::select('mouse_right_click', ['true' => trans('admin.on'), 'false' => trans('admin.off')], getcong('mouse_right_click'), ['class' => 'form-control'])  !!}

                        </div>

                        <hr>
                        <div class="form-group">
                            <label>
                                {!! trans('admin.Usersregistration') !!}
                            </label>
                            {!! Form::select('sitevoting', [
                            '0' => trans('admin.yes'),
                            '1' => trans('admin.no')
                            ], getcong('sitevoting'), ['class' => 'form-control'])  !!}

                        </div>

                        <span class="help-block">{!! trans('admin.Usersregistrationhelp') !!}</span>

                        <hr>
                        <div class="form-group">
                                <label class="control-label">{!! trans('admin.Auto-listedonHomepage') !!}</label>
                                {!! Form::select('AutoInHomepage', ['true' => trans('admin.on'),'false' => trans('admin.off')], getcong('AutoInHomepage'), ['class' => 'form-control'])  !!}

                            <span class="help-block">{!! trans('admin.Auto-listedonHomepagehelp') !!}</span>
                        </div>
                        <hr>
                        <div class="form-group">
                                <label class="control-label">{!! trans('admin.AutoApprovePosts') !!}</label>
                                {!! Form::select('AutoApprove', ['true' => trans('admin.on'),'false' => trans('admin.off')], getcong('AutoApprove'), ['class' => 'form-control'])  !!}

                            <span class="help-block">{!! trans('admin.AutoApprovePostshelp') !!}</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">{!! trans('admin.Auto-approveeditedposts') !!}</label>
                            {!! Form::select('AutoEdited', ['true' =>trans('admin.on'),'false' => trans('admin.off')], getcong('AutoEdited'), ['class' => 'form-control'])  !!}

                            <span class="help-block">{!! trans('admin.Auto-approveeditedpostshelp') !!}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{!! trans('admin.Auto-LoadonLists') !!}</label>
                            {!! Form::select('AutoLoadLists', ['true' => trans('admin.yes'),'false' => trans('admin.nouseload')], getcong('AutoLoadLists'), ['class' => 'form-control'])  !!}
                            <span class="help-block">{!! trans('admin.Auto-LoadonListshelp') !!}</span>
                        </div>
                        <hr>

                        <H3>{!! trans('admin.UserPermissions') !!}</H3>
                        <div class="form-group">
                            <label>
                                {!! trans('admin.Userscanpost') !!}
                            </label>
                            {!! Form::select('UserCanPost', ['true' => trans('admin.yes'),'false' => trans('admin.no')], getcong('UserCanPost'), ['class' => 'form-control'])  !!}

                        </div>
                        <div class="form-group">
                            <label>
                                {!! trans('admin.Userscandeleteownposts') !!}
                            </label>
                            {!! Form::select('UserDeletePosts', ['true' => trans('admin.yes'),'false' => trans('admin.no')], getcong('UserDeletePosts'), ['class' => 'form-control'])  !!}

                        </div>
                        <div class="form-group">
                            <label>
                                {!! trans('admin.Userscaneditownposts') !!}
                            </label>
                            {!! Form::select('UserEditPosts', ['true' => trans('admin.yes'),'false' => trans('admin.no')], getcong('UserEditPosts'), ['class' => 'form-control'])  !!}

                        </div>
                        <div class="form-group">
                            <label>
                                {!! trans('admin.Userscaneditownusernames') !!}
                            </label>
                            {!! Form::select('UserEditUsername', ['true' => trans('admin.yes'),'false' => trans('admin.no')], getcong('UserEditUsername'), ['class' => 'form-control'])  !!}

                        </div>
                         <div class="form-group">
                            <label>
                                {!! trans('admin.Userscaneditownemails') !!}
                            </label>
                             {!! Form::select('UserEditEmail', ['true' => trans('admin.yes'),'false' => trans('admin.no')], getcong('UserEditEmail'), ['class' => 'form-control'])  !!}

                         </div>
                        <div class="form-group">
                            <label>
                                {!! trans('admin.Userscanaddownsocialmediaaddresses') !!}
                            </label>
                            {!! Form::select('UserAddSocial', ['true' => trans('admin.yes'), 'false' => trans('admin.no')], getcong('UserAddSocial'), ['class' => 'form-control'])  !!}

                        </div>
                        <hr>
                        <div class="form-group">
                            <H3>
                                 {!! trans('admin.UseRight-to-LeftLanguageSupport') !!}
                            </H3>
                            {!! Form::select('languagetype', ['rtl' => trans('admin.yes'), '' => trans('admin.no')], getcong('languagetype'), ['class' => 'form-control'])  !!}

                        </div>
                        <hr>

                    </div>
                </div>

            </div><!-- /.col -->

        </div><!-- /.row -->

    @elseif($page == 'social')

    @section('title', trans('admin.SocialMediaSettings'))

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">{!! trans('admin.SocialMediaAdress') !!}</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>  {!! trans('admin.PageUrl') !!}</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="facebookpage" value="{{  getcong('facebookpage') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>  {!! trans('admin.PageUrl') !!}</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="twitterpage" value="{{  getcong('twitterpage') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a> {!! trans('admin.PageUrl') !!}</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="googlepage" value="{{  getcong('googlepage') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a> {!! trans('admin.PageUrl') !!}</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="instagrampage" value="{{  getcong('instagrampage') }}">
                            </div>
                        </div>


                        <hr>

                    </div>
                </div>

            </div><!-- /.col -->

        </div><!-- /.row -->

    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">{!! trans('admin.LoginConfiguration') !!}</div>
                <div class="panel-body form-horizontal">
                    <legend><a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a> Facebook</legend>
                    <div class="form-group">
                        <label for="facebookapp" class="col-sm-2 control-label">App ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebookapp" name="facebookapp" value="{{ getcong('facebookapp') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebookappsecret" class="col-sm-2 control-label">App SECRET</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebookappsecret" name="facebookappsecret" value="{{ getcong('facebookappsecret') }}">
                        </div>
                    </div>
                    <br><br>
                    <legend><a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a> Google</legend>
                    <div class="form-group">
                        <label for="googleapp" class="col-sm-2 control-label">App ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="googleapp" name="googleapp" value="{{  getcong('googleapp') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="googleappsecret" class="col-sm-2 control-label">App SECRET</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="googleappsecret" name="googleappsecret" value="{{ getcong('googleappsecret') }}">
                        </div>
                    </div>
                    <br><br>
                    <legend><a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a> Twitter</legend>
                    <div class="form-group">
                        <label for="twitterapp" class="col-sm-2 control-label">App ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="twitterapp" name="twitterapp" value="{{  getcong('twitterapp') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitterappsecret" class="col-sm-2 control-label">App SECRET</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="twitterappsecret" name="twitterappsecret" value="{{ getcong('twitterappsecret') }}">
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.col -->
    </div><!-- /.row -->

    @elseif($page == 'layout')
    @section('title', trans('admin.LayoutConfiguration'))
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">{!! trans('admin.LayoutConfiguration') !!}</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>{!! trans('admin.SiteLayoutType') !!}</label>
                            {!! Form::select('LayoutType', 
                            ['mode-wide' => trans('admin.Wide'), 
                            'mode-boxed' => trans('admin.Boxed')],
                            getcong('LayoutType'),
                            ['class' => 'form-control'])
                            !!}
                        <span></span>
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarType') !!}</label>
                            {!! Form::select('NavbarType', 
                            ['navbar-fixed' => trans('admin.Fixed'), 
                            'mode-relative' => trans('admin.Relative')],
                            getcong('NavbarType'), 
                            ['class' => 'form-control'])
                            !!}
                        <span></span>
                        </div>

                        <hr>
                        <div class="form-group">
                            <label>{!! trans('admin.SiteBackgroundColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="BodyBC" class="form-control" value="{{  getcong('BodyBC') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('BodyBC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.SiteBackgroundColorOnBoxedMode') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="BodyBCBM" class="form-control" value="{{  getcong('BodyBCBM') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('BodyBCBM') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarBackgroundColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarBC" class="form-control" value="{{  getcong('NavbarBC') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarBC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarTop3PixelBorderLineColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                            <span></span>
                                <input type="text" name="NavbarTBLC" class="form-control" value="{{  getcong('NavbarTBLC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarTBLC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarLinkColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarLC" class="form-control" value="{{  getcong('NavbarLC') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarLC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarLinkHoverColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarLHC" class="form-control" value="{{  getcong('NavbarLHC') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarLHC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarCreateButtonBackgroundColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarCBBC" class="form-control" value="{{  getcong('NavbarCBBC') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarCBBC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarCreateButtonFontColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarCBFC" class="form-control" value="{{  getcong('NavbarCBFC') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarCBFC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarCreateButtonHoverBackgroundColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarCBHBC" class="form-control" value="{{  getcong('NavbarCBHBC') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarCBHBC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.NavbarCreateButtonHoverFontColor') !!}</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarCBHFC" class="form-control" value="{{  getcong('NavbarCBHFC') }}">
                                <span></span>
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarCBHFC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <hr>

                    </div>
                </div>

            </div><!-- /.col -->

        </div><!-- /.row -->
@elseif($page == 'common')
@section('title', trans('admin.MainConfiguration'))
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{!! trans('admin.MainConfiguration') !!}</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">{!! trans('admin.SiteName') !!}</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="sitename" value="{{  getcong('sitename') }}">
                                <span></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="sitelogo">{!! trans('admin.SiteLogo') !!}</label>
			<div class="btn btn-default btn-file">
			{!! trans('index.browse') !!} 
                                        <input type="file" id="sitelogo" img-id="sitelogo" name="sitelogo">
			</div>
                                        <span></span>
			<p class="help-block">{!! trans('admin.SiteLogohelp') !!}</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <img img-id="sitelogo" class="field-image-preview img-thumbnail" src="{{ asset('assets/img/').'/'.getcong('sitelogo') }}?{{time()}}">
                            </div>
                        </div>
                    <hr>
                    <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="footerlogo">{!! trans('admin.FooterSiteLogo') !!}</label>
                                    <div class="btn btn-default btn-file">
                                    {!! trans('index.browse') !!} 
                                    <input type="file" img-id="footerlogo" name="footerlogo">
		          </div>
                                    <span></span>
                                    <p class="help-block">{!! trans('admin.SiteLogohelp') !!}</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <img img-id="footerlogo" class="field-image-preview img-thumbnail" src="{{ asset('assets/img/flogo.png') }}?{{time()}}">
                            </div>

                        </div>  <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="favicon">{!! trans('admin.SiteFavicon') !!}</label>
                                    <div class="btn btn-default btn-file">
                                    {!! trans('index.browse') !!} 
                                    <input type="file" img-id="favicon" name="favicon">
                                    </div>
                                    <span></span>
                                    <p class="help-block">{!! trans('admin.SiteFaviconhelp') !!}</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <img img-id="favicon" class="field-image-preview img-thumbnail" src="{{ asset('assets/img/favicon.png') }}?{{time()}}">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label">{!! trans('admin.SiteDefaultMetaTitle') !!}</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="sitetitle" value="{{  getcong('sitetitle') }}">
                                <span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{!! trans('admin.SiteDefaultMetaDescription') !!}</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="sitemetadesc" value="{{  getcong('sitemetadesc') }}">
                                <span></span>
                            </div>
                        </div>
                <hr>
                    <div class="form-group">
                        <label class="control-label">{!! trans('admin.Siteemail') !!}</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="siteemail" value="{{  getcong('siteemail') }}">
                            <span></span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label">{!! trans('admin.SiteLanguageCountryCodes') !!}</label>
                        <div class="controls">
                            <select class="form-control" style="width: 100%;" name="sitelanguage" data-toggle="select">
                            @foreach ($AppLangs as $lang)
                                <option value="{{ $lang['code'] }}" @if ($lang['code'] === getcong('sitelanguage')) selected="selected" @endif>{{ $lang['name'] }}</option>
                            @endforeach
                            </select>
                            <span></span>
                        </div>
                        <span class="help-block">{!! trans('admin.SiteLanguageCountryCodeshelp') !!}</span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label">{!! trans('admin.GoogleFontConfig') !!}</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="googlefont" value="{{  getcong('googlefont') }}" id="font">
                            <span></span>
                        </div>
                        <span class="help-block">{!! trans('admin.GoogleFontConfighelp') !!} </span>
                    </div>
                </div>
            </div>

        </div><!-- /.col -->

    </div><!-- /.row -->

    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading">{!! trans('admin.AdvancedConfiguration') !!}</div>
                <div class="panel-body form-horizontal">
                    <legend>{!! trans('admin.HeadCode') !!}</legend>
                    <textarea name="headcode" style="height:120px" class="form-control">{{  getcong('headcode') }}</textarea>
                    <span class="help-block">{!! trans('admin.HeadCodehelp') !!}</span>
                    <br>
                    <legend>{!! trans('admin.Footercode') !!}</legend>
                    <textarea name="footercode" style="height:120px" class="form-control">{{  getcong('footercode') }}</textarea>
                    <span class="help-block">{!! trans('admin.Footercodehelp') !!}</span>

                </div>
            </div>

        </div><!-- /.col -->
    </div><!-- /.row -->

@endif
    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" name="redirect" value="{{$page}}">
            <input type="button" value="{!! trans('admin.SaveSettings') !!}" class="btn btn-block btn-info btn-lg">

        </div><!-- /.col -->
    </div><!-- /.row -->{!! Form::close() !!}
</section>
@endsection