var company_name = $("#company_name").val();
$.ajax({
    url: "?site=mobile&ctl=user&act=search_company_name&company_name=" + company_name,
    dataType: "json",
    data: {
        q: request.term
    },
    success: function( data ) {
        response( data );
    }
});

$.ajax({
    type: 'POST',
    url: "?r=site/mosquittoajax",
    dataType: "json",
    data: {
        'topic': topic,
    },
    success: function( data ) {
        $('#mosquittoform-response').val(data.data);
    }
});

