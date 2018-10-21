<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/4/16
 * Time: 12:39 AM
 */

include_once "../../controller/ServerFunctions.php";

$id = $_POST["testimonialID"];
$content = $_POST["newContent"];

$obj = new ServerFunctions();
$obj->editTestimonialContent($id, $content);