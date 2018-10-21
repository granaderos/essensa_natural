<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/18/16
 * Time: 8:48 PM
 */

include_once "../../controller/ServerFunctions.php";

$category = $_POST["category"];

$obj = new ServerFunctions();
$obj -> displaySalesRecord($category);