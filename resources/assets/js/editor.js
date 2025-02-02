var Editor = function() {
    var t = function() {},
        e = function() {
            $(".lists-types a").on("click", function() {
                $(".lists-types a").removeClass("selected").addClass("button-white").removeClass("button-gray"), $(this).addClass("selected").removeClass("button-white").addClass("button-gray"), a()
            }), $(".moreentry").off("click").on("click", function() {
                var t = $(this),
                    e = $(".moreentrywidget");
                e.hasClass("show") ? (e.removeClass("show"), t.find("i").attr("class", "fa fa-caret-down")) : (e.addClass("show"), t.find("i").attr("class", "fa fa-caret-up"))
            }), $(".moredetail .trigger").off("click").on("click", function() {
                $(this).hasClass("active") ? $(this).hasClass("active") && ($(this).parent().find(".detailhide").slideUp("fast"), $(this).removeClass("active"), $(this).find(".up").hide(), $(this).find(".down").show()) : ($(this).parent().find(".detailhide").slideDown("fast"), $(this).addClass("active"), $(this).find(".up").show(), $(this).find(".down").hide())
            }), $(".up-down-trigger").on("click", function(t) {
                var e = $(this),
                    i = e.parents(".entry");
                if (e.hasClass("up-entry")) {
                    var n = i.prev();
                    i.insertBefore(n)
                } else if (e.hasClass("down-entry")) {
                    var o = i.next();
                    i.insertAfter(o)
                }
                a()
            }), $(".getassignres").on("click", function() {
                i()
            }), $(".clickanswertype").on("click", function() {
                var t = $(this).attr("data-style");
                $(this).parents(".questionmore").find("a").removeClass("button-orange").addClass("button-white").removeAttr("data-curtype"), $(this).removeClass("button-white").addClass("button-orange").attr("data-curtype", "on"), $(this).parents(".questionmore").find(".answers").attr("class", "answers " + t)
            }), $(".delete-entry").on("click", function(t) {
                var e = $(this);
                swal({
                    title: Lang.lang_1,
                    text: Lang.lang_2,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: Lang.lang_3,
                    cancelButtonText: Lang.lang_4,
                    closeOnConfirm: !0
                }, function() {
                    "entry" == e.attr("data-block") ? e.parents(".entry").first().remove() : e.parents(".answer").first().remove(), a()
                })
            }), $(".thumbactions a.deleteimage").on("click", function(t) {
                var e = $(this),
                    a = ($(this).attr("data-action"), $(this).attr("data-target"));
                swal({
                    title: Lang.lang_1,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: Lang.lang_3,
                    cancelButtonText: Lang.lang_4,
                    closeOnConfirm: !0
                }, function() {
                    if ("thumb" == a) $(".imagepr_wrap").html(""), $(".previewshow").hide(), $(".preview-placeholder").show(), $("#upwthumb").val("");
                    else {
                        var t = ".entry";
                        "answer" == a && (t = ".answer"), e.parents(t).find(".imagearea_img").first().html(""), e.parents(t).find(".cd-input-image").first().val(""), e.parents(t).find(".mediaupload").first().show(), e.parents(t).find(".imagearea").first().addClass("hide")
                    }
                })
            }), $(".thumbactions a.makepreview").on("click", function() {
                var t = $(this).parents(".entry").find('[data-type="image"]').val();
                $(".imagepr_wrap").html(""), $(".previewshow").hide(), $(".preview-placeholder").show(), $("#upwthumb").val(""), o(t)
            }), $(".getimageurl").on("click", function(t) {
                var e = $(this),
                    a = $(this).attr("data-target");
                swal({
                    title: Lang.lang_5,
                    type: "input",
                    showCancelButton: !0,
                    closeOnConfirm: !1,
                    animation: "slide-from-top",
                    inputPlaceholder: Lang.lang_6,
                    confirmButtonText: "OK",
                    cancelButtonText: Lang.lang_4
                }, function(t) {
                    return t === !1 ? !1 : "" === t ? (swal.showInputError(Lang.lang_7), !1) : null == t.match(/\.(jpeg|jpg|gif|png)$/) ? (swal.showInputError(Lang.lang_8), !1) : ("preview" == a ? o(t) : r(e, t), void swal({
                        title: "",
                        timer: 1
                    }))
                })
            })
        },
        a = function() {
            var t = $(".question-post-form").attr("data-type");
            if ("quiz" == t) return $("#results .entry").each(function(t) {
                act = Math.ceil(t), num = act + 1, $(this).find(".order-number").text(num)
            }), $("#entries .entry").each(function(t) {
                acta = Math.ceil(t), numa = acta + 1, $(this).find(".order-number").text(numa)
            }), i(), n(), !1;
            "none" == $(".lists-types a.selected").attr("data-order") || 0 == $(".lists-types a.selected").length ? $(".ordering").addClass("noorder") : $(".ordering").removeClass("noorder"), n();
            var e = $(".entry").length,
                a = $(".lists-types a.selected").attr("data-order");
            $(".entry").each(function(t) {
                act = Math.ceil(t), "desc" == a ? num = e - act : num = act + 1, $(this).find(".order-number").text(num)
            })
        },
        i = function() {
            var t, e, a, i = [],
                n = "";
            $(".question-post-form").attr("data-type");
            $("#results .entry").each(function(o) {
                e = $(this).attr("data-co"), t = $(this).find('[data-type="title"]').val(), t > "" && (n = " - "), a = o + 1, i[o] = e + "|" + a + n + t.substr(0, 9)
            }), $('[data-type="assign"]').each(function() {
                if ("radio" == $(this).attr("type")) return !1;
                var t = "",
                    e = $(this).find(":checked").attr("data-co"),
                    a = $(this).attr("data-acst");
                $(i).each(function(i, n) {
                    var o = n.split("|");
                    t = i == a ? t + '<option selected="selected" data-co="' + o[0] + '" value="' + i + '">Result: ' + o[1] + "</option>" : e == o[0] ? t + '<option selected="selected" data-co="' + o[0] + '" value="' + i + '">Result: ' + o[1] + "</option>" : t + '<option data-co="' + o[0] + '" value="' + i + '">Result: ' + o[1] + "</option>"
                }), $(this).replaceWith('<select class="getassignres" data-type="assign"><option data-co="0" value="">Assign a result</option>' + t + "</select>")
            })
        },
        n = function() {
            $(".answers").each(function(t) {
                var e = $(this).attr("id");
                Sortable.create(document.getElementById(e), {
                    group: ".answer",
                    handle: ".drag-handle",
                    animation: 150
                })
            })
        },
        o = function(t) {
            "" == $("#upwthumb").val() && ($(".imagepr_wrap").html('<img src="' + t + '" >'), $(".previewshow").show(), $(".preview-placeholder").hide(), $("#upwthumb").val(t))
        },
        r = function(t, e) {
            var a = t.attr("data-target");
            t.parents("." + a).find(".imagearea_img").first().html('<img src="' + e + '" >'), t.parents("." + a).find(".cd-input-image").first().val(e), t.parents(".inpunting").hide(), t.parents("." + a).find(".imagearea").first().removeClass("hide")
        },
        s = function() {
            $(".uploadaimage").off("click").on("change", function() {
                NProgress.inc(), App.initLoadingCaption("show");
                var t = $(this);
                t.attr("name", "file").parents("form").attr("method", "POST").attr("enctype", "multipart/form-data");
                var e = $("input[name='_token']").val();
                t.parents("form").append('<input name="_token" type="hidden" value="' + e + '">');
                var a = "/upload-a-image?type=" + t.attr("data-target");
                t.parents("form").ajaxSubmit({
                    url: a,
                    dataType: "json",
                    success: function(e) {
                        e.errors ? swal({
                            title: e.status,
                            text: e.errors,
                            type: "error",
                            confirmButtonText: Lang.lang_3,
                            cancelButtonText: Lang.lang_4
                        }) : t.hasClass("preview") ? o(e.path) : (r(t, e.path), o(e.path)), App.initLoadingCaption("hide"), NProgress.done(!0)
                    }
                })
            })
        },
        l = function() {
            $(".createvideo").on("click", function() {
                var t, e, a, i = $(this).parent("div").find("input").val(),
                    n = i.match(/^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?(?:youtu\.be|youtube\.com)\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/)([^\?&\"'>]+)/),
                    r = i.match(/^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?vimeo\.com\/([0-9]+)$/),
                    s = i.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/),
                    l = i.match(/https?\:\/\/(?:www\.)?facebook\.com\/(\d+|[A-Za-z0-9\.]+)\/?/);
                if (n && 11 == n[1].length) t = '<iframe src="//www.youtube.com/embed/' + n[1] + '" width="100%" height="400" frameborder="0" allowfullscreen></iframe>', a = "http://img.youtube.com/vi/" + n[1] + "/hqdefault.jpg", o(a), e = t;
                else if (r) t = '<iframe src="//player.vimeo.com/video/' + r[1] + '" width="100%" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', e = t;
                else if (s) t = '<iframe src="//www.dailymotion.com/embed/video/' + s[2] + '" width="100%" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', e = t;
                else {
                    if (!l) return swal({
                        title: Lang.lang_11,
                        text: Lang.lang_9,
                        type: "warning",
                        timer: 2e3,
                        showConfirmButton: !1
                    }), !1;
                    var c = "video-" + (new Date).getTime();
                    t = '<div id="' + c + '" class="fb-video" data-href="' + i + '" style="max-height: 360px;"><div class="fb-xfbml-parse-ignore"></div></div><script>(typeof FB != "undefined") && FB.XFBML.parse($("#' + c + '").parent()[0]);</script>', a = "https://graph.facebook.com/" + l[1] + "/picture?type=large", o(a), e = i
                }
                d($(this), t, e)
            })
        },
        d = function(t, e, a) {
            t.parents(".inpunting").hide(), t.parents(".entry").find(".embedarea").removeClass("hide"), t.parents(".entry").find(".videoembed").html(e), t.parents(".entry").find(".cd-input-video").val(a)
        },
        c = function(t, e, a, i) {
            return "" == i ? (swal({
                title: Lang.lang_11,
                text: Lang.lang_9,
                type: "warning",
                timer: 2e3,
                showConfirmButton: !1
            }), !1) : (a.fail(function(t, e) {
                return t.status && 404 == t.status && swal({
                    title: Lang.lang_11,
                    text: Lang.lang_9,
                    type: "warning",
                    timer: 2e3,
                    showConfirmButton: !1
                }), !1
            }), void a.done(function(a) {
                if (a) {
                    var n, o, r = a.html;
                    if ("tweet" == t) {
                        var s = r.replace('<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>', "");
                        o = r, n = s
                    } else if ("instagram" == t) {
                        var l = Math.floor(1e3 * Math.random() + 1);
                        o = '<iframe class="instagram-media instagram-media-rendered" id="instagram-embed-' + l + '" src="' + i + 'embed/captioned/?v=5" allowtransparency="true" frameborder="0" data-instgrm-payload-id="instagram-media-payload-0" scrolling="no" style="border: 0; margin: 1px; max-width: 658px; width: calc(100% - 2px); border-radius: 4px; box-shadow: rgba(0, 0, 0, 0.498039) 0px 0px 1px 0px, rgba(0, 0, 0, 0.14902) 0px 1px 10px 0px; display: block; padding: 0px; background: rgb(255, 255, 255);"></iframe>', n = i
                    } else "soundcloud" == t && (e.parents(".entry").find(".ordering input").val(a.title), o = r, n = r);
                    d(e, o, n)
                } else swal({
                    title: Lang.lang_11,
                    text: Lang.lang_9,
                    type: "warning",
                    timer: 2e3,
                    showConfirmButton: !1
                })
            }))
        },
        u = function() {
            $(".createtweet").off("click").on("click", function() {
                var t = $(this),
                    e = t.parent("div").find("input").val(),
                    a = $.ajax({
                        cache: !1,
                        url: "https://api.twitter.com/1/statuses/oembed.json?url=" + e,
                        method: "GET",
                        dataType: "jsonp"
                    });
                c("tweet", t, a, e)
            })
        },
        p = function() {
            $(".createfacebookpost").off("click").on("click", function() {
                var t = $(this),
                    e = t.parent("div").find("input").val();
                if ("" == e) return swal(Lang.lang_11, Lang.lang_9, "warning"), !1;
                var a = '<div class="fb-post" data-href="' + e + '" data-width="100%"></div>';
                d(t, a, e), FB.XFBML.parse()
            })
        },
        f = function() {
            $(".createinstagram").off("click").on("click", function() {
                var t = $(this),
                    e = t.parent("div").find("input").val(),
                    a = $.ajax({
                        cache: !1,
                        url: "http://api.instagram.com/publicapi/oembed/?url=" + e,
                        method: "GET",
                        dataType: "jsonp"
                    });
                c("instagram", t, a, e)
            })
        },
        h = function() {
            $(".createsoundcloud").off("click").on("click", function() {
                var t = $(this),
                    e = t.parent("div").find("input").val(),
                    a = $.ajax({
                        url: "http://soundcloud.com/oembed?format=json&url=" + e,
                        method: "GET"
                    });
                c("soundcloud", t, a, e)
            })
        },
        m = function() {
            Simditor.locale = "en_EN", $(".message").each(function(t, e) {
                0 == $(this).parents(".entry").find(".simditor").length && new Simditor({
                    textarea: $(e),
                    upload: !1,
                    tabIndent: !1,
                    toolbar: ["bold", "italic", "underline", "strikethrough", "|", "ul", "blockquote", "link"],
                    toolbarFloat: !1,
                    toolbarFloatOffset: 35
                })
            })
        },
        g = function() {
            $(".PostAction").off("click").on("click", function() {
                NProgress.inc(), App.initLoadingCaption("show");
                var t = $(this).closest("form"),
                    e = $(this).attr("data-post-t"),
                    a = t.find(".question-post-form").attr("data-type"),
                    i = t.attr("action"),
                    n = t.find("input[name=_token]").val(),
                    o = t.find("input[name=headline]").val(),
                    r = t.find("textarea[name=description]").val(),
                    s = t.find("#tags").val(),
                    l = t.find("select[name=category]").val(),
                    d = t.find("select[name=pagination]").val(),
                    c = t.find("input[name=thumb]").val(),
                    u = t.find(".lists-types a.selected").attr("data-order");
                (null == typeof u || "" == u || void 0 == u) && (u = null);
                var p = [];
                return 0 == $(".entry").length ? (swal(Lang.lang_10), NProgress.done(!0), App.initLoadingCaption("hide"), !1) : ($(".entry").each(function(t, e) {
                    var a = $(this).attr("data-type");
                    (null == typeof a || "" == a || void 0 == a) && (a = null);
                    var i = $(this).find('[data-type="title"]').first().val();
                    (null == typeof i || "" == i || void 0 == i) && (i = null);
                    var n = $(this).find('[data-type="body"]').first().val();
                    (null == typeof n || "" == n || void 0 == n) && (n = null);
                    var o = $(this).find('[data-type="image"]').first().val();
                    (null == typeof o || "" == o || void 0 == o) && (o = null);
                    var r = $(this).find('[data-type="video"]').first().val();
                    (null == typeof r || "" == r || void 0 == r) && (r = null);
                    var s = $(this).find('[data-type="source"]').first().val();
                    if ((null == typeof s || "" == s || void 0 == s) && (s = null), "quizquestion" == a) {
                        var l = 0,
                            d = $(this).find('[data-curtype="on"]').first().attr("data-query");
                        (null == typeof d || "" == d || void 0 == d) && (d = null), p[t] = {
                            type: a,
                            title: i,
                            body: n,
                            source: s,
                            image: o,
                            listtype: d
                        }, p[t].answers = [], $(e).find(".answer").each(function(e, a) {
                            var i = $(this).attr("data-type");
                            (null == typeof i || "" == i || void 0 == i) && (i = null);
                            var n = $(this).find('[data-type="title"]').first().val();
                            (null == typeof n || "" == n || void 0 == n) && (n = null);
                            var o = $(this).find('[data-type="image"]').first().val();
                            if ((null == typeof o || "" == o || void 0 == o) && (o = null), "trivia" == u) r = "off", "on" == $(this).find('[data-type="assign"]:checked').val() && (r = "on", l = 1);
                            else {
                                var r = $(this).find('[data-type="assign"]').first().val();
                                (null == typeof r || "" == r || void 0 == r) && (r = null)
                            }
                            p[t].answers[e] = {
                                type: i,
                                title: n,
                                image: o,
                                assign: r
                            }
                        })
                    } else if ("poll" == a) {
                        var d = $(this).find('[data-curtype="on"]').first().attr("data-query");
                        (null == typeof d || "" == d || void 0 == d) && (d = null), p[t] = {
                            type: a,
                            title: i,
                            body: n,
                            source: s,
                            image: o,
                            listtype: d
                        }, p[t].answers = [], $(e).find(".answer").each(function(e, a) {
                            var i = $(this).attr("data-type");
                            (null == typeof i || "" == i || void 0 == i) && (i = null);
                            var n = $(this).find('[data-type="title"]').first().val();
                            (null == typeof n || "" == n || void 0 == n) && (n = null);
                            var o = $(this).find('[data-type="image"]').first().val();
                            (null == typeof o || "" == o || void 0 == o) && (o = null), p[t].answers[e] = {
                                type: i,
                                title: n,
                                image: o,
                                assign: "1"
                            }
                        })
                    } else "text" == a ? p[t] = {
                        type: a,
                        title: i,
                        body: n,
                        source: s
                    } : "image" == a ? p[t] = {
                        type: a,
                        title: i,
                        body: n,
                        source: s,
                        image: o
                    } : "video" == a ? p[t] = {
                        type: a,
                        title: i,
                        body: n,
                        source: s,
                        video: r
                    } : "embed" == a || "tweet" == a || "facebookpost" == a || "instagram" == a || "soundcloud" == a ? p[t] = {
                        type: a,
                        title: i,
                        body: n,
                        source: s,
                        video: r
                    } : p[t] = {
                        type: a,
                        title: i,
                        body: n,
                        image: o,
                        source: s
                    }
                }), $(".lists-types").length > 0 && 0 == $(".lists-types a.selected").length ? (swal("Cooise list type"), NProgress.done(!0), App.initLoadingCaption("hide"), !1) : $(".entry").length < parseInt(d) && 0 != d ? (swal(Lang.lang_12), NProgress.done(!0), App.initLoadingCaption("hide"), !1) : void $.post(i, {
                    datapostt: e,
                    title: o,
                    description: r,
                    tags: s,
                    category: l,
                    pagination: d,
                    type: a,
                    ordertype: u,
                    thumb: c,
                    _token: n,
                    entrys: p
                }, function(t) {
                    t.errors ? (App.initLoadingCaption("hide"), NProgress.done(!0), swal({
                        title: t.status,
                        text: t.errors,
                        type: "error",
                        timer: 3e3,
                        showConfirmButton: !1
                    })) : setTimeout(function() {
                        App.initLoadingCaption("hide"), NProgress.done(!0), location.href = t.url
                    }, 1500)
                }, "json"))
            })
        };
    return {
        init: function() {
            NProgress.set(.4), t(), g(), this.initAjax(), NProgress.done(!0)
        },
        initAjax: function() {
            l(), s()
        },
        EditorInit: function() {
            m(), e(), a()
        },
        initImageUpluad: function() {
            s()
        },
        initVideoGet: function() {
            l()
        },
        initTweetGet: function() {
            u()
        },
        initFacebookPostGet: function() {
            p()
        },
        initInstagramGet: function() {
            f()
        },
        initSoundCloudGet: function() {
            h()
        },
        initAssignSelect: function() {
            i()
        }
    }
}();