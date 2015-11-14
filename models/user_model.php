<?php

class user_model extends model {
    public function __construct() {
        parent::__construct();
    }
    
    public function new_user($user,$pass,$email,$birthdate)
    {
        $pass = hash("sha512",$user) . hash("sha512",$pass);
        $statement = 'CALL createUser(:user,"default",:pass,:email,:birthdate);';
        $sth = $this->db->prepare($statement);
        $result = $sth->execute(array("user"=>$user,":pass"=>$pass,":email"=>$email,":birthdate"=>$birthdate));
    }
    
    public function get_users()
    {
        $statement = 'SELECT user, email, birthdate, role from users';
        $sth = $this->db->query($statement);
        $results = $sth->fetchall(pdo::FETCH_ASSOC);
        return $results;
    }
}

?>
