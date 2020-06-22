var WysiwygEditor = {
    init: function(element) {

        if ($(element)[0]) {
            CKEDITOR.config.removePlugins = 'save, newpage, flash, about, iframe, language';
            CKEDITOR.replace('textarea');
        }

        if ($('#compose-textarea')[0]) {
            $('#compose-textarea').wysihtml5();
        }

    }

};


var AdminApp = {
    init: function(method) {

    $.AdminLTE.layout.pjaxMenuNav();
    $.widget.bridge('uibutton', $.ui.button);

    if($('[data-toggle="tooltip"]')[0]){
        $('[data-toggle="tooltip"]').livequery(function () {
            $(this).tooltipster({
                multiple: true
            });
        });
    }

 function readURL(input, img_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('img[img-id="'+img_id+'"]').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $('input[img-id]').change(function(){
        readURL(this, $(this).attr('img-id'));
    });


    var selectOptionVal = $('select[data-hidden="true"] option:selected').val();
    $("[data-hidden-par='" + selectOptionVal + "']").slideToggle( "slow", function() {
        // Animation complete.
      });

    $('select[data-hidden="true"]').on('change', function() {
      
      $('[data-hidden-par]').slideToggle("slow", function() {
        // Animation complete.
      });

      var optionVal = $(this).val();
      var valElement = $("[data-hidden-par='" + optionVal + "']");
      var divElement = $('div').find("[data-hidden-par='" + optionVal + "']").html();

      if(divElement === undefined){
      valElement.hide();
      }else{
      valElement.show();
      }

});

//Web Site Layout Config

/*
        $('#font').higooglefonts({          
        selectedCallback:function(e){
            console.log(e);
        },
        loadedCallback:function(e){
            console.log(e);
            $("p").css("font-family", e);
        }           
        });
*/
        //Initialize Select2 Elements
        if ($('[data-toggle="select"]')[0]) {

        $('[data-toggle="select"]').livequery(function () {

            $(this).select2({
                dropdownAutoWidth : true
            });

        });

        }
        //iCheck for checkbox and radio inputs
        //Flat red color scheme for iCheck
        if ($('input[type="checkbox"].flat-red, input[type="radio"].flat-red')[0]) {
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        }

        //Colorpicker
        if ($('.my-colorpicker1')[0]) {
        $(".my-colorpicker1").colorpicker();
        }
        //color picker with addon
        if ($('.my-colorpicker2')[0]) {
        $(".my-colorpicker2").colorpicker();
        }

//Web Site Layout Config

    },

    reload: function (container, url) {

            //if(url)

            $.pjax.reload({
                container: container, 
                timeout: false, 
                url: url, 
                async: true
            });

    },

    message: function (lang, xhr, status) {

            swal(lang, xhr, status);

    }

};

var DataTable = {

    init: function(element) {



var table = $(element);


if($(table)[0]){

var url_ = table.attr('data-url'); 
var page_ = table.attr('data-page-default');
var order_  = table.attr('data-order').split(';');
var column_ = table.attr('data-column').split(';');
var column_data = new Array();

column_.forEach(function (value, index) {
    if(index == 0){
        var width_ = '2%';
    }
    if(index == 1){
        var width_ = '50%';
    }
    if(index == 2){
        var width_ = '20%';
    }
    if(index == 3){
        var width_ = '20%';
    }
    if(index == 4){
        var width_ = '17%';
    }
    if(index == 4){
        var orderable_ = true;
    }else{
        var orderable_ = false;
    }
    if(index == 5){
        var width_ = '1%';
    }
    if(index == 6){
        var width_ = '1%';
    }
    column_data.push({data: value, name: value, orderable: orderable_, searchable: false, 'width': width_});
});

var columns_ = JSON.stringify(column_data);

table.dataTable({
    pagingType : 'full_numbers',
    order: [[ order_[0], order_[1]]],
    bDestroy: true,
    processing: true,
    serverSide: true,
    autoWidth: false,
    iDisplayStart: 0,
    lengthMenu: [[10, 20, 30, 40, 50, -1], [10, 20, 30, 40, 50, DataTables.sAll]],
    pageLength: page_,
    initComplete: function(settings, json) {
    AdminApp.init();
    },
    'language': {
        'sDecimal':        ',',
        'sEmptyTable':   DataTables.sEmptyTable,
        'sInfo':           DataTables.sInfo,
        'sInfoEmpty':      DataTables.sInfoEmpty,
        'sInfoFiltered':   DataTables.sInfoFiltered,
        'sInfoPostFix':    '',
        'sInfoThousands':  '.',
        'sLengthMenu':     DataTables.sLengthMenu,
        'sLoadingRecords': DataTables.sLoadingRecords,
        'sProcessing':     DataTables.sProcessing,
        'sSearch':         DataTables.sSearch,
        'sZeroRecords':  DataTables.sZeroRecords,
        'oPaginate': {
            'sFirst':    DataTables.sFirst,
            'sLast':     DataTables.sLast,
            'sNext':     DataTables.sNext,
            'sPrevious': DataTables.sPrevious
        },
        'oAria': {
            'sSortAscending':  DataTables.sSortAscending,
            'sSortDescending': DataTables.sSortDescending
        }
    },
    ajax: url_,
    columns: JSON.parse(columns_),
});

}

}

};

var Form = {

    init: function(element) {

    $(element).keyup(function(event){
        if(event.keyCode == 13){
            $('input[type="button"]').click();
        }
    });


//Special Form Post Pjax

$('input[type="button"]').click(function() {

var form     = $(element).attr('form');
var data     = new FormData($(element)[0]);
var action   = $(element).attr('action');
var method   = $(element).attr('method');
var type     = $(element).attr('data-type');

if ($('textarea[data-editor="ck"]')[0]) {
var textareaName = $('textarea[data-editor="ck"]').attr('name');
var textareaData = CKEDITOR.instances.textarea.getData();
data.append(textareaName, textareaData);
}

$.ajax({
    url: action,
    type: method,
    dataType: type,
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    success: function(data){
            $('form').each(function(){
            $(this).find('+span').removeClass('help-block').text('');

                if(form == 'settings'){
                    $(this).find(':input').parent().parent().attr('for', 'inputSuccess');
                    $(this).find(':input').parent().parent().removeClass('has-error').addClass('has-success');
                }else{
                    $(this).find(':input').parent().attr('for', 'inputSuccess');
                    $(this).find(':input').parent().removeClass('has-error').addClass('has-success');
                }

            });

            AdminApp.reload('#page-body-layout', data.url);
            AdminApp.message(Lang.lang_19, data.message, 'success');
    },
    error: function(xhr, status, response){
    var error = jQuery.parseJSON(xhr.responseText);

            $('form').each(function(){
            $(this).find('+span').removeClass('help-block').text('');
                if(form == 'settings'){
                    $(this).find(':input').parent().parent().attr('for', 'inputSuccess');
                    $(this).find(':input').parent().parent().removeClass('has-error').addClass('has-success');
                }else{
                    $(this).find(':input').parent().attr('for', 'inputSuccess');
                    $(this).find(':input').parent().removeClass('has-error').addClass('has-success');
                }

            });

            $.each(error.message, function (key, value) {
                var input = 'form input[name=' + key + '], form textarea[name=' + key + ']';
                $(input).find('+span').addClass('help-block').text(value);
                if(form == 'settings'){
                $(input).parent().parent().attr('for', 'inputError');
                $(input).parent().parent().removeClass('has-success').addClass('has-error');
                }else{
                $(input).parent().attr('for', 'inputError');
                $(input).parent().removeClass('has-success').addClass('has-error');               
                }
            });

            $('html, body').animate({
                scrollTop: $('form').find('div[for="inputError"]').first().offset().top
            }, 500);

    }
});

});

//Special Form Post Pjax



//Send Remove Item
        
        $('a[data-role="del"]').on("click", function(e) {
        e.preventDefault();
        var data_id = $(this).attr('data-id');
        var data_send = $(this).attr('data-post');


        swal({
        title: Lang.lang_1,
        text: Lang.lang_2,
        type: 'warning',
        showCancelButton: true,
        //showLoaderOnConfirm: true,
        confirmButtonColor: '#00a65a',
        cancelButtonColor: '#c9302c',
        confirmButtonText: Lang.lang_3,
        cancelButtonText: Lang.lang_4,
        preConfirm: function () {
        return new Promise(function (resolve) {
            $.ajax({
                url: data_send,
                type: 'GET',
                data: {id: data_id},
                cache: false,
                dataType: 'JSON',
                success: function (data) {
                  $.pjax.reload({container:'#page-body-layout', timeout: false, async: true});
                  AdminApp.message(Lang.lang_19, data.message, 'success');
                }
            });
        });
        }
        }).then(function(result) {
        }, function(dismiss) {
          // dismiss can be "cancel" | "close" | "outside"
          if (dismiss === 'cancel') {
            swal(
              Lang.lang_17,
              Lang.lang_18,
              'error'
            )
          }
        });



        });

//Send Remove Item

}
};

//PJAX

var PageAjax = {


    init: function(container, scrollto, cache, timeout) {


    if($.support.pjax){

      $.pjax.defaults.scrollTo = scrollto;
      $.pjax.defaults.timeout = timeout;
      $.pjax.defaults.maxCacheLength = cache;

      $(document).pjax('a', {
        container: container,
      });

/**
 * Ajax Send and Stop change Cursor status
 */

        $(document).ajaxStart(function() {
            $('*').css({'cursor' : 'wait'});
        }).ajaxStop(function() {
            $('*').css({'cursor' : ''});
        });

/**
 * Page Send
 */
      $(document).on('pjax:send', function(e) {
            $('*').css({'cursor' : 'wait'});
            e.preventDefault();
      });


/**
 * Page Loaded Complete
 */
      $(document).on('pjax:complete', function(e) {
            $('*').css({'cursor' : ''});
            e.preventDefault();
      });

/**
 * Page Loaded Start
 */
      $(document).on('pjax:start', function(e) {
            Pace.restart();
      });

/**
 * Page Loaded End
 */
      $(document).on('pjax:end', function(e) {
            Pace.stop();
      });


/**
 * Pjax Loading Timeout
 */
      $(document).on('pjax:timeout', function(e) {
            e.preventDefault();
      });

/**
 * All Scripts Reloaded
 */
      $(document).on('ready pjax:end', function(e) {
            window.pjaxOnLoad();
      });

    }


    }


};