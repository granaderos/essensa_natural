<?php
    include_once "../controller/ServerFunctions.php";

    $lName = $_POST["lName"];
    $fName = $_POST["fName"];
    $mName = $_POST["mName"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $telNo = $_POST["telNo"];
    $cellNo = $_POST["cellNo"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $code = $_POST["code"];
    $codeEntered = $_POST["codeEntered"];

    $obj = new ServerFunctions();
    if($obj->checkCodeEntered($code, $codeEntered) == "1") {
        $obj->addUser($lName, $fName, $mName, $birthday, $gender, $address, $telNo, $cellNo, $username, $password);
    } else {
        echo "Invalid Code!";
    }
