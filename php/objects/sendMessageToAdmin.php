<?php
    include_once "../controller/ServerFunctions.php";

    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $receiverId = $_POST["receiverID"];

    $obj = new ServerFunctions();
    $obj->sendMessageToAdmin($receiverId, $subject, $message);
