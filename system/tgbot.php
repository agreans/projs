<?php
include('connect.php');
include('config.php');

$data = file_get_contents('php://input');
$data = json_decode($data, true);

if (empty($data['message']['chat']['id'])) {
exit();
}

define('TOKEN', '7194138205:AAGKUGxmDlulSAZRMCAukbpmXrPYlOT8GJw');
//сюда ты пидорас, вставляешь то, что выдал бот


// Функция вызова методов API.
function sendTelegram($method, $response)
{
$ch = curl_init('https://api.telegram.org/bot' . TOKEN . '/' . $method);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);

return $res;
}

$tg_id = $data['message']['chat']['id'];

// Ответ на текстовые сообщения.
if (!empty($data['message']['text'])) {
$text = $data['message']['text'];
$cmd = explode(' ', $text);
if ($cmd[0] === '/start') {
sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],

'text' => '
Для Вас есть награда: '.$tgsize.' L!
Чтобы получить выполните условия:

🎯 Подпишитесь на канал '.$sitename.' - @'.$sitesupport.'
🔥 Пришлите команду которую получили на сайте (/bind)  
'
)
);

exit();
}

// Отправка фото.
if ($cmd[0] === '/bind' && $cmd[1] === NULL) {
sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],
'text' => '‼ ID не валиден!️️' 
)
);

exit();
}

if ($cmd[0] === '/bind' && (int)$cmd[1] !== NULL) {
$id = $cmd[1];
$result = mysql_query("SELECT * FROM users WHERE id = '$id'");
$row = mysql_fetch_array($result);

if(!$row) {
sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],
'text' => '‼ ID не существует!'
)
);

exit();   
}
if($row['tg'] == 1) {
sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],
'text' => '✅ Вы уже получали бонус!'
)
);

exit();
}

$tg_idd = $data['message']['chat']['id'];
$sel = mysql_query("SELECT COUNT(*) FROM users WHERE tg_id = '$tg_idd'");
$rrr = mysql_fetch_array($sel);

if($rrr['COUNT(*)'] >= 1) {
sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],
'text' => '✅ Данный телеграм уже привязан!'
)
);

exit();
}
else {
$user_id = $data["message"]["chat"]["id"];
$check = file_get_contents("https://api.telegram.org/bot7194138205:AAGKUGxmDlulSAZRMCAukbpmXrPYlOT8GJw/getChatMember?chat_id=@lotbet_game&user_id=$user_id"); //указываем ссылку на канал без t.me
if (strpos($check, '"status":"left"') == TRUE) {

sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],
'text' => '❌ Вы не подписались на наш телеграм @'.$sitesupport.' ' 
)
);

exit();
}


else {

mysql_query("UPDATE users SET tg = 1, balance = balance + '$tgsize' WHERE id = '$id'");
mysql_query("UPDATE users SET tg_id = $tg_id WHERE id = '$id'");

sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],
'text' => '✅ Вы успешно получили награду, можете вернутся на '.$sitename.' '
)
);

exit();
}
}
if(!$row){
sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],
'text' => '‼ ID не валиден!'
)
);
exit();
}
sendTelegram(
'sendMessage',
array(
'chat_id' => $data['message']['chat']['id'],
'text' => '‼ Вы забыли указать свой ID. Вернитесь на сайт и пришлите нам ваш ID корректно!'
)
);

exit();
}

}


/* запуск бота 

https://api.telegram.org/bot[ТОКЕН]/setWebHook?url=[URL]/system/tgbot.php

*/