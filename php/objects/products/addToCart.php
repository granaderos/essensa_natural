<?php
    include_once "../../controller/CustomerFunctions.php";
    $obj = new CustomerFunctions();

    $id = $_POST["prodId"];
    $quantity = $_POST["quantity"];
    $category = $_POST["category"];

    $obj->addToCart($id, $quantity, $category);