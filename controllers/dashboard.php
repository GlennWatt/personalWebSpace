<?php

class dashboard extends authenticated_controller
{
    public function __construct() {
        parent::__construct();
        $logged = session::get("isLoggedIn");
        if ($logged == false)
        {
            session::destroy();
            echo $logged;
            header('location: ' . $this->base_url .  '/index/error/You tried to access a page without logging in.');
            echo "fail";
            exit;
        }
        
        $this->view->js = array(VIEWS_DIR.'dashboard/js/default.js');
    }
    
    public function index()
    {
        $this->view->render("dashboard/index");
    }
    
    function xhr_insert()
    {
        $this->model->test_data_insert($_POST["text"]);
    }
    
    function xhr_get()
    {
        echo json_encode($this->model->test_data_get());
    }
    
    function xhr_truncate()
    {
        $this->model->test_data_truncate();
        echo json_encode($this->model->test_data_get());
    }
    
    function xhr_delete()
    {
        $this->model->test_data_delete($_POST["id"]);
        echo json_encode($this->model->test_data_get());
    }
}

?>
