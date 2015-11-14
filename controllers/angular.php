<?php

class angular extends http_controller
{
    public function __construct() {
        parent::__construct();
        
//        $this->view->js = array(
//            VIEWS_DIR . 'angular/js/angular.min.js',
//            VIEWS_DIR . 'angular/js/products.js',
//            VIEWS_DIR . 'angular/js/panels.js',
//            VIEWS_DIR . 'angular/js/app.js',
//        );
//        $this->view->css = array(
//            VIEWS_DIR . 'angular/css/bootstrap.min.css',
//            VIEWS_DIR . 'angular/css/style.css'
//        );
    }
    
    public function index()
    {
        $this->view->render(
            "angular/index"//,
//            true,
//            VIEWS_DIR."angular/header.php",
//            VIEWS_DIR."angular/footer.php"
        );
    }
}

