        $(".goods_check").click(function(){
            var goods_price_array = new Array();
            $.each($('input:checkbox:checked'),function(){
                var goods_price = $(this).attr('data-price');
                goods_price_array.push(goods_price);

            });
            if(goods_price_array.length){
                var sum = goods_price_array.reduce(function(prev,cur,index,array){
                    var total = Number(prev) + Number(cur);
                    return Number(prev) + Number(cur)
                })
            }else{
                var sum = '0.00';
            }
            $("[name='refund_amount']").empty();
            $("[name='refund_amount']").html(sum);
        });
