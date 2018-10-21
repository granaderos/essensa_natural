<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/18/16
 * Time: 7:36 PM
 */

include_once "../../controller/ServerFunctions.php";

$date = $_POST["date"];

$obj = new ServerFunctions();
$obj->displayOrdersOnTheSpecifiedDate($date);