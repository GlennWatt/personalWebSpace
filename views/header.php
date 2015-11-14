<!doctype html>
<html>
<head>
    <title>MVC Development</title>
    <link rel="shortcut icon" href="<?=$this->base_url . IMG_DIR ?>favicon.ico" />
    <link rel="stylesheet" href="<?= $this->base_url . CSS_DIR; ?>main.css?<?= time();?>" />
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
<body>

<div id="header">
<?php 
if (session::get("role") == 'admin' || session::get("role") == 'owner')
{
    ?><a class="mainMenu" href="<?= $this->base_url; ?>user" >users</a> | <?php
}
if (session::get("isLoggedIn") == true)
{
?>
    <a class="mainMenu" href="<?= $this->base_url; ?>dashboard" >dashboard</a> | 
    <a class="mainMenu" href="<?= $this->base_url; ?>login/logout" >logout</a> 
<?php   
}  
else
{
?>
<a class="mainMenu" href="<?= $this->base_url; ?>index" >home</a>
<a class="mainMenu" href="<?= $this->base_url; ?>coding" >coding</a>
<a class="mainMenu" href="<?= $this->base_url; ?>guitar" >guitar</a>
<a class="mainMenu" href="<?= $this->base_url; ?>whitewater" >whitewater</a>
<a class="mainMenu" href="<?= $this->base_url; ?>yoga" >yoga</a>
<a class="mainMenu" href="<?= $this->base_url; ?>contact" >contact</a>
<a class="mainMenu" href="<?= $this->base_url; ?>login" >login</a>
<?php
}
?>


</div>
<div id="body">
<div class="breadCrumbs">
<?php
        if (!isset($_GET['url']))
            $url[0] = "index";
        else 
        {
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = explode("/", $url);
        }
        for($i = 0; $i<count($url); $i++)
        {
            echo "&gt; ";
            $href = $this->base_url;
            for ($ii = 0; $ii<$i+1; $ii++)
            {
                $href .= $url[$ii] . "/";
            }
            $label = $url[$i];
            echo "<a href='".$href."'>".$label."</a> ";
        }
?>
</div>

<?php 
if (isset($this->sys_msg))
{
    foreach($this->sys_msg as $msg)
    {
        ?>
    <div class="sysMsg">
      <div class="sysMsgHeader">System Message:</div>
      <div class="sysMsgBody"><?=$msg?></div>
    </div>
        <?php
    }
}
?>    

