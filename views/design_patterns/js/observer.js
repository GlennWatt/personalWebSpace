
$(function(){
    $(".observerAction").click(function(){
        $url = $(this).attr("href");
        $.get($url, function(o){
            for(var $i = 0; $i< o.length; $i++)
            {
                $observer = o[$i].observer;
                $("#"+$observer+"Time").html(o[$i].ob_time);
                $("#"+$observer+"Num").html(o[$i].random_int);
                if (o[$i].subscription_status == "y")
                {
                    $url = $("#"+$observer+"Subscribe").attr("href");
                    $url = $url.replace("register","remove");
                    $("#"+$observer+"Subscribe").attr("href",$url);
                    $("#"+$observer+"Subscribe").text("Unsubscribe");
                }    
                else if (o[$i].subscription_status == "n")
                {
                    $url = $("#"+$observer+"Subscribe").attr("href");
                    $url = $url.replace("remove","register");
                    $("#"+$observer+"Subscribe").attr("href",$url);
                    $("#"+$observer+"Subscribe").text("Subscribe");
                }
            }
        }
        ,'json');
        return false;
    });
})

