<?php

class coding extends http_controller {

    function __construct() {
        parent::__construct();
        
    }
    
    function index ()
    {
        $this->view->render("coding/index");
    }
    
    public function test($arg = false)
    {
        $this->view->msg = $arg;
        $this->view->render("coding/test");
    }
    
    public function traveling_salesman($startLoc,$endLoc)
    {
        require (MODELS_DIR."traveling_salesman.php");
        $this->model = new traveling_salesman();
        $this->view->beg = $startLoc;
        $this->view->end = $endLoc;
        $this->view->route = $this->model->getRouteByJump($startLoc, $endLoc, NULL);
        $this->view->render("coding/traveling_salesman");
    }
}
?>
