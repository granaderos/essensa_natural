<?php
    include_once "../../controller/CustomerFunctions.php";

    $method = $_POST["method"];

    $dateOfPickUp = "";
    $careOf = "";
    if($method == "pick-up") {
        $dateOfPickUp = $_POST["dateOfPickUp"];
    } else {
        $careOf = $_POST["nameOfCareOf"];

    }

    $receiver = $_POST["nameOfReceiver"];
    $address = $_POST["address"];
    $number = $_POST["contactNum"];
    $paymentMethod = $_POST["paymentMethod"];

    $obj = new CustomerFunctions();
    $obj->submitOrders($method, $receiver, $address, $careOf, $number, $paymentMethod, $dateOfPickUp);

