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


    $accessToken = "OlEbUMroXY/Ehw7SVSqNc/Ir9UyUebOCwlN13Ib37Jc6ROWj13R1kGayhAYQWiq44u+/JPVXZzdZqlFfVCNtIsXs+NGajxXP1vjrWPS2YBSB89SeOhfXk0O+0s6mpn3vZRsbqnJniHsj6TRWuXdryQdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";

    $message = $arrayJson['events'][0]['message']['text'];
    $id = $arrayJson['events'][0]['source']['userId'];


    $postback = $arrayJson['events'][0]['postback']['data'];

    $template = [
        "type" => "buttons",
        "thumbnailImageUrl" => "https://helpdesk.payap.ac.th/images/logo_pdf.jpg",
        "imageAspectRatio" => "rectangle",
        "imageSize" => "cover",
        "imageBackgroundColor" => "#FFFFFF",
        "title" => "แจ้งเตือนงานซ่อมแซม",
        "text" => "เปิดการแจ้งเตือนงานซ่อมแซมของคุณ",
        "defaultAction" => [
            "type" => "uri",
            "label" => "View detail",
            "uri" => "helpdesk.payap.ac.th/repairman/update-line-user-id?id=".$id
        ],
        "actions" => [
            [
            "type" => "uri",
            "label" => "เปิดการแจ้งเตือน",
            "uri" => "helpdesk.payap.ac.th/repairman/update-line-user-id?id=".$id
            ],
//             [
//             "type" => "postback",
//             "label" => "Add to cart",
//             "data" => "action=add&itemid=123"
//             ],
//             [
//             "type" => "uri",
//             "label" => "View detail",repairman/update-line-user-id
//             "uri" => "http://example.com/page/123"
//             ]
        ]
    ];

//     if($message == "สวัสดี"){
        $arrayPostData['to'] = $id;
//         $arrayPostData['messages'][0]['type'] = "text";
//         $arrayPostData['messages'][0]['text'] = "สวัสดี ชื่อไรอ่ะ";
//         $arrayPostData['messages'][1]['type'] = "sticker";
//         $arrayPostData['messages'][1]['packageId'] = "2";
//         $arrayPostData['messages'][1]['stickerId'] = "34";
        $arrayPostData['messages'][0]['type'] = "template";
        $arrayPostData['messages'][0]['altText'] = "This is a buttons template";
        $arrayPostData['messages'][0]['template'] = $template;
        pushMsg($arrayHeader,$arrayPostData);
//     }

//     if(!empty($postback)){
//         $arrayPostData['to'] = $id;
//         $arrayPostData['messages'][0]['type'] = "text";
//         $arrayPostData['messages'][0]['text'] = $postback;
//         // $arrayPostData['messages'][1]['type'] = "sticker";
//         // $arrayPostData['messages'][1]['packageId'] = "2";
//         // $arrayPostData['messages'][1]['stickerId'] = "34";
//         // $arrayPostData['messages'][2]['type'] = "template";
//         // $arrayPostData['messages'][2]['altText'] = "This is a buttons template";
//         // $arrayPostData['messages'][2]['template'] = $template;
//         pushMsg($arrayHeader,$arrayPostData);
//     }


    if($message != "uid"){
        $arrayPostData['to'] = $id;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $id;
        pushMsg($arrayHeader,$arrayPostData);
     }

    if($message != "btn"){
        $arrayPostData['messages'][0]['type'] = "template";
        $arrayPostData['messages'][0]['altText'] = "This is a buttons template";
        $arrayPostData['messages'][0]['template'] = $template;
        pushMsg($arrayHeader,$arrayPostData);
     }

   
   exit;
?>
