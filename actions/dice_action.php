<?php
session_start();
$sid = $_SESSION['hash'];
require ("../system/config.php");
$type = $_POST['type'];

if($type == "dice") {
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$id1 = $row['id'];
$balance = $row['balance'];
$bonus = $row['bonus'];
$wager = $row['wager'];
}

    $cel = $_POST['celwin'];
    $rand = rand(100,10000) / 100;
    $sum = $_POST['betsize'];
if($sum > $balance) {
    $error = 1;
    $mess = "У Вас недостаточно средств!";
    $fa = "fatal";
}
if(!is_numeric($sum)) {
    $error = 2;
    $mess = "Введите сумму корректно";
    $fa = "fatal";
}
if($sum < $minbet) {
    $error = 3;
    $mess = "Минимальная сумма - $minbet";
    $fa = "fatal";
}
if($sum > $maxbet) {
    $error = 3;
    $mess = "Максимальная сумма - $maxbet";
    $fa = "fatal";
}
if($cel < 1) {
    $error = 4;
    $mess = "Минимальный шанс - 1%";
    $fa = "fatal";
}
if(!is_numeric($cel)) {
    $error = 5;
    $mess = "Ошибка";
    $fa = "fatal";
}
if(!$_SESSION['hash']) {
    $error = 6;
    $mess = "Необходима авторизация!";
    $fa = "fatal";
}
if($error == 0) {
    
if($cel <= $rand) {
$win1 = round((100 - $cel), 2);
$win = round((99 / $win1), 2);
$newbalance = $balance + round((($sum * $win) - $sum),2);
   $wagsum = $wager - $sum; 
$update_sql2 = "UPDATE users SET balance = '$newbalance', wager = '$wagsum' WHERE hash = '$sid'";
mysql_query($update_sql2);     

$time = date('d.m Y');
$coef = $win / $sum;
$coef = round($coef, 2);
mysql_query("INSERT INTO `dice` (`user_id`, `bet`, `chance`, `btn`, `win`, `rand`,`create_at`,`game`,`coef`) VALUES ('$id1', '$sum', '$cel', '', '$win', '','$time','Dice','$coef')");

$hash = hash('sha512', $rand);  
$fa = "success";
}
if($cel > $rand) {
$newbalance = $balance - $sum;
   $wagsum = $wager - $sum; 
$update_sql2 = "UPDATE users SET balance = '$newbalance', wager = '$wagsum' WHERE hash = '$sid'";
mysql_query($update_sql2);     

$time = date('d.m Y');
$coef = $win / $sum;
$coef = round($coef, 2);
mysql_query("INSERT INTO `dice` (`user_id`, `bet`, `chance`, `btn`, `win`, `rand`,`create_at`,`game`,`coef`) VALUES ('$id1', '$sum', '$cel', '', '0', '','$time','Dice','0')");

$hash = hash('sha512', $rand); 
$fa = "error";
}
    }
    $result = array(
'success' => "$fa",
'error' => "$mess",
'num' => "$rand",
'balance' => "$balance",
'new_balance' => "$newbalance",
'hash' => "$hash"
    );
}


echo json_encode($result);
?>