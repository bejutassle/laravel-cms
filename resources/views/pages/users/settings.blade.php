@extends("pages.users.userapp")
@section("usercontent")
<h2>{!! trans('index.settings') !!}</h2>
@include('errors.adminlook', ['relatedid' => $userinfo->id, 'relatedtext' => trans('index.adminnote')])

<br>

<div class="setting-form">

{!! Form::open(array('action' => array('UsersController@updatesettings', $userinfo->username_slug), 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}

  <input class="tab_button" id="tab1" type="radio" name="tabs" checked>
  <label class="tab_" for="tab1" icon="account">{!! trans('index.account') !!}</label>
    
  <input class="tab_button" id="tab2" type="radio" name="tabs">
  <label class="tab_" for="tab2" icon="detail">{!! trans('index.details') !!}</label>
    
  <input class="tab_button" id="tab3" type="radio" name="tabs">
  <label class="tab_" for="tab3" icon="links">{!! trans('index.links') !!}</label>
    
<section class="tab_content" id="content1">

@if(getcong('UserEditUsername') == 'true' or Auth::user()->usertype == 'Admin')
<div class="form-group">
{!! Form::label('username', trans('index.username')) !!}
{!! Form::text('username', $userinfo->username, ['class' => 'cd-input','id' => 'username']) !!}
</div>
@endif

@if(getcong('UserEditEmail') == 'true' or Auth::user()->usertype == 'Admin')
<div class="form-group">
{!! Form::label('email', trans('index.email')) !!}
{!! Form::text('email', $userinfo->email, ['class' => 'cd-input','id' => 'email']) !!}
</div>
@endif

<div class="form-group">
{!! Form::label('password', trans('index.password')) !!}
{!! Form::password('password', ['class' => 'cd-input', 'id' => 'password', 'placeholder' => trans('index.onlycgange')]) !!}
</div>

<div class="form-group">
{!! Form::label('splash', trans('updates.usersplash')) !!}
<div class="clear"></div>
<br>
<input type="file" accept="image/*" id="splash" name="splash">
<br>
</div>

<div class="form-group">
{!! Form::label('icon', trans('updates.useravatar')) !!}
<div class="clear"></div>
<img src="{{ makepreview($userinfo->icon, 'b', 'members/avatar') }}" width="200" height="200" class="profile-image">
<div class="clear"></div>
<br>
<input type="file" accept="image/*" id="icon" name="icon">
</div>

</section>
    
<section class="tab_content" id="content2">

<div class="form-group">
{!! Form::label('name', trans('index.fullname')) !!}
{!! Form::text('name', $userinfo->name, ['class' => 'cd-input','id' => 'name']) !!}
</div>

<div class="form-group">
{!! Form::label('town', trans('index.location')) !!}
{!! Form::text('town', $userinfo->town, ['class' => 'cd-input','id' => 'town', 'placeholder' => trans('updates.live-in')]) !!}
</div>

<div class="form-group">
{!! Form::label('gender', trans('index.gender')) !!}
{!! Form::select('gender', [trans('updates.male') =>trans('updates.male'), trans('updates.female') => trans('updates.female'),  trans('updates.other')=> trans('updates.other')], isset($userinfo->genre) ? $userinfo->genre : NULL, ['id' => 'gender']) !!}
</div>

<div class="form-group">
{!! Form::label('aboutyou', trans('index.about')) !!}
{!! Form::textarea('about', $userinfo->about, ['id' => 'aboutyou', 'placeholder' => trans('updates.abouttext')]) !!}
</div>

</section>
    
<section class="tab_content" id="content3">

@if(getcong('UserAddSocial') == 'true' or Auth::user()->usertype == 'Admin')
<div class="form-group">
{!! Form::label('facebook', trans('updates.facebookurl')) !!}
{!! Form::text('facebook', $userinfo->facebookurl, ['class' => 'cd-input','id' => 'facebook']) !!}
</div>

<div class="form-group">
{!! Form::label('twitter', trans('updates.twitterurl')) !!}
{!! Form::text('twitter', $userinfo->twitterurl, ['class' => 'cd-input','id' => 'twitter']) !!}
</div>

<div class="form-group">
{!! Form::label('web', trans('updates.weburl')) !!}
{!! Form::text('web', $userinfo->weburl, ['class' => 'cd-input','id' => 'web']) !!}
</div>
@endif

</section>

<div class="clear"></div>

<div>
<input  class="button button-black button-full" type="submit" value="{!! trans('index.savesettings') !!}" >
</div>
<br><br>
{!! Form::close() !!}

</div>

@endsection