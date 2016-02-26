<script language="javascript" type="text/javascript" >
$(function(){
    $('tr.cli').click(
    function(){
        var $log_id      = $(this).attr('id');
        var $log_id_sub  = '#'+$log_id+'_sub';
        $($log_id_sub).toggle('slow');
    }
    );

    $('tr.cli').hover(function(){
        $(this).css({'background-color':'#ccc'});
    }, function(){
        $(this).css({'background-color':'#f5f5f5'});
    });
});
</script>
