<?php
  http_response_code(200);
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
  "destination": "xxxxxxxxxx",
  "events": [
    {
      "replyToken": "0f3779fba3b349968c5d07db31eab56f",
      "type": "message",
      "mode": "active",
      "timestamp": 1462629479859,
      "source": {
        "type": "user",
        "userId": "U4af4980629..."
      },
      "message": {
        "id": "325708",
        "type": "text",
        "text": "Hello, world"
      }
    },
    {
      "replyToken": "8cf9239d56244f4197887e939187e19e",
      "type": "follow",
      "mode": "active",
      "timestamp": 1462629479859,
      "source": {
        "type": "user",
        "userId": "U4af4980629..."
      }
    }
  ]
}';
 }else if ($text =="จองห้อง"){
    $message = '{
  "type": "template",
  "altText": "this is a confirm template",
  "template": {
      "type": "confirm",
      "text": "Are you sure?",
      "actions": [
          {
            "type": "uri",
            "label": "กดดดดด",
            "uri": "https://rh4.moph.go.th/fullCalrendarV4"
          },
          {
            "type": "message",
            "label": "No",
            "text": "no"
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

?>
