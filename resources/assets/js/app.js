var App = function() {
    var t = function() {
            var t = $("<div />");
            $(window).scroll(function() {
                var i = $("#header"),
                    e = $(window).scrollTop();
                e >= 100 ? i.addClass("mini") : i.removeClass("mini"), e >= 150 ? $(t).is(":visible") || $(t).fadeIn(500) : $(t).fadeOut(500)
            }), t.html('<i class="fa fa-chevron-up"></i>'), t.css({
                position: "fixed",
                bottom: "20px",
                right: "25px",
                width: "40px",
                height: "40px",
                color: "#eee",
                "font-size": "",
                "line-height": "40px",
                "text-align": "center",
                "background-color": "#222d32",
                cursor: "pointer",
                "border-radius": "5px",
                "z-index": "99999",
                opacity: ".7",
                display: "none"
            }), t.on("mouseenter", function() {
                $(this).css("opacity", "1")
            }), t.on("mouseout", function() {
                $(this).css("opacity", ".7")
            }), $(".header").append(t), $(t).on("click", function() {
                $("html,body").animate({
                    scrollTop: 0
                }, 500)
            })
        },
        i = function() {
            $(".cats_link").mouseenter(function() {
                return $(".cats_link").removeClass("active"), $(this).addClass("active"), $(".sections").show(), e($(".scol1").find("a").first().attr("data-type")), !1
            }).mouseleave(function(t) {
                var i = "0";
                $(".sections").hover(function() {
                    i = "1"
                }).mouseleave(function() {
                    $(".cats_link").removeClass("active"), $(".sections").hide()
                }), $(".cats_link").hover(function() {
                    i = "1"
                }), setTimeout(function() {
                    "0" == i && ($(".cats_link").removeClass("active"), $(".sections").hide())
                }, 100)
            }), $(".scol1").find("a").on("hover", function() {
                var t = $(this).attr("data-type");
                $(".scol2").find("ul").hide(), $("#cats_" + t).show()
            }), $(".biga").off("mouseover").mouseover(function() {
                var t = $(this).attr("data-type");
                $(this).hasClass("firsg") ? ($(".scol2").find("ul").hide(), $("#cats_" + t).show()) : $(".biga").removeClass("active"), e(t)
            }), $("#searchbutton").on("click", function(t) {
                var i = ($(this), $(".search_link")),
                    e = $("#searchbox_text").val();
                i.hasClass("active") ? e.length > 1 ? location.href = "/search?q=" + e : e.focus : i.addClass("active")
            }), $("#searchclosebutton").on("click", function(t) {
                $(".search_link").removeClass("active")
            }), $("#menu-toggler").on("click", function(t) {
                var i = ($(this), $("#colnav")),
                    e = $("body");
                i.hasClass("active") ? (i.removeClass("active"), e.removeClass("sitcactive")) : (i.addClass("active"), e.addClass("sitcactive"))
            }), $(".popup-action").on("click", function(t) {
                return a($(this).attr("href"), $(this).attr("data-id")), !1
            })
        },
        e = function(t) {
            $.ajax({
                method: "GET",
                url: "/" + t + ".json",
                cache: !0,
                dataType: "json",
                success: function(t) {
                    $("#catnews_last").html(""), $(t).slice(0, 6).each(function(t, i) {
                        var e = i.title,
                            a = i.slug,
                            s = i.thumb;
                        $('<div class="tile tile-3"><a href="' + a + '"><div class="thumb"><img src="' + s + '" ></div><div class="desc"><div class="descwrap"><h4 class="post-title">' + e + '</h4><div class="details"></div></div></div></a></div>').appendTo("#catnews_last")
                    })
                }
            })
        },
        a = function(t, i) {
            if (t > "") {
                var e = 600,
                    a = 400,
                    s = screen.height / 2 - a / 2,
                    n = screen.width / 2 - e / 2,
                    o = window.open(t, "sharer", "top=" + s + ",left=" + n + ",toolbar=0,status=0,width=" + e + ",height=" + a),
                    r = setInterval(function() {
                        o.closed && (clearInterval(r), $.ajax({
                            method: "POST",
                            url: "/shared/" + i + "?_token=" + $("#requesttoken").val(),
                            success: function(t) {}
                        }))
                    }, 1e3);
                return !1
            }
        },
        s = function() {
            var t = $(".jscroll").attr("data-auto");
            $(".jscroll").jscroll({
                loadingHtml: '<i style="top:40%;position:relative;" class="fa fa-spinner fa-pulse"></i>',
                padding: 20,
                autoTrigger: "false" == t ? !1 : !0,
                nextSelector: "a.page-next:last",
                callback: function() {
                    s()
                }
            })
        },
        n = function() {
            $(".blocker.ci").remove();
            var t = '<div class="jquery-modal blocker ci" style="top: 0px; right: 0px; bottom: 0px; left: 0px; width: 100%; height: 100%; position: fixed; z-index: 100000; opacity: 0.75; background: rgba(0, 0, 0, .75);text-align:center;font-size:60px;color:#fff;"><i style="top:40%;position:relative;" class="fa fa-spinner fa-pulse"></i></div>';
            $("body").append(t)
        },
        o = function() {
            $(".blocker.ci").remove()
        },
        r = function() {
            var t = $(".postable");
            t.off("click").on("click", function() {
                NProgress.set(.4);
                var t = $(this).attr("href"),
                    i = $(this).attr("data-method"),
                    e = $(this).attr("data-target"),
                    a = ($(this).attr("data-message"), $(this).attr("data-puttype")),
                    s = $(this).attr("data-type"),
                    n = $("#requesttoken").val();
                return $.ajax({
                    method: i,
                    data: "_token=" + n,
                    url: t,
                    success: function(t) {
                        return t.error ? (alert(t.message), !1) : ("prepend" == a ? $("#" + e).prepend(t) : "append" == a ? $("#" + e).append(t) : $("#" + e).html(t), setTimeout(function() {
                            $(".poll_main_color").each(function(t) {
                                $(this).css("width", $(this).attr("data-percent") + "%")
                            })
                        }, 500), "textform" == s || ("imageform" == s ? Editor.initImageUpluad() : "videoform" == s ? Editor.initVideoGet() : "tweetform" == s ? Editor.initTweetGet() : "facebookpostform" == s ? Editor.initFacebookPostGet() : "instagramform" == s ? Editor.initInstagramGet() : "soundcloudform" == s ? Editor.initSoundCloudGet() : "pollform" == s || "questionform" == s || "resultform" == s ? (Editor.initImageUpluad(), r()) : ("answerform" == s || "pollanswerform" == s) && (Editor.initAssignSelect(), Editor.initImageUpluad())), setTimeout(function() {
                            App.initAjax(), s > "" && Editor.EditorInit()
                        }, 100), void NProgress.done(!0))
                    }
                }), !1
            })
        },
        c = function() {
            $("#PostNewUser").on("click", function() {
                NProgress.set(.4), App.initLoadingCaption("show"), $("#auth-modal").hide();
                var t = $(this).closest("form");
                $.post(t.attr("action"), t.serialize(), function(t) {
                    t.errors ? (swal(t.errors), $("#auth-modal").show()) : swal({
                        title: t.status,
                        text: t.text,
                        type: "success",
                        timer: 2e3,
                        showConfirmButton: !1
                    }, function() {
                        location.href = t.url
                    }), App.initLoadingCaption("hide"), NProgress.set(1)
                }, "json")
            })
        },
        l = function() {
            $("#PostUserLogin").on("click", function() {
                NProgress.set(.4), App.initLoadingCaption("show"), $("#auth-modal").hide();
                var t = $(this).closest("form"),
                    i = t.attr("action"),
                    e = t.serialize();
                $.post(i, e, function(t) {
                    t.errors ? (swal(t.errors), $("#auth-modal").show()) : location.href = t.url, App.initLoadingCaption("hide"), NProgress.set(1)
                }, "json")
            })
        },
        u = function() {
            var t = $("#auth-modal");
            $('[rel="get:Signupform"]').click(function() {
                return t.find(".signup-form").length > 0 ? (t.modal(), !1) : ($.ajax({
                    method: "GET",
                    url: $(this).attr("href"),
                    success: function(i) {
                        t.html(i).modal(), c(), App.initAjax()
                    }
                }), !1)
            })
        },
        d = function() {
            var t = $("#auth-modal");
            $('[rel="get:Loginform"]').click(function() {
                return t.find(".login-form").length > 0 ? (t.modal(), !1) : ($.ajax({
                    method: "GET",
                    url: $(this).attr("href"),
                    success: function(i) {
                        t.html(i).modal(), l(), App.initAjax()
                    }
                }), !1)
            })
        },
        f = function() {
            var t = $(".quizquestion"),
                i = t.length,
                e = $("#quiz_result").attr("data-popup"),
                a = $("#quiz_result").attr("data-qtype"),
                s = 0;
            "trivia" == a ? $(".answer").find("a").click(function() {
                if ($(this).hasClass("closed")) return !1;
                var e = $(this).attr("data-result");
                "off" == e ? ($(this).parents(".quizquestion").find("a").addClass("closed"), $(this).addClass("active").css("background-color", "#ff1f1f"), $(this).parents(".quizquestion").find('[data-result="on"]').css("background-color", "#88f078")) : ($(this).parents(".quizquestion").find("a").addClass("closed"), $(this).addClass("active").css("background-color", "#88f078"), s += 1);
                var a = t.find("a.active"),
                    n = a.length;
                return n == i && ($(".entry.results").show(), $("html,body").animate({
                    scrollTop: $("#quiz_result").offset().top - 160
                }, 500), $("#triviaresult").show(), $("#triviaresult b").text(s), $("#triviaresult strong").text(i)), !1
            }) : $(".answer").find("a").click(function() {
                $(this).parents(".answer").find("a").removeClass("active").css("opacity", "0.6"), $(this).css("opacity", "1").addClass("active");
                var a = t.find("a.active"),
                    s = a.length;
                if (s == i) {
                    $(".entry.results").show();
                    var n = [];
                    a.each(function(t) {
                        var i = $(this).attr("data-result");
                        n.push(i)
                    }), Array.prototype.mostFreq = function() {
                        for (var t, i, e, a, s = this.concat(), n = 0, o = s.length / 2; s.length;) {
                            for (t = s.shift(), a = 1; - 1 != (i = s.indexOf(t));) s.splice(i, 1), ++a;
                            if (a > o) return t;
                            a > n && (e = t, n = a)
                        }
                        return e
                    };
                    var o = $(".quiz_result");
                    o.each(function() {
                        if ($(this).attr("data-order") == n.mostFreq()) {
                            $(".answer").find("a").unbind("click").addClass("closed");
                            var t = $(this).attr("data-picture"),
                                i = $(this).attr("data-description"),
                                a = $(this).attr("data-name");
                            $(this).find("img").attr("src", t), "off" == e ? $("html,body").animate({
                                scrollTop: $("#quiz_result").offset().top - 160
                            }, 500) : (App.initLoadingCaption("show"), setTimeout(function() {
                                h(t, i, a), p(), App.initLoadingCaption("hide")
                            }, 300)), o.hide(), $(this).show().addClass("active")
                        }
                    })
                } else {
                    if ($(this).parents(".quizquestion").removeClass("selectableQuest"), $(this).parents(".quizquestion").next(".selectableQuest").length > 0) var r = $(this).parents(".quizquestion").next(".selectableQuest").offset().top;
                    else if ($(this).parents(".quizquestion").prev(".selectableQuest").length > 0) var r = $(this).parents(".quizquestion").prev(".selectableQuest").offset().top;
                    $("html,body").animate({
                        scrollTop: r - 80
                    }, 500)
                }
                return !1
            })
        },
        h = function(t, i, e) {
            swal({
                customClass: "BuzzyQuizAlert",
                title: e,
                text: '<span class="resultdesc">' + i + '</span><div class="external-sign-in" style="margin-bottom:20px"><a style="width: 35%;margin: 10px;display: inline-block" href="javascript:" class="Facebook do-signup tgec postToResultFeed"><span>' + Quizzes.lang_1 + "</span><strong>" + Quizzes.lang_3 + '</strong></a><a  style="width: 35%;margin: 10px;display: inline-block" href="javascript:" class="Twitter do-signup tgec postToResultFeed"><span>' + Quizzes.lang_2 + "</span><strong>" + Quizzes.lang_4 + "</strong></a>",
                imageUrl: t,
                showCancelButton: !0,
                showConfirmButton: !1,
                allowOutsideClick: !0,
                cancelButtonText: "X",
                html: !0,
                showLoaderOnConfirm: !0
            }, function() {})
        },
        p = function() {
            $(".postToFacebookFeed").off("click").on("click", function(t) {
                var i = $(this),
                    e = i.attr("data-link"),
                    a = i.attr("data-iname"),
                    s = i.attr("data-picture"),
                    n = i.attr("data-description");
                return m(e, a, s, n), !1
            }), $(".postToResultFeed").off("click").on("click", function(t) {
                var i = $(".quiz_result.active"),
                    e = i.attr("data-link"),
                    a = i.attr("data-name"),
                    s = i.attr("data-iname"),
                    n = i.attr("data-itname"),
                    o = i.attr("data-picture"),
                    r = i.attr("data-description");
                return "" == a && (a = i.find(".quiz_headline").text(), s = a, n = a), $(this).hasClass("Facebook") ? m(e, s, o, r) : $(this).hasClass("Pinterest") ? g(e, s, o, r) : v(e, n), !1
            })
        },
        m = function(t, i, e, a) {
            return swal({
                title: "",
                timer: 1
            }), FB.ui({
                method: "feed",
                link: t,
                name: i,
                picture: e,
                description: a
            }, function(t) {
                t && !t.error_message && swal({
                    title: Quizzes.lang_5,
                    text: Quizzes.lang_6,
                    type: "success",
                    timer: 2e3,
                    showConfirmButton: !1
                })
            }), !1
        },
        v = function(t, i) {
            return a("https://twitter.com/intent/tweet?url=" + t + "&text=" + i, 0), !1
        },
        g = function(t, i, e) {
            return a("http://pinterest.com/pin/create/link/?url=" + t + "&media=" + e + "&description=" + i, 0), !1
        };
    return {
        init: function() {
            t(), r(), i(), s(), p(), this.initAjax()
        },
        initAjax: function() {
            u(), d(), r()
        },
        initLoadingCaption: function(t) {
            "show" == t ? n() : o()
        },
        initLoginClicks: function() {
            l()
        },
        initRegisterClicks: function() {
            c()
        },
        initQuizzesClicks: function() {
            f()
        }
    }
}();