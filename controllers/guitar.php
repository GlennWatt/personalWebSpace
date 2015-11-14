<?php
class guitar extends http_controller {

    function __construct() {
        parent::__construct();
        
    
    }
    
    function index ()
    {
        $this->view->render("guitar/index");
    }
}
?>