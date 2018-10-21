<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 10/2/16
 * Time: 7:58 PM
 */

    include_once "../../controller/CustomerFunctions.php";
    $obj = new CustomerFunctions();

    $transID = $_POST["transID"];
    $desc = $_POST["description"];

    $allowedImageType = array("image/jpeg", "image/jpg", "image/png", "image/x-png", "image/pjpeg");
    $allowedImageExtension = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
    $imageExtension = end(explode(".", $_FILES["proofOfPaymentPhoto"]["name"]));

    if(in_array($_FILES["proofOfPaymentPhoto"]["type"], $allowedImageType) || in_array($imageExtension, $allowedImageExtension)) {
        $newName = $transID.".".$imageExtension;
        if(move_uploaded_file($_FILES["proofOfPaymentPhoto"]["tmp_name"], "../../../files/proofOfPaymentPhotos/".$newName)) {}
        $obj->attachProofOfPayment($transID, $newName, $desc);
        #REMOVE the PREVIOUS image
    }
