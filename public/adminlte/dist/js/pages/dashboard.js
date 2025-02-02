$(function() {
 "use strict";

 function e(e) {
  if ($("#news-chart").html(""), $(".lineloader").show(), "news" == e) var t = "news-chart",
   a = ["News"],
   o = "?type=news";
  else if ("lists" == e) var t = "news-chart",
   a = ["Lists"],
   o = "?type=list";
  else if ("quizzes" == e) var t = "quizzes-chart",
   a = ["Quizzes"],
   o = "?type=quiz";
  else if ("polls" == e) var t = "news-chart",
   a = ["Polls"],
   o = "?type=poll";
  else if ("videos" == e) var t = "news-chart",
   a = ["Videos"],
   o = "?type=video";
  var n = new Morris.Line({
   element: t,
   resize: !0,
   data: [{
    date: "0",
    news: 0
   }],
   xkey: "date",
   ykeys: ["news"],
   labels: a,
   lineColors: ["#efefef"],
   lineWidth: 2,
   hideHover: "auto",
   gridTextColor: "#fff",
   gridStrokeWidth: .4,
   pointSize: 4,
   pointStrokeColors: ["#efefef"],
   gridLineColor: "#efefef",
   gridTextFamily: "Open Sans",
   gridTextSize: 10
  });
  $.ajax({
   type: "GET",
   dataType: "json",
   url: "/admin/reports/last30news" + o,
   data: {
    days: 30
   },
   success: function(e) {
    n.setData(e), $(".lineloader").hide()
   }
  })
 }
 $(".connectedSortable").sortable({
  placeholder: "sort-highlight",
  connectWith: ".connectedSortable",
  handle: ".box-header, .nav-tabs",
  forcePlaceholderSize: !0,
  zIndex: 999999
 }), $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move"), $(".textarea").wysihtml5(), e("news"), $(".box-line-get").on("click", function() {
  var t = $(this).attr("data-type");
  e(t)
 });
 var t = new Morris.Line({
  element: "user-chart",
  resize: !0,
  data: [{
   date: "0",
   value: 0
  }],
  xkey: "date",
  ykeys: ["value"],
  labels: ["User"],
  lineColors: ["#efefef"],
  lineWidth: 2,
  hideHover: "auto",
  gridTextColor: "#fff",
  gridStrokeWidth: .4,
  pointSize: 4,
  pointStrokeColors: ["#efefef"],
  gridLineColor: "#efefef",
  gridTextFamily: "Open Sans",
  gridTextSize: 10
 });
 $.ajax({
  type: "GET",
  dataType: "json",
  url: "/admin/reports/last30dayusers",
  data: {
   days: 30
  },
  success: function(e) {
   t.setData(e)
  }
 });
 var a = new Morris.Donut({
  element: "sales-chart",
  resize: !0,
  colors: ["#3c8dbc", "#00a65a", "#f39c12", "#f56954", "#9C5D54"],
  data: [{
   label: "none",
   value: 0
  }],
  hideHover: "auto",
  gridTextFamily: "Open Sans",
  gridLineColor: "#00c0ef"
 });
 $.ajax({
  type: "GET",
  dataType: "json",
  url: "/admin/reports/last30SPOTStotal",
  data: {
   days: 30
  },
  success: function(e) {
   a.setData(e)
  }
 }), $(".box-donut-get").on("click", function() {}), $(".box ul.nav a").on("shown.bs.tab", function() {
  area.redraw(), a.redraw(), line.redraw()
 }), $(".todo-list").todolist({
  onCheck: function(e) {
   return window.console.log("The element has been checked"), e
  },
  onUncheck: function(e) {
   return window.console.log("The element has been unchecked"), e
  }
 })
});