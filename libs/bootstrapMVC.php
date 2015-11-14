<?php

class BootstrapMVC {

    function __construct() {
        
        // Alter the URL to the appropriate MVC call
        
        if (!isset($_GET['url']))
            $url[0] = "index";
        else 
        {
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = explode("/", $url);
        }

        $controller_file = CONTROLLERS_DIR . $url[0] . ".php";
        if (file_exists($controller_file)) {
            require $controller_file;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if (isset($url[1]) && method_exists($controller,$url[1])) 
            {
                // Needs error catching for correct arguments
                if (isset($url[3]))
                    $controller->{$url[1]}($url[2],$url[3]);
                else if (isset($url[2]))
                    $controller->{$url[1]}($url[2]);
                else
                    $controller->{$url[1]}();
            }
            else 
                $controller->index();
        }
        else {
            require CONTROLLERS_DIR . "index.php";
            $controller = new index();
            $controller->index();
            return false;
        }
    }

}

?>
