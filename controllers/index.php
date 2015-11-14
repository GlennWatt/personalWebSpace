<?php

class index extends http_controller {

    function __construct() {
        parent::__construct();
        
    }
    
    public function test($arg = false)
    {
        $this->add_sys_msg($arg);
        $this->view->render("index/test");
    }
    
    function index ()
    {
        $this->view->render("index/index");
    }
    
    function error($msg)
    {
        $this->view->sysMsg[0] = $msg;
        $this->view->render("index/index");
    }

    
}

?>