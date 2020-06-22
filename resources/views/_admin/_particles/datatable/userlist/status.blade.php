        @if($user->usertype == 'Admin')
            <div class="label label-danger">{{trans('admin.admin')}}</div>
        @elseif($user->usertype == 'Staff')
            <div class="label label-warning">{{trans('admin.StaffEditor')}}</div>
        @elseif($user->usertype == 'banned')
            <div class="label label-default">{{trans('admin.Banned')}}</div>
         @else
            <div class="label label-info">{{trans('admin.Member')}}</div>
         @endif