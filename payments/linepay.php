<?php

include('../system/config.php');

$m_id = $lpid; //ID вашего мерчанта
$m_secret_2 = $lps1; //Секретное слово №2 вашего мерчанта

$order_id = $_POST['order_id']; // Уникальный идентификатор заказа в вашей системе
$suma = $_POST['amount']; // Сумма заказа
$suma2 = $_POST['amount']; // Сумма заказа2
$sign = $_POST['sign']; // Подпись
$pay_id = $_POST['pay_id']; // Уникальный идентификатор заказа в нашей системе
$us_key = $_POST['us_key']; // Дополнительный параметр (айди человека)


/* проверяем существует ли платеж */
if (is_numeric($us_key))
{
    
    
    
/* достаем данные пользователя */
$sql_select = "SELECT * FROM users WHERE id='$us_key'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$balance = $row['balance'];
$ref = $row['ref_id'];
}



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
$suma = ($suma / 100) * 105; 
}else{
$suma = $suma;
}
*/

$balancenew = $balance + $suma;
$sumawag = $suma * $coefdeposit;

$update_sql1 = "Update users set balance='$balancenew', wager = wager+$sumawag WHERE id='$us_key'";
mysql_query($update_sql1);

/* если заявка оплачена то добавляем платеж юзеру в историю */

$data_pay = date("d.m.Y H:i");
$insert_sql1 = "
INSERT INTO `deposits` (`user_id`, `suma`, `data`, `transaction`) 
VALUES ('{$us_key}', '{$suma}', '{$data_pay}', '{$order_id}')
";
mysql_query($insert_sql1);
 

} 

die('OK');

?>