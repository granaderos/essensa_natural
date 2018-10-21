<?php
    include_once "../controller/ServerFunctions.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $obj = new ServerFunctions();
    $obj->login($username, $password);