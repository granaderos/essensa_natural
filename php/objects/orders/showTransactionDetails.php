<?php
    include_once "../../controller/ServerFunctions.php";

    $transID = $_POST["transID"];

    $obj = new ServerFunctions();
    $obj->showTransactionDetails($transID);