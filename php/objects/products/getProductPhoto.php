<?php
    include_once "../../controller/ServerFunctions.php";
    $obj = new ServerFunctions();

    $obj->getProductPhoto($_POST["id"]);