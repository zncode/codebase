//html
<div id="mask_layer"></div>

//css
#mask_layer {background-color:#333;position:fixed;left:0;top:0;width:100%;height:100%;z-index:99;display:none;opacity:0.5;}

//js
var mask_layer  = document.getElementById("mask_layer");
mask_layer.style.display = 'block';
