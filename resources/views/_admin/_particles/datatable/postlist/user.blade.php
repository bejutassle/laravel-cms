<div style="font-weight: 400;color:#aaa">
<a href="{{action('UsersController@index', ['userslug' => $post['user']['username_slug']])}}" target="_blank">
<img src="{{makepreview($post['user']['icon'], 's', 'members/avatar')}}" width="32" style="margin-right:6px">{{$post['user']['username']}}</a>
</div>