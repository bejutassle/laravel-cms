var BuzzyMail = function() {

    var handleInit = function() {
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
        $('.cho input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        }).on('ifChecked', function(event){

            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }).on('ifUnchecked', function(event){
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        });


        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {

            var fafa = $(this).find(".fa");
            var mail = $(this).attr("data-id");

            $.ajax({
                type: "POST",
                url:"/admin/mailbox/dostar", // This is the URL to the API
                data:'mail='+mail+'&_token='+$("#requesttoken").val(), // Passing a parameter to the API to specify number of days
                success: function(data) {
                    var status = data.status;//FOR DEMO ACCOUNT RETURN
                    var errors = data.errors;//FOR DEMO ACCOUNT RETURN

                    if(status=='Error'){
                        swal({
                            type: "warning",
                            title: "Error",
                            text: errors,
                            timer: 2000,
                            showConfirmButton: false
                        });

                    }

                        if(data=='stared'){
                            fafa.addClass("text-yellow");
                        }else{
                            fafa.removeClass("text-yellow");
                        }

                }
            });


        });
        //Handle starring for glyphicon and font awesome
        $(".mailbox-important").click(function (e) {

            var fafa = $(this).find(".fa");
            var mail = $(this).attr("data-id");

            $.ajax({
                type: "POST",
                url:"/admin/mailbox/doimportant", // This is the URL to the API
                data:'mail='+mail+'&_token='+$("#requesttoken").val(), // Passing a parameter to the API to specify number of days
                success: function(data) {
                    var status = data.status;//FOR DEMO ACCOUNT RETURN
                    var errors = data.errors;//FOR DEMO ACCOUNT RETURN

                    if(status=='Error'){
                        swal({
                            type: "warning",
                            title: "Error",
                            text: errors,
                            timer: 2000,
                            showConfirmButton: false
                        });

                    }
                    if(data=='important'){
                        fafa.addClass("text-red");
                    }else{
                        fafa.removeClass("text-red");
                    }


                }
            });


        });



        $(".addcat").on("click", function (e) {
            var input = $(this);
            var datatype=$(this).attr('data-type');
            swal({
                title: "Add Section",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Folder Name"
            }, function(inputValue){

                if (inputValue === false) return false;

                if (inputValue === "") {
                    swal.showInputError("Type something");
                    return false
                }

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url:"/admin/mailbox/addcat", // This is the URL to the API
                    data: 'name='+inputValue+'&type='+datatype+'&_token='+$("#requesttoken").val(), // Passing a parameter to the API to specify number of days
                    success: function(data) {
                        var type = data.type;
                        var message = data.message;
                        var status = data.status;//FOR DEMO ACCOUNT RETURN
                        var errors = data.errors;//FOR DEMO ACCOUNT RETURN

                        if(status=='Error'){
                            swal({
                                type: "warning",
                                title: "Error",
                                text: errors,
                                timer: 2000,
                                showConfirmButton: false
                            });

                        }else if(type=='error'){
                            swal({
                                type: "warning",
                                title: "Error",
                                text: message,
                                timer: 2000,
                                showConfirmButton: false
                            });

                        }else if(type=='success'){
                            swal({
                                type: "success",
                                title: "Success",
                                timer: 2000,
                                showConfirmButton: false
                            });

                            location.href = location.href;

                        }

                    }
                });

            });
        });


            $('.doaction').on('click', function () {
            var dataaction= $(this).attr('data-action');
            var datatype= $(this).attr('data-type');
             var form= $("#contacts");
             var serializeform= form.serialize();

            var widgetover= $(this).parents('.box').find('.overlay');
            widgetover.removeClass('hide');

            $.ajax({
                type: "POST",
                dataType: 'json',
                url:"/admin/mailbox/doaction", // This is the URL to the API
                data: serializeform+'&typo='+dataaction+'&type='+datatype, // Passing a parameter to the API to specify number of days
                success: function(data) {
                    var type = data.type;
                    var message = data.message;
                    var uri = data.url;
                    var status = data.status;//FOR DEMO ACCOUNT RETURN
                    var errors = data.errors;//FOR DEMO ACCOUNT RETURN

                    if(status=='Error'){
                        swal({
                            type: "warning",
                            title: "Error",
                            text: errors,
                            timer: 2000,
                            showConfirmButton: false
                        });

                    }else if(type=='error'){
                        swal({
                            type: "warning",
                            title: "Error",
                            text: message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                    }else if(type=='success'){
                        swal({
                            type: "success",
                            title: "Success",
                            timer: 2000,
                            showConfirmButton: false
                        });

                        location.href = location.href;

                    }
                    setTimeout(function(){
                        widgetover.addClass('hide');
                    },1000);

                }
            });

        });

   $('.sendmail').on('click', function () {
            var datatype= $(this).attr('data-type');

             var form= $(this).closest('form');
             var action= form.attr('action');
             var serializeform= form.serialize();

            var widgetover= $('.box').find('.overlay');
            widgetover.removeClass('hide');

            $.ajax({
                type: "POST",
                dataType: 'json',
                url:action, // This is the URL to the API
                data: serializeform+'&type='+datatype, // Passing a parameter to the API to specify number of days
                success: function(data) {
                    console.log(data);
                    var type = data.type;
                    var message = data.message;
                    var uri = data.url;
                    var status = data.status;//FOR DEMO ACCOUNT RETURN
                    var errors = data.errors;//FOR DEMO ACCOUNT RETURN

                    if(status=='Error'){
                        swal({
                            type: "warning",
                            title: "Error",
                            text: errors,
                            timer: 2000,
                            showConfirmButton: false
                        });

                    }else if(type=='error'){
                        swal({
                            type: "warning",
                            title: "Error",
                            text: message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                    }else if(type=='success'){
                        location.href =uri;
                    }
                    setTimeout(function(){
                        widgetover.addClass('hide');
                    },1000);

                }
            });

        });


    };


    return {

        init: function() {

            handleInit();

        }

    }

}();

BuzzyMail.init();