//css
#message_box{position:absolute; z-index:100; top:40%;left:40%; width:300px; height:150px; background-color:white;}
#message_box_title{width:300px; height:50px; line-height:50px; background-color:#0067B3; text-align:center; font-size:20px;}
#message_box_msg{width:300px; height:50px; line-height:50px; color:black; padding-left:20px;}

#message_box_button_wrapper_1{width:300px; height:50px; line-height:50px;}
#message_box_button_wrapper_1_wrapper{}
#message_box_button_1_1{width:50px; height:30px;line-height:30px;background-color:#0067B3; color:white;}

#message_box_button_wrapper_2{width:300px; height:50px; line-height:50px; padding-left:30px;}
#message_box_button_wrapper_2_wrapper_1{float:left; text-align:center; }
#message_box_button_wrapper_2_wrapper_2{float:left; text-align:center; margin-left:50px;}
#message_box_button_2_1{width:50px; background-color:#0067B3; color:white;}
#message_box_button_2_2{width:50px; background-color:red; color:white;}

//html
<!--START Message Box -->
<div id="message_box" style="display:none;">
    <div id="message_box_title">提示</div>
    <div id="message_box_msg"></div>
    <div id="message_box_button_wrapper_1" style="display:none;">
        <div id="message_box_button_wrapper_1_wrapper">
            <button id="message_box_button_1_1" onclick="" value="test1"></button>
        </div>
    </div>
    <div id="message_box_button_wrapper_2" style="display:none;">
        <div id="message_box_button_wrapper_2_wrapper_1">
            <button id="message_box_button_2_1" onclick="Vercoop.PAGE.pageLogout();" ></button>
        </div>
        <div id="message_box_button_wrapper_2_wrapper_2">
            <button id="message_box_button_2_2" onclick="Vercoop.PAGE.closeMessageBox()" ></button>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>
<!--END Message Box -->

//js 显示消息, 按钮1, 按钮2 需传参数
this.showMessageBox = function (index, msg, b1_text, b2_text) {
    var message_box     = document.getElementById("message_box");
    var message_box_msg = document.getElementById("message_box_msg");
    var mask_layer      = document.getElementById("mask_layer");
    message_box.style.display = 'block';
    mask_layer.style.display = 'block';
    message_box_msg.textContent = msg;

    if(index == 1)
    {
        var message_box_b1_text  = document.getElementById("message_box_button_1_1");
        var message_box_button_1 = document.getElementById("message_box_button_wrapper_1");
        message_box_button_1.style.display = 'block';
        message_box_b1_text.textContent = b1_text;
    }
    if (index == 2) {
        var message_box_b1_text = document.getElementById("message_box_button_2_1");
        var message_box_b2_text = document.getElementById("message_box_button_2_2");
        var message_box_button_2 = document.getElementById("message_box_button_wrapper_2");
        message_box_button_2.style.display = 'block';
        message_box_b1_text.textContent = b1_text;
        message_box_b2_text.textContent = b2_text;
    }
}

this.closeMessageBox = function (index) {
    var message_box = document.getElementById("message_box");
    var mask_layer = document.getElementById("mask_layer");
    message_box.style.display = 'none';
    mask_layer.style.display = 'none';
}
