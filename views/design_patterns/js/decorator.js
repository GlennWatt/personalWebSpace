$(function(){
    $("#addCondiment").click(function(){
            
        // This could use some error checking to verify the flavor and the first most recent condiment on have been selected

        var drink_order = $("#drink_order").serializeArray();
        var newCondiment = "<br /><label>Condiment " + drink_order.length + ": </label>";
        newCondiment += '<input type=radio name="condiment' + (drink_order.length-1) + '" value="mocha" />Mocha  ';
        newCondiment += '<input type=radio name="condiment' + (drink_order.length-1) + '" value="latte" />Latte  ';
        newCondiment += '<input type=radio name="condiment' + (drink_order.length-1) + '" value="soy" />Soy  ';
        newCondiment += '<input type=radio name="condiment' + (drink_order.length-1) + '" value="whip" />Whip  ';
        $("#condiments").append(newCondiment);
        return false;
    });

    $("#decoratorSubmit").click(function(){
        var url = $(this).attr("href");
        
        var ser = $("#drink_order").serializeArray();
        var drink_order = new Object();
        drink_order.bev = ser[0].value;
        
        var condiments = new Array();
        for (var i=1; i<ser.length; i++)
        {
            condiments[i-1] = ser[i].value;
        }
        
        drink_order.condiments = condiments;
        
        console.log(drink_order);
        var ob  = new Object();
        ob.drink_order = "'" + JSON.stringify(drink_order) + "'";

        $.post(url,ob,function(o){
            $(".contrast1").css("display","block");
            $("#results").html(o);
        }
        ,'json');
        return false;
    });
})