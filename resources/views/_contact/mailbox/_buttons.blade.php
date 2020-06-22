<div class="mailbox-controls" style="position: relative">
    <div class="pull-right paginate" >
        {!!  $lastmails->render()  !!}

    </div>
    <div class="clear"></div>

    <!-- Check all button -->
    <div class="cho">
        <input type="checkbox" class="checkbox-toggle">
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle doaction" data-type="move"   data-action="trash" data-toggle="dropdown" aria-expanded="true"><span class="fa fa-trash" style="margin-right:5px"></span> {!! trans('admin.mail_trash') !!} </button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> {!! trans('admin.mail_action') !!} <span class="fa fa-caret-down" style="margin-left:5px"></span></button>
        <ul class="dropdown-menu pull-left" style="left:0px;  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);">
            <li><a href="javascript:" class="doaction"  data-type="do" data-action="read"><i class="fa fa-check text-green"></i> {!! trans('admin.mail_read') !!} </a></li>
            <li><a href="javascript:" class="doaction" data-type="do" data-action="unread"><i class="fa fa-check"></i> {!! trans('admin.mail_unread') !!}</a></li>
            <li><a href="javascript:" class="doaction" data-type="do" data-action="stared"><i class="fa fa-star text-yellow"></i> {!! trans('admin.mail_stared') !!}</a></li>
            <li><a href="javascript:" class="doaction" data-type="do" data-action="unstared"><i class="fa fa-star"></i> {!! trans('admin.mail_unstared') !!}</a></li>
            <li><a href="javascript:" class="doaction" data-type="do" data-action="important"><i class="fa fa-flag text-red"></i> {!! trans('admin.mail_important') !!}</a></li>
            <li><a href="javascript:" class="doaction" data-type="do" data-action="unimportant"><i class="fa fa-flag"></i> {!! trans('admin.mail_unimportant') !!}</a></li>
            <li class="divider"></li>
            <li><a href="javascript:" class="doaction" data-type="deleteperma" data-action="deleteperma"><i class="fa fa-remove"></i> {!! trans('admin.mail_del_permanently') !!}</a></li>
        </ul>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">{!! trans('admin.mail_move') !!} <span class="fa fa-caret-down" style="margin-left:5px"></span></button>
        <ul class="dropdown-menu pull-left" style="left:0px;  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);">
@foreach($mailcat as $i => $category)
<li class="{{ Request::segment(3)==$category->name_slug ? 'hide' : ""}}">
<a href="javascript:" class="doaction" data-type="move" data-action="{{ $category->name_slug  }}" ><i class="fa fa-{{ $category->description }}"></i> {!! trans('admin.mail_move_to', ['to' => $category->name]) !!} </a></li>
@endforeach
@foreach($mailprivatecat as $i => $category)
<li class="{{ Request::segment(3)==$category->name_slug ? 'hide' : ""}}">
<a href="javascript:" class="doaction" data-type="move" data-action="{{ $category->name_slug  }}"><i  class="fa fa-folder" style="color: {{ $category->description }} !important;"></i> {!! trans('admin.mail_move_to', ['to' => $category->name]) !!} </a></li>
@endforeach

        </ul>
    </div>


    <!-- /.pull-right -->
</div>