<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 8/20/16
 * Time: 5:41 PM
 */
//$phoneNumber = "639268731278";
$clientName = $_POST["clientName"];
$address = $_POST["address"];
$contact = $_POST["contact"];
$clientOrders = $_POST["clientOrders"];
$method = $_POST["method"];

if($method == "pick-up") {
    $message = "Essensa Order Notification:
            From: ".$clientName."
            Contact No.: ".$contact."
            Orders: ".$clientOrders."
            Method: ".$method;
} else {
    $message = "Essensa Order Notification:
From: ".$clientName."
Contact No.: ".$contact."
Address: ".$address."
Orders: ".$clientOrders."
Method: ".$method;

}
$messageId = rand(0, 9999999999999);

while(strlen($messageId) != 32) {
    $messageId .= rand(0, 99999999999999);
    if(strlen($messageId) > 32) {
        break;
    }
}

$finalMessageId = substr($messageId, 0, 32);

//echo "yeyy = " .$verificationCode;
//===== Using Chikka API here to sent the verification code the user [ AS SENDER ] From Web to the person's phone/mobile

/*$arr_post_body = array(
    "message_type" => "SEND",
    "mobile_number" => "639268731278",
    "shortcode" => "29290524767",
    "message_id" => $finalMessageId,
    "message" => urlencode($message),
    "client_id" => "f32d2da697dbcee9fde29aabceaeb6e9e34c7a63762814f186cd927cd18c7260",
    "secret_key" => "be51d0009b7f42712a0847b4677c495544b0d1c51c5a56b1ecd06a545e8265fc"
);*/

$arr_post_body = array(
    "message_type" => "SEND",
    "mobile_number" => 639330262657,
    "shortcode" => "29290439",
    "message_id" => $finalMessageId,
    "message" => urlencode($message),
    "client_id" => "b9f9fc65fab192171c44aafd78afac20b2ea100ee10dd22aee7941073417afc4",
    "secret_key" => "bb16f8000c71ddb07f401e0e587bed25488d2533370ed90b10308fd7bd42db0c"
);

$query_string = "";
foreach($arr_post_body as $key => $frow) {
    $query_string .= '&'.$key.'='.$frow;
}

$URL = "https://post.chikka.com/smsapi/request";

$curl_handler = curl_init();
curl_setopt($curl_handler, CURLOPT_URL, $URL);
curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
//-- additional starts here
curl_setopt($curl_handler, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl_handler, CURLOPT_SSL_VERIFYPEER, 0);

$response = curl_exec($curl_handler);
if($response === false) {
    echo 'Curl error: ' . curl_error($curl_handler);
} else {
    echo "\nresponse is = ".$response;
}
//$resp = json_decode($response);
//echo "response: message = ".$resp["message"]." status = ".$resp["status"];
curl_close($curl_handler);

exit(0);