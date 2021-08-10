<?php
 $LINEData = file_get_contents('php://input');
 $jsonData = json_decode($LINEData,true);
 $replyToken = $jsonData["events"][0]["replyToken"];
 $text = $jsonData["events"][0]["message"]["text"];
 
 
 
 function sendMessage($replyJson, $token){
   $ch = curl_init($token["URL"]);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLINFO_HEADER_OUT, true);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json',
       'Authorization: Bearer ' . $token["AccessToken"])
       );
   curl_setopt($ch, CURLOPT_POSTFIELDS, $replyJson);
   $result = curl_exec($ch);
   curl_close($ch);
return $result;
}
 if($text=="จ้า"){
     $message = '{
     "type" : "text",
     "text" : "ไม่มีข้อมูลที่ต้องการ"
     }';
 }else if($text=="จองห้องประชุม"){
       $message = '{
  "type": "template",
  "altText": "This is a buttons template",
  "template": {
      "type": "buttons",
      "thumbnailImageUrl": "https://example.com/bot/images/image.jpg",
      "imageAspectRatio": "rectangle",
      "imageSize": "cover",
      "imageBackgroundColor": "#FFFFFF",
      "title": "Menu",
      "text": "Please select",
      "defaultAction": {
          "type": "uri",
          "label": "View detail",
          "uri": "http://example.com/page/123"
      },
      "actions": [
          {
            "type": "postback",
            "label": "Buy",
            "data": "action=buy&itemid=123"
          },
          {
            "type": "postback",
            "label": "Add to cart",
            "data": "action=add&itemid=123"
          },
          {
            "type": "uri",
            "label": "View detail",
            "uri": "http://example.com/page/123"
          }
      ]
  }
}';
 }

 $replymessage = json_decode($message);//ค่าที่ส่งไป
 $lineData['URL'] = "https://api.line.me/v2/bot/message/reply";
 $lineData['AccessToken'] = "4+wlVCk7j87dsSACquSCsDRO/jDtWmE+zus83z1OarXrxvAQEUUIuVuTL5V0f0zSWWH0LB5kkeWr23DWuUMDqA40QimgrSSr1ljJP4+SHgsF+mQepYcSyIzyTMMYFdhN3txmcZBeaHXX8bt6yZMH5AdB04t89/1O/w1cDnyilFU=";
 $replyJson["replyToken"] = $replyToken;
 $replyJson["messages"][0] = $replymessage;
 
 $encodeJson = json_encode($replyJson);
 
 $results = sendMessage($encodeJson,$lineData);
 echo $results;
 http_response_code(200);
