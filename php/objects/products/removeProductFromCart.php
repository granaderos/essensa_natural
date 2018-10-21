<?php
    include_once "../../controller/CustomerFunctions.php";

    $tempOrderID = $_POST["tempOrderID"];

    $obj = new CustomerFunctions();
    $obj->removeProductFromCart($tempOrderID);