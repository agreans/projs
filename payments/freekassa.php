<?php

include('../system/config.php');

/* данные freekassa */ 
$merchant_id = $fkid;
$merchant_secret = $fks2;

/* проверка ip */ 
function getIP() {
if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
return $_SERVER['REMOTE_ADDR'];
}

if (!in_array(getIP(), array('168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79', '51.250.54.238', '116.203.217.0', '51.250.25.122'))) die("hacking attempt!");
$sign = md5($merchant_id.':'.$_REQUEST['AMOUNT'].':'.$merchant_secret.':'.$_REQUEST['MERCHANT_ORDER_ID']);
if ($sign != $_REQUEST['SIGN']) {
die('wrong sign');
}

/* данные возвращаемые платежом */
$label = $_GET['MERCHANT_ID']; //айди магазина
$order_id = $_GET['MERCHANT_ORDER_ID']; //айди транзакции в системе
$user_id_pay = $_GET['us_id']; //айди пользователя
$suma = $_GET['AMOUNT']; //сумма платежа
$suma2 = $_GET['AMOUNT']; //сумма платежа (дубль)
$currency_pay = $_GET['CUR_ID']; //метод оплаты

/* проверяем существует ли ордер у платежа и выполняем действия */
if (is_numeric($user_id_pay))
{
/* достаем данные пользователя */    
$sql_select = "SELECT * FROM users WHERE id='$user_id_pay'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$balance = $row['balance'];
$ref = $row['ref_id'];
}

/* зачисление РЕФЕРАЛА */ 


if($ref >= 1)
{
$sql_select = "SELECT * FROM users WHERE id='$ref'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{
$reefearns = $row['refearn'];
$ref_deps = $row['ref_deps'];
$ref_deps_sum = $row['ref_deps_sum'];
$ref_per = $row['ref_per'];


$ref_deps_all = $ref_deps + 1;
$ref_deps_sum_all = $ref_deps_sum + $suma;

$sumaref = ($suma / 100) * $ref_per; //процент отчисления рефки для рефера %

$erarn = $reefearns+$sumaref;
$balanceref = $row['balance'];
$balancerefs = $balanceref + $sumaref;
$update_sql1 = "Update users set balance='$balancerefs', refearn='$erarn', ref_deps='$ref_deps_all', ref_deps_sum='$ref_deps_sum_all' WHERE id='$ref'";
mysql_query($update_sql1) or die("" . mysql_error());

}
} 

/* если заявка оплачена то зачисляем платеж пользователю*/

/* бонус к депозиту
if($currency_pay == 42){
$suma = ($suma / 100) * 105; //5% к депозиту бонус
}else{
$suma = $suma;
}
*/

$balancenew = $balance + $suma;
$sumawag = $suma * $coefdeposit;

$update_sql1 = "Update users set balance='$balancenew', wager = wager+$sumawag WHERE id='$user_id_pay'";
mysql_query($update_sql1);

/* если заявка оплачена то добавляем платеж юзеру в историю */
$data_pay = date("d.m.Y H:i");
$insert_sql1 = "
INSERT INTO `deposits` (`user_id`, `suma`, `data`, `transaction`) 
VALUES ('{$user_id_pay}', '{$suma}', '{$data_pay}', '{$order_id}')
";
mysql_query($insert_sql1);

 

} 

    die('OK');
?>