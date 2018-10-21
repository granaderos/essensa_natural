<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/4/16
 * Time: 12:39 AM
 */

include_once "../../controller/ServerFunctions.php";

$id = $_POST["testimonialID"];
$title = $_POST["newTitle"];

$obj = new ServerFunctions();
$obj->editTestimonialTitle($id, $title);