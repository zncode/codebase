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
