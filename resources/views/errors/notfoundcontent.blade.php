@extends("app")
@section('content')
    <div class="content" >
        <div class="container" style="padding:150px 0 350px 0;text-align: center">
        	 <i class="fa fa-asterisk" aria-hidden="true" style="font-size:85px;"></i>
        	 <br><br>
            <h1>{!! trans('admin.admin_content_not_found') !!}</h1>
            <a href="{{ URL::previous() }}"  style="margin-top:50px" class="button button-big button-black">{!! trans('updates.go_back_page') !!}</a>
        </div>
    </div>
@endsection