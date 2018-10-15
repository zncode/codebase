//UNIX 时间戳
var timestamp = Date.parse(new Date());

//新打开页面
window.open("www.baidu.com");    

//解决冲突
jQuery.noConflict();

//字符串替换（单引号'）
var columnsStr = columnsStr.replace(/&#039;/g,"\'");
var columnsStr = columnsStr.replace(/&quot;/g,"\'");

//分割数组(分隔符 冒号:)
var cArray = columnsArray[i].split(":");

//控制台打印
console.log();

//判断类型
console.log(typeof searchColumns);

//变量对象
for(var key in searchColumns){}

//json字符串转对象
advanceSearchFields = eval('(' + advanceSearchFields + ')');

//动态添加对象属性
for(var key in advanceSearchFields){$
  d[key] = $('#'+key).val();$
}

//生成数组处理
var searchFields = [];
for(var key in advanceSearchFields){
    var a = {};
    a[key] = $('#'+key).val();
    searchFields[i] = a;
}       
d.searchFields = searchFields;
                
//下载文件
 window.location="http://www.baidu.com/download/test.rar";

//判断手机号
var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
if (!myreg.test(receiver_mobile)) {
    layer.msg("手机号格式错误!");
    $("[name='receiver_mobile']").focus();
    return false;
}
