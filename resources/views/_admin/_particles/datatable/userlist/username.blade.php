	<a href="{{action('UsersController@index', $user->username_slug)}}"  target="_blank">{{$user->username}}</a>
	<div class=clear></div>

                @if($user->facebookurl)

                <a href="{{$user->facebookurl}}" 
                target="_blank" 
                class="btn btn-social-icon btn-facebook" 
                style="height: 24px; width: 24px; margin-right:5px; margin-top:5px"
                >
                <i class="fa fa-facebook" style="line-height: 24px;font-size: 1.2em;"></i>
                </a>

                @endif

                @if($user->twitterurl)

                 <a href="{{$user->twitterurl}}" 
                 target="_blank" 
                 class="btn btn-social-icon btn-twitter" 
                 style="height: 24px; width: 24px; margin-top:5px; margin-right:5px;"
                 >
                 <i class="fa fa-twitter" style="line-height: 24px; font-size: 1.2em;"></i>
                 </a>

                @endif

                @if($user->verified)

                 <a 
                 class="btn btn-social-icon btn-google" 
                 style="cursor:pointer; height: 24px; width: 24px; margin-top:5px;" 
                 data-toggle="tooltip"
                 title="{{trans('index.verified')}}"
                 >
                 <i class="fa fa-check" style="line-height: 24px; font-size: 1.2em;"></i>
                 </a>

                @endif