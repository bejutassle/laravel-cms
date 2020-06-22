@if(getcong('mouse_right_click') == true)
function disableselect(e){
return false
}
 
function reEnable(){
return true
}
 
document.onselectstart=new Function ("return false")
 
if (window.sidebar){
document.onmousedown=disableselect
document.onclick=reEnable
}

function disableSelection(target){
if (typeof target.onselectstart!="undefined") //For IE 
    target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined") //For Firefox
    target.style.MozUserSelect="none"
else //All other route (For Opera)
    target.onmousedown=function(){return false}
target.style.cursor = "default"
}

disableSelection(document.body);
@endif
<? lang_to_json(array_add(trans('updates.Editor.lang'), 'errorl', trans('updates.error')), ['title' => 'Lang']); ?>
<? lang_to_json(trans('admin.DataTables.lang'), ['title' => 'DataTables']); ?>
Simditor.i18n = { <? lang_to_json(trans('updates.Editor.TextEditor'), ['title' => 'en_EN', 'order' => true]); ?> };