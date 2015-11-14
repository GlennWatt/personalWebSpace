$(function(){
    $("form").submit(function(){
        var url = $(this).attr("action");
        var data = $(this).serialize();
        //data = JSON.stringify(data);
        $.post(url,data,function(results){
            writeToResultsDiv(results);   
        },'json');
        return false;
    });
})

