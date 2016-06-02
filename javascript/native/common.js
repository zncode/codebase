//读取radio值
var Obj = document.getElementsByName("login_type");
for (i = 0; i < Obj.length; i++) {
    if (Obj[i].checked) {
      var login_type = Obj[i].value;
    }
};
//ul li 下 a标签添加onclick事件
var li = document.getElementById("page_video_navigation_ul").getElementsByTagName("a");
for (var i = 0; i < li.length; i++) {
    li[i].onclick = function () {
       var cid = this.attributes["data-category-id"].value;
       Vercoop.PAGE.Video.videoInnerHtml(cid);
    }
}
