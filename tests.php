<?php 
equire "vendor/autoload.php";
$access_token = '4+wlVCk7j87dsSACquSCsDRO/jDtWmE+zus83z1OarXrxvAQEUUIuVuTL5V0f0zSWWH0LB5kkeWr23DWuUMDqA40QimgrSSr1ljJP4+SHgsF+mQepYcSyIzyTMMYFdhN3txmcZBeaHXX8bt6yZMH5AdB04t89/1O/w1cDnyilFU=';
$channelSecret = '26d6ea508382e3acb3007dea0544b1c4';
$idPush = '1656301793'
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($idPush, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();


?>
