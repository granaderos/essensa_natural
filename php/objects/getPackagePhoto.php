<?php
    include_once "../controller/ServerFunctions.php";
    $obj = new ServerFunctions();

    $obj->getPackagePhoto($_POST["id"]);