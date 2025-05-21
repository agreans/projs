 <?
require("connect.php"); // Подключение к базе данных


$sql_select1 = "SELECT * FROM config";
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{
$linksite = "https://$_SERVER[HTTP_HOST]"; //url
$sitename = $row['sitename']; //название сайта
$sitegroup = $row['sitegroup']; //группа вк 
$sitedomen = $row['sitedomen']; //домен сайта
$sitesupport = $row['sitesupport']; //телеграм для связи
$dep_withdraw = $row['dep_withdraw']; //депозит для вывода
$min_withdraw_sum = $row['min_withdraw_sum']; // минимальная сумма вывода (глобальная)
$min_sum_dep = $row['min_sum_dep']; //минимальная сумма депозита
$id_vk = $row['id_vk']; //айди приложеения вк
$token_vk = $row['token_vk']; //токен приложения вк
$coefbonus = $row['wagerbonus']; //коэф вагера на бонусы
$coefdeposit = $row['wagerdeposit']; //коэф вагера на депозит
$coefpromo = $row['wagerpromo']; //коэф вагера на промокоды
$fkid = $row['fkid']; //айди кассы фрикасса
$fks1 = $row['fks1']; //секретный ключ 1 фрикасса
$fks2 = $row['fks2']; //секретный ключ 2 фрикасса
$lpid = $row['lpid']; //айди кассы linepay
$lps1 = $row['lps1']; //секретный ключ 1 linepay
$lps2 = $row['lps2']; //секретный ключ 2 linepay
$vkgoupid = $row['vkgoupid']; //айди группы вк
$vkgrouptoken = $row['vkgrouptoken']; //api токен группы вк
$is_teh = $row['tehworks']; //технические работы
$grecaptcha = $row['grecaptcha']; //рекапча ключ
$maxbet = $row['maxbet']; //максимальная ставка в режимах
$minbet = $row['minbet']; //минимальная ставка в режимах
$min_daily_size = $row['daily_min']; //минимальная сумма в раздаче
$max_daily_size = $row['daily_max']; //максимальная сумма в раздаче
$vkgroupsize = $row['vkgroupsize']; //бонус за подписку на группу вк
$vkrepostsize = $row['vkrepostsize']; //бонус за репост записи вк
$dep_for_send = $row['dep_for_send']; // депозит для перевода игрокам
$wager_for_bets = $row['wager_for_bets']; //сколько будет списывается с общего вагера
$cashback_percent = $row['cashback_percent']; //сколько будет отчислятся в cashback
$site_vault = "L"; //валюта сайта
$repostUrl = $row['repostUrl']; // ссылка на репост вк
$max_mines = $row['max_mines']; // макс коэф мины
$tgsize = $row['tgsize']; //бонус за тг
$refrandprize = $row['refrandprize']; //бонус за реферала
//$pstype = $row['pstype']; //платежка для оплаты /1- fk /2- linepay
$pstype = '2'; //платежка для оплаты /1- fk /2- linepay
    
}


// Для вк
$client_id = $id_vk; // ID приложения
$client_secret = $token_vk; // Защищённый ключ
$redirect_uri = "$linksite/auth/vknew/auth.php"; // Адрес сайта
