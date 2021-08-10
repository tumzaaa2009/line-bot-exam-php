<?php 
 /*Return HTTP Request 200*/
 http_response_code(200);
file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
{"events":[{"type":"message","replyToken":"7d7d02d64b954dfcb93683de8cc41f5f","source":{"userId":"U1a81dc36b7c95042c6ee4718cd5a7c18","type":"user"},"timestamp":1552505328709,"message":{"type":"text","id":"9509179836165","text":"ทดสอบ"}}],"destination":"Uf34ef2c60c48fb450b5abba7bda444cf"}
?>
