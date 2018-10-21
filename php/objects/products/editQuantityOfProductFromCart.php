<?php
    include_once "../../controller/CustomerFunctions.php";

    $tempOrderID = $_POST["tempOrderID"];
    $newQuantity = $_POST["newQuantity"];

    $obj = new CustomerFunctions();
    $obj->editQuantityOfProductFromCart($tempOrderID, $newQuantity);