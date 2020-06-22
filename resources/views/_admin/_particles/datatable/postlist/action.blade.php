	<div class="btn-group">
	<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	<i class="fa fa-wrench"></i>
	</button>

	<ul class="dropdown-menu pull-right" role="menu">

         @if($post->deleted_at == null)

            @if($post->approve == 'no')

                <li>
                <a href="{{action('Admin\PostsController@approvepost',  $post->id)}}">
                <i class="fa fa-check"></i> {{trans('admin.Approve')}}</a>
                </li>

            @elseif($post->approve == 'yes')

                <li>
                <a href="{{action('Admin\PostsController@approvepost',  $post->id)}}">
                <i class="fa fa-remove"></i> {{trans('admin.UndoApprove')}}</a>
                </li>

	@endif

            @if($post->featured_at == null)

                <li>
                <a href="{{action('Admin\PostsController@pickfeatured',  $post->id)}}">
                <i class="fa fa-star"></i> {{trans('admin.PickforFeatured')}}</a>
                </li>

            @else

                <li>
                <a href="{{action('Admin\PostsController@pickfeatured',  $post->id)}}">
                <i class="fa fa-remove"></i> {{trans('admin.UndoFeatured')}}</a>
                </li>

            @endif

            @if($post->show_in_homepage == null)

                <li>
                <a href="{{action('Admin\PostsController@showhomepage',  $post->id)}}">
                <i class="fa fa-dashboard"></i> {{trans('admin.PickforHomepage')}}</a>
                </li>

            @elseif($post->show_in_homepage=='yes')

                <li>
                <a href="{{action('Admin\PostsController@showhomepage',  $post->id)}}">
                <i class="fa fa-remove"></i> {{trans("admin.UndofromHomepage")}}</a>
                </li>

            @endif

             <li class="divider"></li>

             <li>
             <a target="_blank" href="/edit/{{$post->id}}"><i class="fa fa-edit"></i> {{trans('admin.EditPost')}}</a>
             </li>

             <li class="divider"></li>

            @endif

            @if($post->deleted_at == null)

                <li>
                <a class="sendtrash" href="{{action('Admin\PostsController@sendtrashpost',  $post->id)}}">
                <i class="fa fa-trash"></i> {{trans('admin.SendtoTrash')}}</a>
                </li>

            @else

                <li>
                <a href="{{action('Admin\PostsController@sendtrashpost',  $post->id)}}">
                <i class="fa fa-trash"></i> {{trans('admin.RetrievefromTrash')}}</a>
                </li>

            @endif

             <li>
             <a class="permanently" href="{{action('Admin\PostsController@forcetrashpost',  $post->id)}}">
             <i class="fa fa-remove"></i> {{trans('admin.Deletepermanently')}}</a>
             </li>

             </ul>
             </div>