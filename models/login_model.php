<?php

class login_model extends model{
    function __construct() {
        parent::__construct();
        
    }
    
    public function attempt_login()
    {
        if (!isset($_POST["user"]) || !isset($_POST["password"]))
            return false;
        $user = $_POST["user"];
        $pass = $_POST["password"];
        $pass = hash("sha512",$user) . hash("sha512",$pass);
        
        
       
        $query = 'SELECT user, role FROM users WHERE user = :user AND passwd = :pass';
        $prep_query = $this->db->prepare($query);
        $prep_query->execute(array(':user' => $user, ':pass' => $pass));
        $result = $prep_query->fetch(PDO::FETCH_ASSOC);

        
        if ($result["user"] == $user)
        {
            session::set("isLoggedIn",true);
            session::set("role",$result["role"]);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
}
?>
