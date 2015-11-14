$(function(){
    $(".designActionForm").submit(function(){
        var $url = $(this).attr("action");
        var $data = $(this).serialize();
        $url = $url + "?" + $data;
        $.get($url, function(o){
            $("#slot"+o.slot+"_label").text(o.label);
        }
        ,'json');
        return false;
    });
})