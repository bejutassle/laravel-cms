<? Assets::add(['/assets/plugins/editor/jquery.form.js', '/assets/plugins/editor/sortable.js', '/assets/plugins/editor/module.min.js', '/assets/plugins/editor/hotkeys.min.js', '/assets/plugins/editor/simditor.js', '/assets/plugins/jquery.tagsinput.min.js'], 'js', 'create-post'); ?>
<script src="{{URL::asset('js/main-app.js')}}"></script>
<script src="{{URL::asset('assets/js/editor.min.js')}}"></script>
<script>
$(document).ready(function() {
Editor.init();
Editor.EditorInit();
$('#tags').tagsInput({width:'auto', 'height':'auto','defaultText':'{!! trans('updates.addatag') !!}',
'minChars' : 2,
'maxChars' : 50,
});
});
</script>
<script async defer src="//platform.instagram.com/{{  getcong('sitelanguage') > "" ? getcong('sitelanguage') : 'en_US' }}/embeds.js"></script>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/{{  getcong('sitelanguage') > "" ? getcong('sitelanguage') : 'en_US' }}/sdk.js#xfbml=1&version=v2.5";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>