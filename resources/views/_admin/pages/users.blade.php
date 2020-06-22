@extends('_admin.adminapp')
@if(Request::query('order') == 'lastlogin')
@section('title', trans('admin.UsersLastAct'))
@elseif(Request::query('order') == 'lastregister')
@section('title', trans('admin.UsersLastReg'))
@else
@section('title', trans('admin.Users'))
@endif
@section('content')
<? $data_order = ''; ?>
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
@if(Request::query('order') == 'lastlogin')
{!! trans('admin.UsersLastAct') !!}
@elseif(Request::query('order') == 'lastregister')
{!! trans('admin.UsersLastReg') !!}
@else
{!! trans('admin.Users') !!}
@endif
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard')  !!}</a></li>
        <li class="active">{!! trans('admin.Users')  !!}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-body">
                @if(Request::query('order') == 'lastlogin')
                <? $data_order = '5;desc'; ?>
                @elseif(Request::query('order') == 'lastregister')
                <? $data_order = '4;desc'; ?>
                @else
                <? $data_order = '4;asc'; ?>
                @endif

                    <table
                    id="table" 
                    class="table table-bordered table-hover"
                    data-order="{{$data_order}}"
                    data-page-default="10"
                    data-column="icon;username;email;status;created_at;updated_at;action"
                    data-url="{{ action('Admin\UsersController@getdata', ['type' => $type, 'only' => Request::query('only')]) }}"
                    >
                        <thead>
                        <tr>
                            <th style="width: 5%">{!! trans("admin.Tcon")  !!}</th>
                            <th style="width: 10%">{!! trans("admin.User")  !!}</th>
                            <th style="width: 20%">{!! trans("admin.Email")  !!}</th>
                            <th style="width: 15%">{!! trans("admin.Status")  !!}</th>
                            <th style="width: 10%">{!! trans("admin.JoinedAt")  !!}</th>
                            <th style="width: 10%">{!! trans("admin.LastSeen")  !!}</th>
                            <th style="width: 20%">{!! trans("admin.Actions")  !!}</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th style="width: 5%">{!! trans("admin.Tcon")  !!}</th>
                            <th style="width: 10%">{!! trans("admin.User")  !!}</th>
                            <th style="width: 20%">{!! trans("admin.Email")  !!}</th>
                            <th style="width: 15%">{!! trans("admin.Status")  !!}</th>
                            <th style="width: 10%">{!! trans("admin.JoinedAt")  !!}</th>
                            <th style="width: 10%">{!! trans("admin.LastSeen")  !!}</th>
                            <th style="width: 20%">{!! trans("admin.Actions")  !!}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->


@endsection