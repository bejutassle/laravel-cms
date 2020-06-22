@extends("pages.users.userapp")
@section("usercontent")
    <div class="profile-section-header">
        <a class="profile-section-item @if(Request::segment(3)=='') active @endif" href="{{ action('UsersController@index', $userinfo->username_slug) }}">{!! trans('index.all') !!}</a>

        @if($DB_PLUGIN_NEWS == 'on')<a class="profile-section-item @if(Request::segment(3) == active_state_url(action('UsersController@news', $userinfo->username_slug))) active @endif" href="{{ action('UsersController@news', $userinfo->username_slug) }}">{!! trans('index.news') !!}</a>@endif
        @if($DB_PLUGIN_LISTS == 'on')<a class="profile-section-item @if(Request::segment(3) == active_state_url(action('UsersController@lists', $userinfo->username_slug))) active @endif" href="{{ action('UsersController@lists', $userinfo->username_slug) }}">{!! trans('index.lists') !!}</a>@endif
        @if($DB_PLUGIN_QUIZS == 'on')<a class="profile-section-item @if(Request::segment(3) == active_state_url(action('UsersController@quizzes', $userinfo->username_slug))) active @endif" href="{{ action('UsersController@quizzes', $userinfo->username_slug) }}">{!! trans('quiz.quizzes') !!}</a>@endif
        @if($DB_PLUGIN_POLLS == 'on')<a class="profile-section-item @if(Request::segment(3) == active_state_url(action('UsersController@polls', $userinfo->username_slug))) active @endif" href="{{ action('UsersController@polls', $userinfo->username_slug) }}">{!! trans('index.polls') !!}</a>@endif
        @if($DB_PLUGIN_VIDEOS == 'on')<a class="profile-section-item @if(Request::segment(3) == active_state_url(action('UsersController@videos', $userinfo->username_slug))) active @endif" href="{{ action('UsersController@videos', $userinfo->username_slug) }}">{!! trans('index.videos') !!}</a>@endif
    </div>
    <div class="recent-activity">

        @if($lastPosts->total() > 0)
            <ul class="items_lists res-lists">

                @foreach($lastPosts as $item)
                    @include('._particles._lists.items_list', ['listtype' => 'bolb titb','descof' => 'on','linkcolor' => 'default'])
                @endforeach
            </ul>
            @else
            @include('errors.emptycontent')
        @endif
    </div>
{!! $lastPosts->render() !!}
@endsection