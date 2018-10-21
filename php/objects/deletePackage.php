<?php
    include_once "../controller/ServerFunctions.php";

    $id = $_POST["id"];

    $obj = new ServerFunctions();
    $obj->deletePackage($id);