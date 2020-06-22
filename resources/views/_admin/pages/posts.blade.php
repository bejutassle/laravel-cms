@extends('_admin.adminapp')
@section('title', $title)
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @if(Request::query('only') == 'unapprove')  {!! trans('admin.Unapproved', ['type' => $title])  !!} @elseif(Request::query('only') == 'deleted') {!! trans('admin.Trash', ['type' => $title])  !!}  @else {{ $title }} @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard')  !!}</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-body">
                    <table 
                    id="table" 
                    class="table table-bordered table-hover"
                    data-order="4;desc"
                    data-page-default="10"
                    data-column="thumb;title;user;approve;created_at;action"
                    data-url="{{ action('Admin\PostsController@getdata', ['type' => $type, 'only' => Request::query('only')]) }}"
                    >
                        <thead>
                        <tr>
                            <th>{!! trans('admin.Preview')  !!}</th>
                            <th>{!! trans('admin.Title')  !!}</th>
                            <th>{!! trans('admin.User')  !!}</th>
                            <th>{!! trans('admin.Status')  !!}</th>
                            @if($type == 'features')
                                <th>{!! trans('admin.FeaturedDate')  !!}</th>
                            @else
                                <th>{!! trans('admin.Dates')  !!}</th>
                            @endif
                            <th>{!! trans('admin.Actions')  !!}</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>{!! trans('admin.Preview')  !!}</th>
                            <th>{!! trans('admin.Title')  !!}</th>
                            <th>{!! trans('admin.User')  !!}</th>
                            <th>{!! trans('admin.Status')  !!}</th>
                            @if($type == 'features')
                                <th>{!! trans('admin.FeaturedDate')  !!}</th>
                            @else
                                <th>{!! trans('admin.Dates')  !!}</th>
                            @endif
                            <th>{!! trans('admin.Actions')  !!}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->


@endsection