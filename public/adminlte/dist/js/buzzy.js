var Buzzy = function() {
    var t = function() {
        var t = $("#requesttoken").val();
        $(".sendtrash").on("click", function() {
            var t = $(this).attr("href");
            return swal({
                title: Lang.lang_15,
                text: Lang.lang_16,
                type: "warning",
                showCancelButton: !0,
                closeOnConfirm: !1,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: Lang.lang_3,
                showLoaderOnConfirm: !0
            }, function() {
                setTimeout(function() {
                    location.href = t
                }, 500)
            }), !1
        }), $(".activebut").on("click", function() {
            var e = $(this).attr("data-item"),
                o = $(this).attr("data-verify"),
                r = $(this).parents(".box-widget").find(".overlay");
            r.removeClass("hide"), 
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/admin/activeteplugin",
                data: {
                    dataitem: e,
                    dataverify: o,
                    _token: t
                },
                success: function(t) {
                    var e = t.type,
                        o = t.status,
                        a = t.errors,
                        n = t.message;
                    t.url;
                    "Error" == o ? swal({
                        type: "warning",
                        title: "Error",
                        text: a,
                        timer: 2e3,
                        showConfirmButton: !1
                    }) : "error" == e ? swal({
                        type: "warning",
                        title: "Error",
                        text: n,
                        timer: 2e3,
                        showConfirmButton: !1
                    }) : "success" == e && location.reload(), setTimeout(function() {
                        r.addClass("hide")
                    }, 1e3)
                }
            })
        })
    };
    return {
        init: function() {
            t()
        }
    }
}();