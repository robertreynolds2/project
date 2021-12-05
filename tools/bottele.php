<?php
 
define('BOT_TOKEN', '1927459157:AAGMv998PtI3KZTQzCuokpMyb3h8DEZ7Vo4');
define('CHAT_ID','1687559610');
 
function kirimTelegram($pesan) {
    $pesan = json_encode($pesan);
    $API = "https://api.telegram.org/bot".BOT_TOKEN."/sendmessage?chat_id=".CHAT_ID."&text=$pesan";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $API);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
 
kirimTelegram("jancok");

?>
