<?php

abstract class controller {

    protected $sys_msg;
    
    function __construct() {
        $this->view = new view();
        $this->model = new model();
        $this->view->base_url = 'http://' . URL;
        session::init();
        

    }
    
    function index(){
        $this->view->render("index/index");
    }
    
    public function loadModel($name){
        $path = WEB_DIR . MODELS_DIR . $name . "_model.php";
        
        if (file_exists($path))
        {
            require $path;
            $modelName = $name . "_model";
            $this->model = new $modelName();
        }
    }
    
    public function add_sys_msg($msg)
    {
        $this->sys_msg[count($this->sys_msg)] = $msg;
        $this->view->sys_msg = $this->sys_msg;
    }
    
}

class http_controller extends controller
{
    public function __construct()
    {
        parent::__construct();

        if(isset($_SERVER["HTTPS"]))
        {
            if ($_SERVER["HTTPS"] == "on")
            {
                header("Location: " . rtrim($this->view->base_url,"/") . $_SERVER["REQUEST_URI"]);
                exit();
            }
        }
    }
    
}

class https_controller extends controller
{
    public function __construct() {
        parent::__construct();
        $this->view->base_url = 'https://' . URL;
        
        if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
        {
            header("Location: " . rtrim($this->view->base_url,"/") . $_SERVER["REQUEST_URI"]);
            exit();
        }
        
    }
}

class authenticated_controller extends https_controller
{
    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION["isLoggedIn"]) || !$_SESSION["isLoggedIn"])
        {
            $this->add_sys_msg("You need to be logged in to access this page.");
            $this->view->render("login/index");
            exit;
        }
    }
}

class authenticated_admin_controller extends authenticated_controller
{
    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION["role"]) || ($_SESSION["role"] != 'owner' && $_SESSION["role"] != 'admin')){
            $this->add_sys_msg("You need to be an admin to access that page.");
            $this->view->render("index/index");
            exit;
        }
                
    }
}

class authenticated_owner_controller extends authenticated_controller
{
    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION["role"]) || (!$_SESSION["role"] != "owner")){
            $this->add_sys_msg("You need to be an owner to access that page.");
            $this->view->render("index/index");
            exit;
        }
        
    }
}
?>
