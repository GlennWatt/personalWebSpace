/*
    This function calls on the dashboard/xhr_get function and displays the json
    output in a nice format. It also provides a button to access the 
    dashboard/xhr_truncate function to clear the listings.
*/
function getValues (){
    $.get('/dashboard/xhr_get', function(o){
        // Get a fresh start
        $('#listInserts').html("");

        // Provide output for each record
        for (var i = 0; i < o.length; i++)
        {
            var cHtml = "<div class='listInsertItem'>" + o[i].TEXT1;
            cHtml += " <a class='del' rel='" + o[i].idTEST_DATA + "' href='#'>";
            cHtml += "X</a></div>";
            $('#listInserts').append(cHtml);
        }

        // if there is a list add a button at the bottom to clear the list
        if (o.length > 0)
            $('#clearList').attr("style","display: block;");
        else
            $('#clearList').attr("style","display: none;");

        // Wait until the data exists to create the handler for the data
        $('.del').click(function()
        {
            var id = $(this).attr("rel");
            var data = $(this).serialize();
            var url = '/dashboard/xhr_delete';
            $.post(url, {'id': id}, function(o){
                getValues();
            });
            return false;
        });

    }, 'json');
}

$(function() {

    getValues();
    $('#randomInsert').submit(function()
    {
        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.post(url, data, function(o){
            getValues();
        });

        return false; 
    });

    $('#truncate').submit(function()
    {
        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.post(url, data, function(o){
            getValues();
        });
        return false; 
    });

    $('#changeColorBtn').submit(function(){
        var bgColor = Math.floor((Math.random() * 999999));
        var textColor = 999999 - bgColor;
        var linkColor = Math.abs(bgColor - textColor);
        $('#colorChange').css("background","#" + bgColor);
        $('#colorChange').css("color","#" + textColor);
        $('#colorChange a').css("color","#" + linkColor);
        $('#colorChange').append('new color <br />');
        
        return false;
    });
   
});