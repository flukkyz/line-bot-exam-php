<?php

function pushMsg($arrayHeader,$arrayPostData){
    $strUrl = "https://api.line.me/v2/bot/message/push";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close ($ch);
 }


    $accessToken = "k6Noqtym0hpj0/fTeTKzviUFm/1loct7qjecS0bixWZ/hEab7oiOSdf/ebaeCVwrW7vlga4yF6ut8U9nt8wIdlOMSV3tsSXjtrteVKzk49O5GEYuRBWhp8n817NY0REiGUNW+tLzRD2IFkEqZFWDAwdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";

    $message = $arrayJson['events'][0]['message']['text'];
    $id = $arrayJson['events'][0]['source']['userId'];

    if($message == "สวัสดี"){
        $arrayPostData['to'] = $id;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดี ชื่อไรอ่ะ";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "2";
        $arrayPostData['messages'][1]['stickerId'] = "34";
        pushMsg($arrayHeader,$arrayPostData);
    }


    if($message != "สวัสดี"){
        $arrayPostData['to'] = $id;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ไอ่สัส".$message;
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "2";
        $arrayPostData['messages'][1]['stickerId'] = "34";
        pushMsg($arrayHeader,$arrayPostData);
     }

   
   exit;
?>
