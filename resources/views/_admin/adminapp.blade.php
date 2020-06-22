<? Assets::add([
                        '/adminlte/bootstrap/css/bootstrap.css', 
                        '/adminlte/bootstrap/css/button.css', 
                        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css', 
                        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.css',
                        ], 'css', 'core'); ?>

<? Assets::add([
                        //'/adminlte/plugins/morris/morris.css', 
                        '/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css', 
                        '/adminlte/plugins/sweetalert/sweetalert2.css', 
                        '/adminlte/plugins/iCheck/flat/blue.css', 
                        '/adminlte/plugins/pace/pace.css',
                        '/adminlte/plugins/datatables/dataTables.bootstrap.css',
                        '/adminlte/plugins/datatables/responsive.bootstrap.css',
                        '/adminlte/plugins/select2/select2.css',
                        '/adminlte/plugins/select2/select2-bootstrap.css',
                        '/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css',
                        '/adminlte/plugins/tooltipster/css/tooltipster.bundle.css',
                        '/adminlte/plugins/flags/flags.css',
                        '/adminlte/plugins/fontselect/css/fonts.css',
                        ], 'css', 'plugins'); ?>

<? Assets::add([
                        '/adminlte/dist/css/AdminLTE.css', 
                        '/adminlte/dist/css/skins/all-skins.css',
                        ], 'css', 'site'); ?>

  <? Assets::add([
                        'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', 
                        'https://oss.maxcdn.com/respond/1.4.2/respond.min.js'
                        ], 'js', 'ie9'); ?>

<? Assets::add([
                        '/adminlte/plugins/jQuery/jquery.js', 
                        '/adminlte/bootstrap/js/bootstrap.js',
                        '/adminlte/plugins/jQueryUI/jquery-ui.js',
                        '/adminlte/plugins/pjax/jquery.pjax.js',
                        ], 'js', 'core'); ?>

<? Assets::add([
                        asset('/js/admin-app.js'),
                        '/adminlte/dist/js/boot.js',
                        ], 'js', 'boot'); ?>

<? Assets::add([
                        '/adminlte/plugins/datatables/jquery.dataTables.min.js', 
                        '/adminlte/plugins/datatables/dataTables.bootstrap.min.js', 
                        '/adminlte/plugins/datatables/dataTables.responsive.js', 
                        '/adminlte/plugins/pace/pace.js',
                        '/adminlte/plugins/slimScroll/jquery.slimscroll.js',
                        '/adminlte/plugins/sweetalert/sweetalert2.js',
                        '/adminlte/plugins/iCheck/icheck.js',
                        '/adminlte/plugins/colorpicker/bootstrap-colorpicker.js',
                        '/adminlte/plugins/select2/select2.full.js',
                        //'/adminlte/plugins/morris/raphael.js',
                        //'/adminlte/plugins/morris/morris.js',
                        //'/adminlte/dist/js/pages/dashboard.js',
                        '/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js',
                        '/adminlte/plugins/tooltipster/js/tooltipster.bundle.js',
                        '/adminlte/plugins/fontselect/js/fonts.js',
                        '/adminlte/plugins/livequery/js/jquery.livequery.js',
                        ], 'js', 'plugins'); ?>
                        
<? Assets::add([
                        '/adminlte/dist/js/app.js', 
                        '/adminlte/dist/js/admin.js', 
                        '/adminlte/dist/js/buzzy.js',
                        ], 'js', 'site'); ?>

