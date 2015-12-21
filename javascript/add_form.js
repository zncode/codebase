//添加备注
$(function(){
    //为弹框添加样式
    var css_style = ' <style>\
        div#remark_box {position:absolute;top:250px;text-align:center;margin-left:500px} \
        div#remark_box table{width:80%;background-color:white; border:5px solid #ddd;display:inline-table;} \
        div#remark_box td,th{height:30px;border: 1px solid #ddd ;} \
        </style>';
    $("head").append(css_style);
});

    $(function(){
        //添加发票表单-弹出
        $("button#remark_box").click(function(){
            var add_remark_bt = $(this);
            var remark_html = '';
            var order_sn	= $(this).attr('order_sn');
            var operator	= $('#operator').val();
            var reserve_id	= $('#reserve_id').val();

            remark_html = '<tr>\
				           <td><textarea name="content" rows="8" cols="50"  /></textarea></td>\
				       </tr>';

            remark_html += '<tr>\
                        <td>\
                            <input type="hidden" name="order_sn" value="'+order_sn+'" /> \
                            <input type="hidden" name="operator" value="'+operator+'" /> \
                            <input type="hidden" name="reserve_id" value="'+reserve_id+'" /> \
                            <button class="btn btn-success" id="ajax_submit">确定</button>\
                            <button class="btn btn-primary" id="ajax_cancel">取消</button>\
                        </td>\
                    </tr>';
            remark_html = '<form enctype="multipart/form-data" id="ajaxFrm" name="frm" action="?site=manager&ctl=reserve&act=unlink_order_do" method="post" role="form"> \
                        <div id="remark_box">\
                            <table class="table table-striped table-bordered">'
                + remark_html +
                '   </table>\
                        </div> \
                    </form>';
                $("body").append(remark_html);
                add_remark_bt.attr("disabled", true);

                //ajax提交操作
                $("#ajax_submit").click(function(){
                    $("#ajaxFrm").submit();
                    //top.location='?site=manager&ctl=reserve&act=unlink_order_do';
                });

                    //ajax取消操作
                    $("#ajax_cancel").click(function(){
                        //状态还原
                        $("#ajaxFrm").remove();
                        add_remark_bt.attr("disabled", false);
                    });
        });

    });
