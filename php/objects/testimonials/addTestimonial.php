<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/3/16
 * Time: 11:00 PM
 */

include_once "../../controller/ServerFunctions.php";

$title = $_POST["title"];
$content = $_POST["content"];
$nameAndAge = $_POST["nameAndAge"];

$obj = new ServerFunctions();

$uploadingError = "";
$allowedImageType = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/pjpeg", "image/x-png");
$allowedImageExtension = array("gif", "jpeg", "jpg", "png");
$imageName = $_FILES["photo"]["name"];
$imageExtension = end(explode(".", $imageName));
if(in_array($_FILES["photo"]["type"], $allowedImageType) || in_array($imageExtension, $allowedImageExtension)) {
    if($_FILES["photo"]["error"] > 0) $uploadingError = "Sorry. An error occur while uploading the package photo";
    else {
        $newName = $obj->addTestimonial($title, $content, $nameAndAge, $imageExtension);
        echo "new name = ".$newName;
        move_uploaded_file($_FILES["photo"]["tmp_name"], "../../../files/testimonialsPhotos/".$newName);
    }
}
echo $uploadingError;