<? 
$panelTitle = explode(' ', (trans('admin.adminpanel')));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ url('/assets/img/favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ url('/assets/img/favicon.ico') }}" type="image/x-icon">
<title>{!! getcong('sitetitle') !!} | @yield('title', trans('admin.adminpanel'))</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
{!! Assets::css('core') !!}
{!! Assets::css('plugins') !!}
{!! Assets::css('site') !!}
@yield('header')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
{!! Assets::js('ie9') !!}
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
<header class="main-header">
<!-- Logo -->
<a class="logo" href="{{ action('Admin\DashboardController@index') }}">
<!-- mini logo for sidebar mini 50x50 pixels -->
<span class="logo-mini" data-toggle="tooltip" title="{!! trans('admin.adminpanel') !!}">
<b>{!! substr($panelTitle[0], 0, 1) !!}</b>{!! substr($panelTitle[1], 0, 1) !!}</span>
<!-- logo for regular state and mobile devices -->
<span class="logo-lg"><b>{!! $panelTitle[0] !!}</b> {!! $panelTitle[1] !!}</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">

<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
<span class="sr-only">{!! trans('admin.ToggleNavigation') !!}</span>
</a>
<div class="navbar-custom-menu">
<!-- Sidebar toggle button-->

<ul class="nav navbar-nav">

<li class="dropdown messages-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-bell"></i>
<span class="label label-success">{{ $toplamapprove }}</span>
</a>
<ul class="dropdown-menu">
<li class="header">{{ $toplamapprove }} {!! trans('admin.waitingapprove') !!}</li>
<li>
<!-- inner menu: contains the actual data -->
<ul class="menu">
@foreach($waitapprove as $qas)
<li><!-- start message -->
<a href="{{ makeposturl($qas) }}" target="_blank">
<div class="pull-left">
    <img src="{{ makepreview($qas->thumb, 's', 'posts') }}" class="img-circle" alt="User Image">
</div>
<h4>
    {{ $qas->title }}
</h4>
<p><i class="fa fa-clock-o"></i> {{ $qas->created_at->diffForHumans() }}</p>
</a>
</li><!-- end message -->
@endforeach
</ul>
</li>
<li class="footer"><a href=" {{ action('Admin\PostsController@unapprove', ['only' => 'unapprove']) }}">{!! trans('admin.viewall') !!}</a></li>
</ul>
</li>

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="{{ makepreview(Auth::user()->icon, 's', 'members/avatar') }}" class="user-image" alt="User Image">
<span class="hidden-xs">{{  Auth::user()->username }}</span>
</a>
<ul class="dropdown-menu">
<!-- User image -->
<li class="user-header">
<img src="{{ makepreview(Auth::user()->icon, 's', 'members/avatar') }}" class="img-circle" alt="User Image">
<p>
{{ Auth::user()->username }} - {!! trans('admin.Admin') !!}
<small>{!! trans('admin.Membersince') !!} {{  Auth::user()->created_at }}</small>
</p>
</li>
<!-- Menu Footer-->
<li class="user-footer">
<div class="pull-left">
<a href="{{ action('UsersController@index', [Auth::user()->username_slug]) }}" class="btn btn-default btn-flat">{!! trans('admin.Profile') !!}</a>
</div>
<div class="pull-right">
<a href="{{ action('Auth\AuthController@logout') }}" class="btn btn-default btn-flat">{!! trans('admin.Signout') !!}</a>
</div>
</li>
</ul>
</li>

<li class="dropdown notifications-menu">
<a href="{{ action('Admin\ConfigController@index', ['common']) }}" class="dropdown-toggle">
<i class="fa fa-wrench"></i>
</a>
</li>

<li class="dropdown user user-menu">
<a target="_blank" href="{{ action('IndexController@index') }}" class="dropdown-toggle">
<i class="fa fa-hand-o-right"></i>
<span class="hidden-xs">{!! trans('admin.viewsite') !!}</span>
</a>
</li>

</ul>
</div>
</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
@include('_admin._particles.sidebar')
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="page-body-layout" page-data-container>
@include('errors.error')
@yield("content")
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
<div class="pull-right hidden-xs">
<strong>{!! trans('admin.copyright') !!} &copy; {{ date('Y') }} <a href="{{url('/')}}" target="_blank">{{ getcong('sitetitle') }}</a> - </strong> 
{!! trans('admin.all_right_reserved') !!}
</div>
<b><a href="https://emreemir.com/" target="_blank">powered by, Emre Emir</a></b>
</footer>

</div>
<!-- ./wrapper -->
{!! Assets::js('boot') !!}
{!! Assets::js('core') !!}
{!! Assets::js('plugins') !!}
{!! Assets::js('site') !!}
<script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
window.pjaxOnLoad = function() {

AdminApp.init('AdminLTE');
Form.init('section.content > form:first');
WysiwygEditor.init('textarea[data-editor="ck"]');
DataTable.init('#table');

}
</script>

<script type="text/javascript">
$(window).load(function() { 
  window.pjaxOnLoad(); 
    PageAjax.init('#page-body-layout', false, 0, 1000);
});
</script>
@yield('footer')
<div class="hide">
<input type="hidden" name="_requesttoken" id="requesttoken" value="{{ csrf_token() }}" />
</div>

@include('.errors.swalerror')

</body>
</html>