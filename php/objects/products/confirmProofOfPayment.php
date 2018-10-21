<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/2/16
 * Time: 10:16 PM
 */

    include_once "../../controller/ServerFunctions.php";
    $obj = new ServerFunctions();

    $transID = $_POST["transID"];

    $obj->confirmProofOfPayment($transID);