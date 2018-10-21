<?php
    include_once "../controller/ServerFunctions.php";

    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $price = $_POST["price"];
    $status = $_POST["status"];
    $id = $_POST["id"];

    $obj = new ServerFunctions();
    $obj->updatePackage($name, $desc, $price, $status, $id);