<?php

require "globals_local.php";

// Directories
define("CONTROLLERS_DIR", "controllers/");
define("LIBS_DIR", "libs/");
define("MODELS_DIR", "models/");
define("VIEWS_DIR", "views/");
define("JS_DIR","public/js/");
define("CSS_DIR","public/css/");
define("IMG_DIR","public/images/");

// Errors
define("ERROR_CONTROLLER", CONTROLLERS_DIR . "error.php");
define("ERROR_VIEW", VIEWS_DIR . "error.php");
define("ERROR_LOG_DIR", "/");

// Library Includes
define("BOOTSTRAP_MVC",WEB_DIR . LIBS_DIR . "bootstrapMVC.php");
define("MAIN_CONTROLLER",WEB_DIR . LIBS_DIR . "controller.php");
define("MAIN_VIEW",WEB_DIR . LIBS_DIR . "view.php");
define("MAIN_MODEL",WEB_DIR . LIBS_DIR . "model.php");
define("DATABASE",WEB_DIR . LIBS_DIR . "database.php");
define("SESSION",WEB_DIR . LIBS_DIR . "session.php");

?>
