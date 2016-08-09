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

//页面加载
window.onload = function(){ 
    alert('test'); 
}

//点击事件
document.getElementById("searchbuton").onclick = function(){
    alert('test');
};

//获取id
var search_text = document.getElementById("searchinput").value;

//获取属性值
var base_url = document.getElementById("baseurl").attributes["data-value"].value;

//打开另一个页面
window.open("www.baidu.com");

//获取class 名
var clnn = document.getElementById("searchinput").className;

//修改style
document.getElementById("searchinput").style.opacity = 0;	
document.getElementById("searchinput").style.display = "none";	
