<?php
    include_once "../../controller/ServerFunctions.php";
    $obj = new ServerFunctions();

    $id = $_POST["id"];
    $packageName = $_POST["name"];

    $allowedImageType = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/x-png", "image/pjpeg");
    $allowedImageExtension = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
    $imageExtension = end(explode(".", $_FILES["photo"]["name"]));

    if(in_array($_FILES["photo"]["type"], $allowedImageType) || in_array($imageExtension, $allowedImageExtension)) {
        $newName = $id.".".$imageExtension;
        //delete("../../files/packagesPhotos/".$newName);
        if(move_uploaded_file($_FILES["photo"]["tmp_name"], "../../../files/productsPhotos/".$newName)) {}
        $obj->changeProductPhoto($id, $newName, $packageName);
        #REMOVE the PREVIOUS image
    }
