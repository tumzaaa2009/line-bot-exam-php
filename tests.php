<?php
  http_response_code(200);
 $LINEData = file_get_contents('php://input');
 $jsonData = json_decode($LINEData,true);
 $replyToken = $jsonData["events"][0]["replyToken"];
 $text = $jsonData["events"][0]["message"]["text"];
 

  global $db_r4;
        define("DB_HOST_local","203.157.102.84");
        define("DB_PORT_local","3306");
        define("DB_NAME_local","rhso4_db_2");
        define("DB_USERNAME_local","root");
        define("DB_PASSWORD_local","kethealth4");
        define("DB_ISO_local","utf8");
        
        // define("DB_HOST_local","127.0.0.1");
        // define("DB_PORT_local","3306");
        // define("DB_NAME_local","r4");
        // define("DB_USERNAME_local","root");
        // define("DB_PASSWORD_local","1");
        // define("DB_ISO_local","utf8");
        
        try {
                $db_r4 = new PDO("mysql:host=".DB_HOST_local.";port=".DB_PORT_local.";dbname=".DB_NAME_local.";", DB_USERNAME_local, DB_PASSWORD_local);
                $db_r4->prepare("SET NAMES ".DB_ISO_local."");
                $db_r4->query("SET NAMES ".DB_ISO_local."");
        } catch(PDOException $e) {
        echo $e->getMessage();
        }



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
 }else if ($text =="จองห้อง"){
   $message = '{
  "type": "template",
  "altText": "this is a image carousel template",
  "template": {
      "type": "image_carousel",
      "columns": [
          {
            "imageUrl": "https://example.com/bot/images/item1.jpg",
            "action": {
              "type": "postback",
              "label": "Buy",
              "data": "action=buy&itemid=111"
            }
          },
          {
            "imageUrl": "https://example.com/bot/images/item2.jpg",
            "action": {
              "type": "message",
              "label": "Yes",
              "text": "yes"
            }
          },
          {
            "imageUrl": "https://example.com/bot/images/item3.jpg",
            "action": {
              "type": "uri",
              "label": "View detail",
              "uri": "http://example.com/page/222"
            }
          }
      ]
  }
}';
 }else if ($text =="เช็ควัน"){
    $selectBooking ="SELECT * FROM bookingR4" ; 
    $rs = $db_r4->prepare($selectBooking);
    $rs->execute();

    $json = array();
    $i = 0; 
    foreach ($rs as $row  ) {
    $rowStartDate = $row['dateBooking'].''.$row['startDate'];
    $rowEndDate = $row['dateBooking'].''.$row['endDate'];
    $message[$i] = '{
     "type" : "text",
     "text" :$rowStartDate
     }';
    $i++;
    }
 
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
