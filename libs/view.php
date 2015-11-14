<?php

class view {

    public $base_url;
    function __construct() {
        $this->base_url = '';
    }

    public function render($name,$include_wrap = true,$custom_header = null,$custom_footer = null)
    {
        // Default header/footer
        $default_header = VIEWS_DIR . "header.php";
        $default_footer = VIEWS_DIR . "footer.php";
        
        if (isset($custom_header)){
            $header = $custom_header;
        } else {
            $header = $default_header;
        }
        
        if (isset($custom_footer)){
            $footer = $custom_footer;
        } else {
            $footer = $default_footer;
        }
        
        if ($include_wrap){
            require $header;
        }
        require VIEWS_DIR . $name . '.php';
        if ($include_wrap){
            require $footer;
        }
    }
}
?>
