$(function() {
	 var aroundTmp = $("#aroundTmp").html();
	 var $aroundWrapper = $("#aroundWrapper");
	 
	 // 增加mls
    $("#addAround").on("click", function(){
        $(aroundTmp).appendTo($aroundWrapper);
    });
    
    // 删除mls
    $aroundWrapper.on("click", ".d-unadd", function(){
        $(this).closest(".d-side").remove();
    });
    
    //检测mls 1
    $("input#mls").on("blur", function(){
 		var mls    				= $(this).val();
 		var reserve_phone_id    = $('#reserve_phone_id').val();
 		var mythis 				= $(this);
 		
 		if(mls){
 			//ajax异步请求
 			$.ajax({ 
 		        type: 'POST', 
 		        url: '?site=manager&ctl=house&act=api_search_mls', 
 		        data: {
 		        	'mls':mls,
 		        	'reserve_phone_id':reserve_phone_id,
 		        }, 
 		        dataType:'json', 
 		        success:function(data)
 		        { 
 		           //alert(data.result.msg);
 		           var msg = data.result.msg;
 		           var code = data.result.code;
 		          mythis.next("span").html(msg);
 		           //$(".mls_check_msg").html(msg);
 		           if(code){
 		        	  mythis.next("span").removeClass('msg_green');
 		        	  mythis.next("span").addClass('msg_red');
 		        	  $('#save_button').attr('disabled','disabled');
 		           }else{
 		        	  mythis.next("span").removeClass('msg_red');
 		        	  mythis.next("span").addClass('msg_green');
 		        	 $('#save_button').removeAttr('disabled');
 		           }
 		          
 		        } 
 		     });			
 		}
 	});
    
    //检测mls 2
    $aroundWrapper.on("blur", ".mls_add", function(){
 		var mls    				= $(this).val();
 		var mythis 				= $(this);
 		var reserve_phone_id    = $('#reserve_phone_id').val();
 		
 		if(mls){
 			//ajax异步请求
 			$.ajax({ 
 		        type: 'POST', 
 		        url: '?site=manager&ctl=house&act=api_search_mls', 
 		        data: {
 		        	'mls':mls,
 		        	'reserve_phone_id':reserve_phone_id,
 		        }, 
 		        dataType:'json', 
 		        success:function(data)
 		        { 
 		           //alert(data.result.msg);
 		           var msg = data.result.msg;
 		           var code = data.result.code;
 		           mythis.next("span").html(msg);
 		           
 		           if(code){
 		        	  mythis.next("span").removeClass('msg_green');
 		        	  mythis.next("span").addClass('msg_red');
 		        	 $('#save_button').attr('disabled','disabled');
 		           }else{
 		        	  mythis.next("span").removeClass('msg_red');
 		        	  mythis.next("span").addClass('msg_green');
 		        	 $('#save_button').removeAttr('disabled');
 		           }
 		          
 		        } 
 		     });			
 		}
 	});
});
