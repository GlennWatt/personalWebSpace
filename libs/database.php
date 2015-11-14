<?php

class database extends pdo {

    function __construct() {
        parent::__construct(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB,DB_USER, DB_PASS);
    }

}
?>
