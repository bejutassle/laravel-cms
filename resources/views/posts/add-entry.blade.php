<legend>{!! trans('addpost.addnew') !!}</legend>


    <a class="button button-gray button-small submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="textform" href="{{ action('FormController@addnewform') }}?addnew=text" >
    <i class="fa fa-file-text"></i>
    {!! trans('addpost.text') !!}
    </a>

    @unless($typene=='video')
    <a class="button button-gray button-small submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="imageform" href="{{ action('FormController@addnewform') }}?addnew=image" >
    <i class="fa fa-picture-o"></i>
    {!! trans('addpost.image') !!}
    </a>
    @endunless

    <a class="button button-gray button-small submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="videoform" href="{{ action('FormController@addnewform') }}?addnew=video">
    <i class="fa fa-youtube-play"></i>
    {!! trans('addpost.video') !!}
    </a>

    <a class="button button-gray button-small submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="pollform" href="{{ action('FormController@addnewform') }}?addnew=poll" >
    <i class="fa fa-check-circle-o"></i>
    {!! trans('addpost.option') !!}
    </a>

    <a class="button button-blue button-small submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="tweetform" href="{{ action('FormController@addnewform') }}?addnew=tweet">
    <i class="fa fa-twitter"></i>
    {!! trans('updates.tweet') !!}
    </a>

    <a class="button button-facebook button-small submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="facebookpostform" href="{{ action('FormController@addnewform') }}?addnew=facebookpost">
    <i class="fa fa-facebook"></i>
    {!! trans('updates.facebookpost') !!}
    </a>

    <a class="button button-instagram button-small submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="instagramform" href="{{ action('FormController@addnewform') }}?addnew=instagram">
    <i class="fa fa-instagram"></i>
    {!! trans('updates.instagram') !!}
    </a>

    <a class="button button-black button-small submit-button moreentry" title="{!! trans('updates.more') !!}">
    <i class="fa fa-caret-down"></i>
    </a>


    <div class="moreentrywidget" style="display: none">

     <a class="button button-soundcloud button-small  submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="soundcloudform" href="{{ action('FormController@addnewform') }}?addnew=soundcloud">
    <i class="fa fa-soundcloud"></i>
    {!! trans('updates.soundcloud') !!}
    </a>


    <a class="button button-black button-small submit-button postable" data-method="get" data-target="entries" data-puttype="append" data-type="embedform" href="{{ action('FormController@addnewform') }}?addnew=embed" >
    <i class="fa fa-code"></i>
    {!! trans('addpost.embed') !!}
    </a>

    </div>
