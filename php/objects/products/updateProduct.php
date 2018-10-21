<?php
    include_once "../../controller/ServerFunctions.php";

    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $unitPrice = $_POST["unitPrice"];
    $sellingPrice = $_POST["sellingPrice"];
    $stocks = $_POST["stocks"];
    $category = $_POST["category"];
    $id = $_POST["id"];

    $obj = new ServerFunctions();
    $obj->updateProduct($name, $desc, $unitPrice, $sellingPrice, $stocks, $category, $id);