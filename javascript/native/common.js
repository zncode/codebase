//读取radio值
var Obj = document.getElementsByName("login_type");
for (i = 0; i < Obj.length; i++) {
    if (Obj[i].checked) {
      var login_type = Obj[i].value;
    }
};
