/*! Admin app.js
 * ================
 *
 * @Author  Emre Emir
 * @Support <https://www.emreemir.com>
 * @Email   <emre@emreemir.com>
 * @version 1.0.1
 * @license MIT <http://opensource.org/licenses/MIT>
 */
if(typeof jQuery==="undefined"){throw new Error("AdminLTE requires jQuery");}
$.AdminLTE={};$.AdminLTE.options={navbarMenuSlimscroll:true,navbarMenuSlimscrollWidth:"3px",navbarMenuHeight:"200px",animationSpeed:500,sidebarToggleSelector:"[data-toggle='offcanvas']",sidebarPushMenu:true,sidebarSlimScroll:true,sidebarExpandOnHover:false,enableBoxRefresh:true,enableBSToppltip:true,BSTooltipSelector:"[data-toggle='tooltip']",enableFastclick:false,enableControlTreeView:true,enableControlSidebar:true,controlSidebarOptions:{toggleBtnSelector:"[data-toggle='control-sidebar']",selector:".control-sidebar",slide:true},enableBoxWidget:true,boxWidgetOptions:{boxWidgetIcons:{collapse:'fa-minus',open:'fa-plus',remove:'fa-times'},boxWidgetSelectors:{remove:'[data-widget="remove"]',collapse:'[data-widget="collapse"]'}},directChat:{enable:true,contactToggleSelector:'[data-widget="chat-pane-toggle"]'},colors:{lightBlue:"#3c8dbc",red:"#f56954",green:"#00a65a",aqua:"#00c0ef",yellow:"#f39c12",blue:"#0073b7",navy:"#001F3F",teal:"#39CCCC",olive:"#3D9970",lime:"#01FF70",orange:"#FF851B",fuchsia:"#F012BE",purple:"#8E24AA",maroon:"#D81B60",black:"#222222",gray:"#d2d6de"},screenSizes:{xs:480,sm:768,md:992,lg:1200}};$(function(){"use strict";$("body").removeClass("hold-transition");if(typeof AdminLTEOptions!=="undefined"){$.extend(true,$.AdminLTE.options,AdminLTEOptions);}
var o=$.AdminLTE.options;_init();$.AdminLTE.layout.activate();if(o.enableControlTreeView){$.AdminLTE.tree('.sidebar');}
if(o.enableControlSidebar){$.AdminLTE.controlSidebar.activate();}
if(o.navbarMenuSlimscroll&&typeof $.fn.slimscroll!='undefined'){$(".navbar .menu").slimscroll({height:o.navbarMenuHeight,alwaysVisible:false,size:o.navbarMenuSlimscrollWidth}).css("width","100%");}
if(o.sidebarPushMenu){$.AdminLTE.pushMenu.activate(o.sidebarToggleSelector);}
if(o.enableBoxWidget){$.AdminLTE.boxWidget.activate();}
if(o.enableFastclick&&typeof FastClick!='undefined'){FastClick.attach(document.body);}
if(o.directChat.enable){$(document).on('click',o.directChat.contactToggleSelector,function(){var box=$(this).parents('.direct-chat').first();box.toggleClass('direct-chat-contacts-open');});}
$('.btn-group[data-toggle="btn-toggle"]').each(function(){var group=$(this);$(this).find(".btn").on('click',function(e){group.find(".btn.active").removeClass("active");$(this).addClass("active");e.preventDefault();});});});function _init(){'use strict';$.AdminLTE.layout={activate:function(){var _this=this;_this.fix();_this.fixSidebar();$('body, html, .wrapper').css('height','auto');$(window,".wrapper").resize(function(){_this.fix();_this.fixSidebar();});},fix:function(){$(".layout-boxed > .wrapper").css('overflow','hidden');var footer_height=$('.main-footer').outerHeight()||0;var neg=$('.main-header').outerHeight()+footer_height;var window_height=$(window).height();var sidebar_height=$(".sidebar").height()||0;if($("body").hasClass("fixed")){$(".content-wrapper, .right-side").css('min-height',window_height-footer_height);}else{var postSetWidth;if(window_height>=sidebar_height){$(".content-wrapper, .right-side").css('min-height',window_height-neg);postSetWidth=window_height-neg;}else{$(".content-wrapper, .right-side").css('min-height',sidebar_height);postSetWidth=sidebar_height;}
var controlSidebar=$($.AdminLTE.options.controlSidebarOptions.selector);if(typeof controlSidebar!=="undefined"){if(controlSidebar.height()>postSetWidth)
$(".content-wrapper, .right-side").css('min-height',controlSidebar.height());}}},fixSidebar:function(){if(!$("body").hasClass("fixed")){if(typeof $.fn.slimScroll!='undefined'){$(".sidebar").slimScroll({destroy:true}).height("auto");}
return;}else if(typeof $.fn.slimScroll=='undefined'&&window.console){window.console.error("Error: the fixed layout requires the slimscroll plugin!");}
if($.AdminLTE.options.sidebarSlimScroll){if(typeof $.fn.slimScroll!='undefined'){$(".sidebar").slimScroll({destroy:true}).height("auto");$(".sidebar").slimScroll({height:($(window).height()-$(".main-header").height())+"px",color:"rgba(0,0,0,0.2)",size:"3px"});}}},pjaxMenuNav:function(){$('.sidebar-menu .menu-open').removeClass('menu-open').css('display','none');$('.sidebar-menu .active').removeClass('active');var domain_name_=location.protocol+'//'+window.location.host;$(".sidebar-menu a").each(function(){if(($(this).attr('href'))&&(domain_name_+location.pathname+location.search===$(this).attr('href'))){$(this).parents('li').addClass('active');$(this).parents('ul').not('.sidebar-menu').addClass('menu-open').css({display:'block'});}});}};$.AdminLTE.pushMenu={activate:function(toggleBtn){var screenSizes=$.AdminLTE.options.screenSizes;$(document).on('click',toggleBtn,function(e){e.preventDefault();if($(window).width()>(screenSizes.sm-1)){if($("body").hasClass('sidebar-collapse')){$("body").removeClass('sidebar-collapse').trigger('expanded.pushMenu');}else{$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');}}
else{if($("body").hasClass('sidebar-open')){$("body").removeClass('sidebar-open').removeClass('sidebar-collapse').trigger('collapsed.pushMenu');}else{$("body").addClass('sidebar-open').trigger('expanded.pushMenu');}}});$(".content-wrapper").click(function(){if($(window).width()<=(screenSizes.sm-1)&&$("body").hasClass("sidebar-open")){$("body").removeClass('sidebar-open');}});if($.AdminLTE.options.sidebarExpandOnHover||($('body').hasClass('fixed')&&$('body').hasClass('sidebar-mini'))){this.expandOnHover();}},expandOnHover:function(){var _this=this;var screenWidth=$.AdminLTE.options.screenSizes.sm-1;$('.main-sidebar').hover(function(){if($('body').hasClass('sidebar-mini')&&$("body").hasClass('sidebar-collapse')&&$(window).width()>screenWidth){_this.expand();}},function(){if($('body').hasClass('sidebar-mini')&&$('body').hasClass('sidebar-expanded-on-hover')&&$(window).width()>screenWidth){_this.collapse();}});},expand:function(){$("body").removeClass('sidebar-collapse').addClass('sidebar-expanded-on-hover');},collapse:function(){if($('body').hasClass('sidebar-expanded-on-hover')){$('body').removeClass('sidebar-expanded-on-hover').addClass('sidebar-collapse');}}};$.AdminLTE.tree=function(menu){var _this=this;var animationSpeed=$.AdminLTE.options.animationSpeed;$(document).off('click',menu+' li a').on('click',menu+' li a',function(e){var $this=$(this);var checkElement=$this.next();if((checkElement.is('.treeview-menu'))&&(checkElement.is(':visible'))&&(!$('body').hasClass('sidebar-collapse'))){checkElement.slideUp(animationSpeed,function(){checkElement.removeClass('menu-open');});checkElement.parent("li").removeClass("active");}
else if((checkElement.is('.treeview-menu'))&&(!checkElement.is(':visible'))){var parent=$this.parents('ul').first();var ul=parent.find('ul:visible').slideUp(animationSpeed);ul.removeClass('menu-open');var parent_li=$this.parent("li");checkElement.slideDown(animationSpeed,function(){checkElement.addClass('menu-open');parent.find('li.active').removeClass('active');parent_li.addClass('active');_this.layout.fix();});}
if(checkElement.is('.treeview-menu')){e.preventDefault();}});};$.AdminLTE.controlSidebar={activate:function(){var _this=this;var o=$.AdminLTE.options.controlSidebarOptions;var sidebar=$(o.selector);var btn=$(o.toggleBtnSelector);btn.on('click',function(e){e.preventDefault();if(!sidebar.hasClass('control-sidebar-open')&&!$('body').hasClass('control-sidebar-open')){_this.open(sidebar,o.slide);}else{_this.close(sidebar,o.slide);}});var bg=$(".control-sidebar-bg");_this._fix(bg);if($('body').hasClass('fixed')){_this._fixForFixed(sidebar);}else{if($('.content-wrapper, .right-side').height()<sidebar.height()){_this._fixForContent(sidebar);}}},open:function(sidebar,slide){if(slide){sidebar.addClass('control-sidebar-open');}else{$('body').addClass('control-sidebar-open');}},close:function(sidebar,slide){if(slide){sidebar.removeClass('control-sidebar-open');}else{$('body').removeClass('control-sidebar-open');}},_fix:function(sidebar){var _this=this;if($("body").hasClass('layout-boxed')){sidebar.css('position','absolute');sidebar.height($(".wrapper").height());if(_this.hasBindedResize){return;}
$(window).resize(function(){_this._fix(sidebar);});_this.hasBindedResize=true;}else{sidebar.css({'position':'fixed','height':'auto'});}},_fixForFixed:function(sidebar){sidebar.css({'position':'fixed','max-height':'100%','overflow':'auto','padding-bottom':'50px'});},_fixForContent:function(sidebar){$(".content-wrapper, .right-side").css('min-height',sidebar.height());}};$.AdminLTE.boxWidget={selectors:$.AdminLTE.options.boxWidgetOptions.boxWidgetSelectors,icons:$.AdminLTE.options.boxWidgetOptions.boxWidgetIcons,animationSpeed:$.AdminLTE.options.animationSpeed,activate:function(_box){var _this=this;if(!_box){_box=document;}
$(_box).on('click',_this.selectors.collapse,function(e){e.preventDefault();_this.collapse($(this));});$(_box).on('click',_this.selectors.remove,function(e){e.preventDefault();_this.remove($(this));});},collapse:function(element){var _this=this;var box=element.parents(".box").first();var box_content=box.find("> .box-body, > .box-footer, > form  >.box-body, > form > .box-footer");if(!box.hasClass("collapsed-box")){element.children(":first").removeClass(_this.icons.collapse).addClass(_this.icons.open);box_content.slideUp(_this.animationSpeed,function(){box.addClass("collapsed-box");});}else{element.children(":first").removeClass(_this.icons.open).addClass(_this.icons.collapse);box_content.slideDown(_this.animationSpeed,function(){box.removeClass("collapsed-box");});}},remove:function(element){var box=element.parents(".box").first();box.slideUp(this.animationSpeed);}};}
(function($){"use strict";$.fn.boxRefresh=function(options){var settings=$.extend({trigger:".refresh-btn",source:"",onLoadStart:function(box){return box;},onLoadDone:function(box){return box;}},options);var overlay=$('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');return this.each(function(){if(settings.source===""){if(window.console){window.console.log("Please specify a source first - boxRefresh()");}
return;}
var box=$(this);var rBtn=box.find(settings.trigger).first();rBtn.on('click',function(e){e.preventDefault();start(box);box.find(".box-body").load(settings.source,function(){done(box);});});});function start(box){box.append(overlay);settings.onLoadStart.call(box);}
function done(box){box.find(overlay).remove();settings.onLoadDone.call(box);}};})(jQuery);(function($){'use strict';$.fn.activateBox=function(){$.AdminLTE.boxWidget.activate(this);};$.fn.toggleBox=function(){var button=$($.AdminLTE.boxWidget.selectors.collapse,this);$.AdminLTE.boxWidget.collapse(button);};$.fn.removeBox=function(){var button=$($.AdminLTE.boxWidget.selectors.remove,this);$.AdminLTE.boxWidget.remove(button);};})(jQuery);(function($){'use strict';$.fn.todolist=function(options){var settings=$.extend({onCheck:function(ele){return ele;},onUncheck:function(ele){return ele;}},options);return this.each(function(){if(typeof $.fn.iCheck!='undefined'){$('input',this).on('ifChecked',function(){var ele=$(this).parents("li").first();ele.toggleClass("done");settings.onCheck.call(ele);});$('input',this).on('ifUnchecked',function(){var ele=$(this).parents("li").first();ele.toggleClass("done");settings.onUncheck.call(ele);});}else{$('input',this).on('change',function(){var ele=$(this).parents("li").first();ele.toggleClass("done");if($('input',ele).is(":checked")){settings.onCheck.call(ele);}else{settings.onUncheck.call(ele);}});}});};}(jQuery));var WysiwygEditor={init:function(element){if($(element)[0]){CKEDITOR.config.removePlugins='save, newpage, flash, about, iframe, language';CKEDITOR.replace('textarea');}
if($('#compose-textarea')[0]){$('#compose-textarea').wysihtml5();}}};var AdminApp={init:function(method){$.AdminLTE.layout.pjaxMenuNav();$.widget.bridge('uibutton',$.ui.button);if($('[data-toggle="tooltip"]')[0]){$('[data-toggle="tooltip"]').livequery(function(){$(this).tooltipster({multiple:true});});}
function readURL(input,img_id){if(input.files&&input.files[0]){var reader=new FileReader();reader.onload=function(e){$('img[img-id="'+img_id+'"]').attr('src',e.target.result);}
reader.readAsDataURL(input.files[0]);}}
$('input[img-id]').change(function(){readURL(this,$(this).attr('img-id'));});var selectOptionVal=$('select[data-hidden="true"] option:selected').val();$("[data-hidden-par='"+selectOptionVal+"']").slideToggle("slow",function(){});$('select[data-hidden="true"]').on('change',function(){$('[data-hidden-par]').slideToggle("slow",function(){});var optionVal=$(this).val();var valElement=$("[data-hidden-par='"+optionVal+"']");var divElement=$('div').find("[data-hidden-par='"+optionVal+"']").html();if(divElement===undefined){valElement.hide();}else{valElement.show();}});if($('.select2')[0]){$('.select2').select2({theme:'bootstrap',containerCssClass:':all:'});}
if($('input[type="checkbox"].flat-red, input[type="radio"].flat-red')[0]){$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({checkboxClass:'icheckbox_flat-green',radioClass:'iradio_flat-green'});}
if($('.my-colorpicker1')[0]){$(".my-colorpicker1").colorpicker();}
if($('.my-colorpicker2')[0]){$(".my-colorpicker2").colorpicker();}},reload:function(container,url){$.pjax.reload({container:container,timeout:false,url:url,async:true});},message:function(lang,xhr,status){swal(lang,xhr,status);}};var DataTable={init:function(element){var table=$(element);if($(table)[0]){var url_=table.attr('data-url');var page_=table.attr('data-page-default');var order_=table.attr('data-order').split(';');var column_=table.attr('data-column').split(';');var column_data=new Array();column_.forEach(function(value,index){if(index==0){var width_='2%';}
if(index==1){var width_='50%';}
if(index==2){var width_='20%';}
if(index==3){var width_='20%';}
if(index==4){var width_='17%';}
if(index==4){var orderable_=true;}else{var orderable_=false;}
if(index==5){var width_='1%';}
if(index==6){var width_='1%';}
column_data.push({data:value,name:value,orderable:orderable_,searchable:false,'width':width_});});var columns_=JSON.stringify(column_data);table.dataTable({pagingType:'full_numbers',order:[[order_[0],order_[1]]],bDestroy:true,processing:true,serverSide:true,autoWidth:false,iDisplayStart:0,lengthMenu:[[10,20,30,40,50,-1],[10,20,30,40,50,DataTables.sAll]],pageLength:page_,initComplete:function(settings,json){AdminApp.init();},'language':{'sDecimal':',','sEmptyTable':DataTables.sEmptyTable,'sInfo':DataTables.sInfo,'sInfoEmpty':DataTables.sInfoEmpty,'sInfoFiltered':DataTables.sInfoFiltered,'sInfoPostFix':'','sInfoThousands':'.','sLengthMenu':DataTables.sLengthMenu,'sLoadingRecords':DataTables.sLoadingRecords,'sProcessing':DataTables.sProcessing,'sSearch':DataTables.sSearch,'sZeroRecords':DataTables.sZeroRecords,'oPaginate':{'sFirst':DataTables.sFirst,'sLast':DataTables.sLast,'sNext':DataTables.sNext,'sPrevious':DataTables.sPrevious},'oAria':{'sSortAscending':DataTables.sSortAscending,'sSortDescending':DataTables.sSortDescending}},ajax:url_,columns:JSON.parse(columns_),});}}};var Form={init:function(element){$(element).keyup(function(event){if(event.keyCode==13){$('input[type="button"]').click();}});$('input[type="button"]').click(function(){var form=$(element).attr('form');var data=new FormData($(element)[0]);var action=$(element).attr('action');var method=$(element).attr('method');var type=$(element).attr('data-type');if($('textarea[data-editor="ck"]')[0]){var textareaName=$('textarea[data-editor="ck"]').attr('name');var textareaData=CKEDITOR.instances.textarea.getData();data.append(textareaName,textareaData);}
$.ajax({url:action,type:method,dataType:type,data:data,processData:false,contentType:false,cache:false,success:function(data){$('form').each(function(){$(this).find('+span').removeClass('help-block').text('');if(form=='settings'){$(this).find(':input').parent().parent().attr('for','inputSuccess');$(this).find(':input').parent().parent().removeClass('has-error').addClass('has-success');}else{$(this).find(':input').parent().attr('for','inputSuccess');$(this).find(':input').parent().removeClass('has-error').addClass('has-success');}});AdminApp.reload('#page-body-layout',data.url);AdminApp.message(Lang.lang_19,data.message,'success');},error:function(xhr,status,response){var error=jQuery.parseJSON(xhr.responseText);$('form').each(function(){$(this).find('+span').removeClass('help-block').text('');if(form=='settings'){$(this).find(':input').parent().parent().attr('for','inputSuccess');$(this).find(':input').parent().parent().removeClass('has-error').addClass('has-success');}else{$(this).find(':input').parent().attr('for','inputSuccess');$(this).find(':input').parent().removeClass('has-error').addClass('has-success');}});$.each(error.message,function(key,value){var input='form input[name='+key+'], form textarea[name='+key+']';$(input).find('+span').addClass('help-block').text(value);if(form=='settings'){$(input).parent().parent().attr('for','inputError');$(input).parent().parent().removeClass('has-success').addClass('has-error');}else{$(input).parent().attr('for','inputError');$(input).parent().removeClass('has-success').addClass('has-error');}});$('html, body').animate({scrollTop:$('form').find('div[for="inputError"]').first().offset().top},500);}});});$('a[data-role="del"]').on("click",function(e){e.preventDefault();var data_id=$(this).attr('data-id');var data_send=$(this).attr('data-post');swal({title:Lang.lang_1,text:Lang.lang_2,type:'warning',showCancelButton:true,confirmButtonColor:'#00a65a',cancelButtonColor:'#c9302c',confirmButtonText:Lang.lang_3,cancelButtonText:Lang.lang_4,preConfirm:function(){return new Promise(function(resolve){$.ajax({url:data_send,type:'GET',data:{id:data_id},cache:false,dataType:'JSON',success:function(data){$.pjax.reload({container:'#page-body-layout',timeout:false,async:true});AdminApp.message(Lang.lang_19,data.message,'success');}});});}}).then(function(result){},function(dismiss){if(dismiss==='cancel'){swal(Lang.lang_17,Lang.lang_18,'error')}});});}};var PageAjax={init:function(container,scrollto,cache,timeout){if($.support.pjax){$.pjax.defaults.scrollTo=scrollto;$.pjax.defaults.timeout=timeout;$.pjax.defaults.maxCacheLength=cache;$(document).pjax('a',{container:container,});$(document).on('pjax:send',function(e){$('*').css({'cursor':'wait'});e.preventDefault();});$(document).on('pjax:complete',function(e){$('*').css({'cursor':''});e.preventDefault();});$(document).on('pjax:start',function(e){Pace.restart();});$(document).on('pjax:end',function(e){Pace.stop();});$(document).on('pjax:timeout',function(e){e.preventDefault();});$(document).on('ready pjax:end',function(e){window.pjaxOnLoad();});}}};var Buzzy=function(){var t=function(){var t=$("#requesttoken").val();$(".sendtrash").on("click",function(){var t=$(this).attr("href");return swal({title:Lang.lang_15,text:Lang.lang_16,type:"warning",showCancelButton:!0,closeOnConfirm:!1,confirmButtonColor:"#DD6B55",confirmButtonText:Lang.lang_3,showLoaderOnConfirm:!0},function(){setTimeout(function(){location.href=t},500)}),!1}),$(".activebut").on("click",function(){var e=$(this).attr("data-item"),o=$(this).attr("data-verify"),r=$(this).parents(".box-widget").find(".overlay");r.removeClass("hide"),$.ajax({type:"POST",dataType:"json",url:"/admin/activeteplugin",data:{dataitem:e,dataverify:o,_token:t},success:function(t){var e=t.type,o=t.status,a=t.errors,n=t.message;t.url;"Error"==o?swal({type:"warning",title:"Error",text:a,timer:2e3,showConfirmButton:!1}):"error"==e?swal({type:"warning",title:"Error",text:n,timer:2e3,showConfirmButton:!1}):"success"==e&&location.reload(),setTimeout(function(){r.addClass("hide")},1e3)}})})};return{init:function(){t()}}}();