function get_users (url){
    $.post(url+"get_users_xhr",function(o){
        str = "<tr><th>Test</th></tr>";
        for(i=0; i<o.length; i++)
        {
            str += "<tr>";
            str += "<td>" + o[i].user + "</td>";
            str += "<td>" + o[i].email + "</td>";
            str += "<td>" + o[i].birthdate + "</td>";
            str += "<td>" + o[i].role + "</td>";
            str += "</tr>";
        }
        $("#usersTable").html(str);
    },'json');
}

function create_user(url, user, email, password, birthdate){
    var data = "user="+user+"&email="+email+"&password="+password+"&birthdate="+birthdate;
    $.post(url+"create_user_xhr",data,function(){});
    get_users(url);
}

//function edit_user(url, user,email,birthdate)
//{
//}
//
//function reset_password(url, user,password,password_confirm)
//{
//}

$(function(){
    $("form").submit(function(){
        var user = $("#user").val();
        var action = $("#action").val();
        var password = $("#password").val();
        var password_confirm = $("#password_confirm").val();;
        var birthdate = $("#birthdate").val();;
        var email = $("#email").val();;
        var url = $(this).attr("action");
                
        switch (action)
        {
            case "add" :
                
                create_user(url, user,email,password,password_confirm,birthdate);
                break;
            case "edit" :
                edit_user(url, user,email,birthdate);
                break;
            case "reset_password" :
                reset_password(url, user,password,password_confirm);
                break;
                
        }

        return false;
    });
});