<?php
session_start();
$sid = $_SESSION['hash'];
require ("../system/config.php");
$type = $_POST['type'];

if($type == "bubbles") {
 // $winsum = $_POST['win'];
  $sum = $_POST['sum'];
  $per = $_POST['per'];
   $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row){ 
$balance = $row['balance'];
$ban = $row['ban'];
$login = $row['login'];
$user_id = $row['id'];
$wager = $row['wager'];
}
if(!$sid) {
    $error = 1;
    $mess = "Авторизуйтесь!";
    $fa = "exclusive";
} else {
  if($per < 1.02 || $per > 9999 || !is_numeric($per)) {
    $error = 1;
    $mess = "Коэффициент от - 1.02 до 9999!";
    $fa = "exclusive";
  }
  if($sum > $balance) {
    $error = 1;
    $mess = "Недостаточно средств!";
    $fa = "exclusive";
  }
if($sum < $minbet) {
    $error = 1;
    $mess = "Минимальная сумма - $minbet";
    $fa = "exclusive";
}
if($sum > $maxbet) {
    $error = 1;
    $mess = "Максимальная сумма - $maxbet";
    $fa = "exclusive";
}
  if($error == 0) {
  $rand = rand(0, 999999);
  $nwin_g = 100 / $per;
  $nwin = 1000000 - ($nwin_g * 10000);
  if($rand >= $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
          $coef = rand($per * 100, $per * 300.5) / 100;
$www = $sum * $per;

  $newbalance = round($balance + $sum * $per - $sum, 2);
  $wagsum = $wager - $sum;
    $update_sql4 = "UPDATE users SET balance = '$newbalance', wager = '$wagsum' WHERE hash = '$sid'";

    
      mysql_query($update_sql4);
  $fa = "success";
  }
         if($rand < $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
    if($per < 10){
    $rr = rand(1, $per);
}else{
    
        $rr = rand(1, 10);
}
      $coef = rand(10, $rr * 100) / 100;


  $newbalance = $balance - $sum;
   $wagsum = $wager - $sum; 
    $update_sql4 = "UPDATE users SET balance = '$newbalance', wager = '$wagsum' WHERE hash = '$sid'";
      mysql_query($update_sql4);

  $error = 1;
  $mess = "Выпало <b>$coef</b>";
  $fa = "error";
  }
    $hash = hash('sha512', $coef);
    $hashEdit = "yes";
      $mess = "Увы! Вы проиграли!";

 }
}
  $winning = number_format($newbalance, 2, '.', ' ');
  $result = array(
  'success' => "$fa",
  'error' => "$mess",
  'number' => "$coef",
    'hash' => "$hash",
    'fullwin' => "$winning",
    'balance' => "$balance",
    'new_balance' => "$newbalance",
    'mid' => "$sid",
    'mal' => "$balance",
    'hashEdit' => "$hashEdit",
    'rnd' => "$rand",
    'nw' => "$nwin"

    );
}

echo json_encode($result);
?>