  <div class="btn-group">
  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
  <i class="fa fa-wrench"></i>
  </button>

  <ul class="dropdown-menu pull-right" role="menu">

              <li>
               <a href="{{action('UsersController@settings', $user->username_slug)}}" 
               target="_blank"
               role="button" 
               data-toggle="tooltip" 
               title="{{trans('admin.edit')}}"
               ><i class="fa fa-edit"></i>{{trans('admin.edit')}}</a>
               </li>

             @if($user->usertype == 'banned')
                  <li>
                   <a
                   href="?userunlock={{$user->id}}"
                   role="button" 
                   data-toggle="tooltip"
                   title="{{trans('admin.UnlockUser')}}"
                   ><i class="fa fa-unlock"></i>{{trans('admin.UnlockUser')}}</a>
                   </li>

             @else
                   <li>
                   <a
                   href="?userlock={{$user->id}}" 
                   role="button" 
                   data-toggle="tooltip" 
                   title="{{trans('admin.lockUser')}}"
                   >
                   <i class="fa fa-lock"></i>{{trans('admin.lockUser')}}</a>
                   </li>

                    @if($user->usertype == 'Admin')
                        <li>
                        <a
                        href="?userunadmin={{$user->id}}" 
                        role="button" 
                        data-toggle="tooltip" 
                        title="{{trans('admin.NotAdmin')}}"
                        >
                        <i class="fa fa-remove"></i>{{trans('admin.NotAdmin')}}</a>
                        </li>

                    @else
                        <li>
                        <a
                        href="?useradmin={{$user->id}}" 
                        role="button" 
                        data-toggle="tooltip" 
                        title="{{trans('admin.MakeAdmin')}}"
                        >
                        <i class="fa fa-user-secret"></i>{{trans('admin.MakeAdmin')}}</a>
                        </li>
                    @if($user->usertype == 'Staff')
                            <li>
                            <a
                            href="?unstaff={{$user->id}}"
                            role="button"
                            data-toggle="tooltip"
                            title="{{trans('admin.NotEditorStaff')}}"
                            >
                            <i class="fa fa-remove"></i>{{trans('admin.NotEditorStaff')}}</a>
                            </li>
                    @else
                            <li>
                            <a
                            href="?staff={{$user->id}}" 
                            role="button" 
                            data-toggle="tooltip" 
                            title="{{trans('admin.MakeEditorStaff')}}"
                            >
                            <i class="fa fa-thumbs-up"></i>{{trans('admin.MakeEditorStaff')}}</a>
                            </li>
                     @endif
                    
                    @endif

                    @if($user->verified == 1)
                        <li>
                        <a
                        href="?unverify={{$user->id}}" 
                        role="button" 
                        data-toggle="tooltip" 
                        title="{{trans('admin.NoVerified')}}"
                        >
                        <i class="fa fa-remove"></i>{{trans('admin.NoVerified')}}</a>
                        </li>
                    @else
                        <li>
                        <a
                        href="?verify={{$user->id}}" 
                        role="button" 
                        data-toggle="tooltip" 
                        title="{{trans('admin.MakeVerified')}}"
                        >
                        <i class="fa fa-check"></i>{{trans('admin.MakeVerified')}}</a>
                        </li>
                    @endif
                        <li>
                        <a
                        href="?remove={{$user->id}}" 
                        role="button" 
                        data-toggle="tooltip" 
                        data-original-title="{{trans('admin.NotRemove')}}"
                        >
                        <i class="fa fa-remove"></i>{{trans('admin.NotRemove')}}</a>
                        </li>
	       @endif