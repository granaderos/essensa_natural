<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/15/16
 * Time: 7:44 PM
 */

include_once "../../controller/ServerFunctions.php";

$testimonialID = $_POST["testimonialID"];

$obj = new ServerFunctions();
$obj->approveTestimonial($testimonialID);