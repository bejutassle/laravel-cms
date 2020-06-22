<?php
$AppLangs = (!empty($AppLangs)) ? $AppLangs : NULL;
$DB_USER_LANG = isset($DB_USER_LANG) ? $DB_USER_LANG : '';
$CookieLang = (\Cookie::get('lang') != NULL) ? \Cookie::get('lang') : $DB_USER_LANG;
?>
<!DOCTYPE html>
<html lang="{!! Lang::getLocale() !!}">
<head>
<title>@yield('head_title', getcong('sitetitle'))</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="@yield('head_description', getcong('sitemetadesc'))" />

<meta property="og:type" content="article" />
<meta property="og:title" content="@yield('head_title',  getcong('sitetitle'))" />
<meta property="og:description" content="@yield('head_description', getcong('sitemetadesc'))" />
<meta property="og:image" content="@yield('head_image', url('/assets/img/logo.png'))" />
<meta property="og:url" content="@yield('head_url', url())" />

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="@yield('head_image', url('/assets/img/logo.png'))" />
<meta name="twitter:url" content="@yield('head_url', url())">
<meta name="twitter:title" content="@yield('head_title',  getcong('sitetitle'))">
<meta name="twitter:description" content="@yield('head_description', getcong('sitemetadesc'))">
<meta name="twitter:site" content="@tribunnedio">
<meta name="twitter:creator" content="@tribunnedio">

<meta name="author" content="Emre Emir - emre@emreemir.com">

<link href="{{ url('/assets/img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />
<? Assets::add([asset('css/style.css'), 'font-awesome', '/assets/css/application.css', '/assets/css/jquery.powertip.css', '/assets/css/jquery.prefixfree.css']); ?>
{!! Assets::css() !!}
<? Assets::add('/assets/js/ie8.js', 'js', 'ie8'); ?>
<!--[if lte IE 8]>{!! Assets::js('ie8') !!}<![endif]-->
<? Assets::add('/assets/js/modernizr.js', 'js', 'head-script'); ?>
{!! Assets::js('head-script') !!}
{!! getcong('headcode') !!}
@yield("header")

</head>
<body class="{{ getcong('languagetype') }} {{ $AppLangs[$DB_USER_LANG]['rtl'] ? 'rtl' :''  }} {{ $AppLangs[$CookieLang]['wideheader'] ? 'widecontainer' : ''  }}  {{ getcong('LayoutType') }} {{ getcong('NavbarType') }} @yield("modedefault") @yield("modeboxed") ">
@include("_particles.header")

<div class="content-wrapper" id="container-wrapper">
@if( (!Request::is('create')) && (Request::segment(1) !== 'profile') && (Request::segment(1)!=='edit') )
    @foreach(\App\Widgets::where('type', 'HeaderBelow')->where('display', 'on')->get() as $widget)
        <div class="content">
            <div class="container" style="text-align:center; padding-top:20px; padding-bottom:20px">
                <center>
                 {!! $widget->text !!}
                </center>
            </div>
        </div>
    @endforeach
@endif
@yield("content")

</div>

@include("_particles.footer")

<div id="fb-root"></div>
{!! Assets::js() !!}
{!! Assets::js('create-post') !!}
<script>
$(document).ready(function() {

App.init();

$('a').powerTip({
    placement: 'e'
});

$('span').powerTip({
    placement: 'ne-alt'
});

});
@if(getcong('mouse_right_click')=='true')
$(document)[0].oncontextmenu = function() {
        return false;
}

$(document).ready(function() {
    
$('body').keydown(function(e) {
            ///// e.which Values
            // 8  : BackSpace , 46 : Delete , 37 : Left , 39 : Rigth , 144: Num Lock 
            if (e.which != 8 && e.which != 46 && e.which != 37 && e.which != 39 && e.which != 144
                && (e.which < 96 || e.which > 105 )) {
                return false;
            }
        });
});

@endif;
</script>
@yield("footer")
@include('.errors.swalerror')

<div id="auth-modal" class="modal auth-modal"></div>

<div class="hide">
<input name="_requesttoken" id="requesttoken" type="hidden" value="{{ csrf_token() }}" />
</div>{!!  getcong('footercode')  !!}

</body>
</html>