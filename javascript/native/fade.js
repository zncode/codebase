//添加一个全局状态，防止多次触发setInterval。
var Fadeflag = true;

function Fade() {
	/**
	 * 淡入效果
	 * @param {Object} obj
	 */
	this.show = function(obj) {
		var num = 0;
	    if (Fadeflag) {
	        var st = setInterval(function(){
	            num++;
	            Fadeflag = false;
	            obj.style.opacity = num/10;
	            if (num>=10) {
	                clearInterval(st);
	                Fadeflag = true;
	            }
	        },30);
	    }
	}
	/**
	 * 淡出效果
	 * @param {Object} obj
	 */
	this.hide = function(obj) {
		var num = 10;
	    if (Fadeflag) {
	        var st = setInterval(function(){
	            num--;
	            Fadeflag = false;
	            obj.style.opacity = num/10;
	            if (num<=0) {
	                clearInterval(st);
	                Fadeflag = true;
	            }
	        },30);
	    }
	}
}

//导入上面的代码放在前面
var fade = new Fade();
fade.show(obj); //淡入
fade.hide(obj); //淡出
