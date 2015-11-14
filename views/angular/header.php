<!doctype html>
<html ng-app="store">
<head>
    <title>MVC Development</title>
    <link rel="shortcut icon" href="<?=$this->base_url . IMG_DIR ?>favicon.ico" />
    <script type="text/javascript" src="<?= $this->base_url . JS_DIR; ?>jquery.js"></script>
    <?php
        if (isset($this->js))
        {
            foreach ($this->css as $css)
            {
                echo '<link rel="stylesheet" href="' . $this->base_url . $css . '?' . time() .'"/>';
            }
            foreach ($this->js as $js)
            {
                echo '<script type="text/javascript" src="' . $this->base_url . $js . '"></script>';
            }
        }
    ?>
</head>
