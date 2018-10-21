<?php
    include_once "../../controller/CustomerFunctions.php";

    $id = $_POST["prodId"];

    $obj = new CustomerFunctions();
    $obj->viewProduct($id);