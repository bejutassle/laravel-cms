@if($post->deleted_at !== null) 

    <div class="label label-danger" style="text-align: center;">{{trans('admin.OnTrash')}}</div>

@elseif($post->approve == 'draft')

    <div class="label label-info" style="text-align: center; background-color: #9c486c !important;">{{trans('admin.DraftPost')}}</div>

@elseif($post->approve == 'no') 

    <div class="label label-info" style="text-align: center; background-color: #9c6a11 !important;">{{trans('admin.AwaitingApproval')}}</div>

@elseif($post->featured_at !== null)

    <div class="clear"></div><div class="label label-warning" style="text-align: center; background-color: #9C5D54 !important;">{{trans('admin.FeaturedPost')}}</div>

@elseif($post->approve == 'yes')

    <div class="label label-info" style="text-align: center;">{{trans('admin.Active')}}</div>

@endif

@if($post->show_in_homepage == 'yes')

    <div class="clear"></div>
    <div class="label label-success" style="text-align: center;">{{trans('admin.Pickedforhomepage')}}</div>

@endif