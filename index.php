<?php

/*
 * To Do:
 * - Find and implement auto loader
 * - Write Notices to java console for use in debug mode
 * - Work out a switch or an IP aware system to switch debug mode
 */




// Globals
require "/home/glenn/www/publichtml/libs/globals.php";

// Librarys
require MAIN_CONTROLLER;
require DATABASE;
require MAIN_VIEW;
require MAIN_MODEL;
require SESSION;
require BOOTSTRAP_MVC;


$app = new BootstrapMVC();



?>
