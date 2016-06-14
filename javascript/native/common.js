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

//秒转时间hh:mm:ss
this.formatTime = function (totalSeconds) {
    if (totalSeconds < 86400) {
        var dt = new Date("01/01/2000 0:00");

        dt.setSeconds(totalSeconds);
        var h = dt.getHours(),
            m = dt.getMinutes(),
            s = dt.getSeconds(),
            r = "";
        if (h > 0) {
            r += (h > 9 ? h.toString() : "0" + h.toString()) + ":";
        }
        r += (m > 9 ? m.toString() : "0" + m.toString()) + ":"
        r += (s > 9 ? s.toString() : "0" + s.toString());
        return r;
    } else {
        return null;
    }
}
