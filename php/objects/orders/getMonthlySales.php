<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/19/16
 * Time: 2:52 AM
 */

include_once "../../controller/ServerFunctions.php";

$year = $_POST["year"];
$obj = new ServerFunctions();
$obj->getMonthlySales($year);