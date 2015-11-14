<?php

class whitewater extends http_controller {

    function __construct() {
        parent::__construct();
        

    }

    
    function index ()
    {
        $this->view->render("whitewater/index");        
    }
}
?>
