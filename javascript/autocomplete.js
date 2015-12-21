<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
    $("#company_name").autocomplete({
        source: function( request, response ) {
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
        },
        select: function( event, ui ) {
            var company_name = ui.item.label;
            var company_id   = ui.item.desc;
            $("#company_name").val(company_name);
        },
    });
});
</script>
