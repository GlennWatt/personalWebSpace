<?php
class user extends authenticated_admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->js = array(VIEWS_DIR.'user/js/user.js');
    }
    
    public function index()
    {
        $this->view->render("user/index");
    }
    
    public function create_user_xhr()
    {
        if (isset($_POST["user"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["birthdate"]))
        {
            $user = $_POST["user"];
            $pass = $_POST["password"];
            $email = $_POST["email"];
            $birthdate= $_POST["birthdate"];
            $this->model->new_user($user,$pass,$email,$birthdate);
        }
    }
    
    public function get_users_xhr()
    {
        echo json_encode($this->model->get_users());
    }
}
