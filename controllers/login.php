<?php

class login extends https_controller {

    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $this->view->render("login/login");
    }
    
    function attempt_login()
    {
        if($this->model->attempt_login())
        {
            header("location: " . $this->view->base_url . "dashboard");
            exit;
        }
        else
        {
            $this->add_sys_msg("An error occured during login");
            $this->view->render("login/error");
        }
    }
    
    function error()
    {
        $msg = "Login unsuccesful. Please try again. If you are receiving this ";
        $msg .= "message in error please contact a system administrator";
        
        $this->add_sys_msg($msg);
        $this->view->render("login/login");
    }
    
    function logout ()
    {
        session::destroy();
        if (session::get("isLoggedIn"))
            $this->add_sys_msg("There was an error. You may still be logged in.");
        else
            $this->add_sys_msg("You have successfully logged out.");
        $this->view->render("index/index");
    }
}
?>
