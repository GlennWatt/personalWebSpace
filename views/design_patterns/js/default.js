function writeToResultsDiv($text)
{
    $("#resultsDiv").html($text);
    $("#resultsDiv").show();
}


$(function(){
    $(".designAction").click(function(){
        $url = $(this).attr("href");
        $.get($url, function(o){
            writeToResultsDiv(o);
        }
        ,'json');
        return false;
    });
})