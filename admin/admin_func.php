<?php
session_start();
require("../system/config.php");
$sid = $_SESSION['hash'];
$type = $_POST['type'];
$error = 0;
$fa = "";
$admin_check = "SELECT * FROM users WHERE hash = '$sid'";
$result_admin = mysql_query($admin_check);
$row = mysql_fetch_array($result_admin);
if($row)
{	
$check_adm = $row['admin'];
}



if($type == "responseTicket") {
  $ticket_id = $_POST['ticket_id']; 
  $ticket_mess = $_POST['ticket_mess']; 
  
if($check_adm != 1) {
  $error = 1;
  $mess = "Вы не являетесь администратором";
  $fa = "error";
}

  if($check_adm == 1) {
      
$update_sql1 = "Update support set system_msg = '$ticket_mess', status = 2 WHERE id='$ticket_id'";
      mysql_query($update_sql1);

    $fa = "success";
  }
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}

if($type == "resetWager") {
  $user_id_selected = $_POST['user_id_selected']; 

if($check_adm != 1) {
  $error = 1;
  $mess = "Вы не являетесь администратором";
  $fa = "error";
}

  if($check_adm == 1) {
      
    $update_config_1 = "Update users set wager = '0' WHERE id = '$user_id_selected'";
      mysql_query($update_config_1);

    $fa = "success";
  }
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}

if($type == "save_edit") {
  $newsitename = $_POST['sitename']; 
  $newsitedomen = $_POST['sitedomen']; 
  $newsitegroup = $_POST['sitegroup']; 
  $newsitesupport = $_POST['sitesupport']; 
  $newminwithdraw = $_POST['min_withdraw_sum']; 
  $newcoefbonwag = $_POST['coefbon1wag'];
  $newcoefdepwag = $_POST['coefdep1wag'];  
  $depwithdraw = $_POST['dep_withdraw'];
  $mindep = $_POST['min_deposit'];
  $token = $_POST['token_vk'];
  $idgroup = $_POST['id_vk'];
  $fkid = $_POST['fkid'];
  $fks1 = $_POST['fks1'];
  $fks2 = $_POST['fks2'];
  $vkgoupid = $_POST['vkgoupid'];
  $vkgrouptoken = $_POST['vkgrouptoken'];  
  $tehworks = $_POST['tehworks'];
  $grecaptchakeys = $_POST['grecaptchakeys'];
  $minbet = $_POST['minbet'];
  $maxbet = $_POST['maxbet'];  
  $daily_min = $_POST['daily_min'];
  $daily_max = $_POST['daily_max'];
  $vkgroupsize = $_POST['vkgroupsize'];
  $vkrepostsize = $_POST['vkrepostsize'];   
  $coefpromwag = $_POST['coefpromwag'];  
  $withdraw_min_sbp = $_POST['withdraw_min_sbp'];  
  $withdraw_min_fkwallet = $_POST['withdraw_min_fkwallet'];    
  $wager_for_bets = $_POST['wager_for_bets'];   
  $lpid = $_POST['lpid']; 
  $lps1 = $_POST['lps1']; 
  $lps2 = $_POST['lps2']; 
  $repostUrl = $_POST['repostUrl']; 
  $tgsize = $_POST['tgsize'];  
  $max_mines = $_POST['max_mines'];
  $refrandprize = $_POST['refrandprize'];
if($check_adm != 1) {
  $error = 1;
  $mess = "Вы не являетесь администратором";
  $fa = "error";
}
  
  if($check_adm == 1) {
      
    $update_config_1 = "Update config set sitename = '$newsitename'";
      mysql_query($update_config_1);
    $update_config_2 = "Update config set sitedomen = '$newsitedomen'";
      mysql_query($update_config_2);
    $update_config_3 = "Update config set sitegroup = '$newsitegroup'";
      mysql_query($update_config_3);
    $update_config_4 = "Update config set sitesupport = '$newsitesupport'";
      mysql_query($update_config_4);
    $update_config_5 = "Update config set min_withdraw_sum = '$newminwithdraw'";
      mysql_query($update_config_5);
    $update_config_6 = "Update config set dep_withdraw = '$depwithdraw'";
      mysql_query($update_config_6);
    $update_config_7 = "Update config set min_sum_dep = '$mindep'";
      mysql_query($update_config_7);
    $update_config_8 = "Update config set token_vk = '$token'";
      mysql_query($update_config_8);
    $update_config_9 = "Update config set id_vk = '$idgroup'";
      mysql_query($update_config_9);
     $update_config_10 = "Update config set wagerbonus = '$newcoefbonwag'";
      mysql_query($update_config_10);
     $update_config_11 = "Update config set wagerdeposit = '$newcoefdepwag'";
      mysql_query($update_config_11);      
     $update_config_12 = "Update config set fkid = '$fkid'";
      mysql_query($update_config_12);     
     $update_config_13 = "Update config set fks1 = '$fks1'";
      mysql_query($update_config_13); 
     $update_config_14 = "Update config set fks2 = '$fks2'";
      mysql_query($update_config_14); 
     $update_config_15 = "Update config set vkgoupid = '$vkgoupid'";
      mysql_query($update_config_15); 
     $update_config_16 = "Update config set vkgrouptoken = '$vkgrouptoken'";
      mysql_query($update_config_16);       
     $update_config_17 = "Update config set tehworks = '$tehworks'";
      mysql_query($update_config_17);
     $update_config_18 = "Update config set grecaptcha = '$grecaptchakeys'";
      mysql_query($update_config_18);   
     $update_config_19 = "Update config set minbet = '$minbet'";
      mysql_query($update_config_19);
     $update_config_20 = "Update config set maxbet = '$maxbet'";
      mysql_query($update_config_20);         
     $update_config_21 = "Update config set daily_min = '$daily_min'";
      mysql_query($update_config_21);    
     $update_config_22 = "Update config set daily_max = '$daily_max'";
      mysql_query($update_config_22);     
     $update_config_23 = "Update config set vkgroupsize = '$vkgroupsize'";
      mysql_query($update_config_23); 
     $update_config_24 = "Update config set vkrepostsize = '$vkrepostsize'";
      mysql_query($update_config_24);  
     $update_config_25 = "Update config set wagerpromo = '$coefpromwag'";
      mysql_query($update_config_25);  
     $update_config_26 = "Update config set wager_for_bets = '$wager_for_bets'";
      mysql_query($update_config_26); 
     $update_config_27 = "Update config set lpid = '$lpid'";
      mysql_query($update_config_27); 
     $update_config_28 = "Update config set lps1 = '$lps1'";
      mysql_query($update_config_28); 
     $update_config_29 = "Update config set lps2 = '$lps2'";
      mysql_query($update_config_29);       
     $update_config_30 = "Update config set repostUrl = '$repostUrl'";
      mysql_query($update_config_30); 
     $update_config_31 = "Update config set tgsize = '$tgsize'";
      mysql_query($update_config_31);       
     $update_config_32 = "Update config set max_mines = '$max_mines'";
      mysql_query($update_config_32);    
     $update_config_33 = "Update config set refrandprize = '$refrandprize'";
      mysql_query($update_config_33);    
    $fa = "success";
  }
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}

if($type == "editstatus") {
$id_edit = $_POST['id_edit'];
$id_user = $_POST['id_user'];
$usersum = $_POST['id_sum'];


$fsdfsdf = ($usersum * 100) / 97;

$status = $_POST['status'];
if($check_adm == 1) {
if($status == "error") {
$update_sql2 = "Update withdraws set status = 2 WHERE id='$id_edit'";
      mysql_query($update_sql2);
      
$update_sql2 = "Update users set balance = balance + $fsdfsdf WHERE id='$id_user'";
      mysql_query($update_sql2);
      
$fa = "success";
}
if($status == "succes") {
$update_sql2 = "Update withdraws set status = 1 WHERE id='$id_edit'";
      mysql_query($update_sql2);
      
$fa = "success";
}

if($status == "procces") {
$update_sql2 = "Update withdraws set status = 3 WHERE id='$id_edit'";
      mysql_query($update_sql2);
    
      
      
$fa = "success";
}
}
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}
if($type == "creatpromo") {
$name = $_POST['promoname'];
$sum = $_POST['promosum']; 
$act = $_POST['promoact'];
$dpromo = strlen($name);
$check = "SELECT COUNT(*) FROM promo WHERE name = '$name'";
$result = mysql_query($check);
$row = mysql_fetch_array($result);
if($row)
{	
$countprom = $row['COUNT(*)'];
}
$dpromo = strlen($name);
if($countprom > 0) {
  $error = 1;
  $mess = "Такой промокод уже существует";
  $fa = "error";
}
if($name == '' || $sum == '' || $act == '') {
  $error = 2;
  $mess = "Заполните все поля";
  $fa = "error";
}
  if($check_adm != 1) {
  $error = 3;
  $mess = "Вы не являетесь администратором";
  $fa = "error";
}
  if($dpromo < 1) {
    $error = 4;
    $mess = "Длина промокода от 1 символа";
    $fa = "error";
}
  if(!is_numeric($sum)) {
    $error = 5;
    $mess = "Введите сумму корректно";
    $fa = "error";
}
  if(!is_numeric($act)) {
    $error = 6;
    $mess = "Введите кол-во корректно";
    $fa = "error";
}
  if($sum < 1) {
    $error = 7;
    $mess = "Сумма промокода от 1";
    $fa = "error";
}
  if($act < 1) {
    $error = 8;
    $mess = "Кол-во от 1";
    $fa = "error";
}
  if($dpromo > 15) {
    $error = 9;
    $mess = "Длина промокода до 15 символов";
    $fa = "error";
}
  if($error == 0) {
    $datas = date("d.m.Y");
	$datass = date("H:i:s");
	$data = "$datas $datass";
    $insert_sql111 = "INSERT INTO `promo` (`id`, `date`,  `name`, `sum`, `active`, `actived`, `id_active`) VALUES (NULL, '$data', '$name', '$sum', '$act', '0', '');";
     mysql_query($insert_sql111);
    $fa = "success";
  }
  $result = array(
    'success' => "$fa",
	'error' => "$mess",
    'promoname' => "$name"
    ); 
}
if($type == "saveInfo") {
$id = $_POST['id'];
$new_bal = $_POST['userbal'];
$role_user = $_POST['role_user'];
$ban_user = $_POST['ban_user'];

if($check_adm != 1) {
  $error = 1;
  $mess = "Вы не являетесь администратором";
  $fa = "error";
}
  if($check_adm == 1) {

$update_sql112 = "Update users set balance = '$new_bal' WHERE id='$id'";
mysql_query($update_sql112);
$update_sql112 = "Update users set admin = '$role_user' WHERE id='$id'";
mysql_query($update_sql112);
$update_sql112 = "Update users set ban = '$ban_user' WHERE id='$id'";
mysql_query($update_sql112);
   
      
      
    $fa = "success";
  }
  
    $result = array(
    'success' => "$fa",
	'error' => "$mess",
	'id' => "$id",
    'bal' => "$new_bal",
    'role' => "$role_user"
      
    ); 
  
}
if($type == "getInfo") {
  $id = $_POST['id'];
  $selecter = "SELECT * FROM users WHERE id = '$id'";
$result_select = mysql_query($selecter);
$row = mysql_fetch_array($result_select);
if($row)
{	
$login = $row['login'];
$pass = $row['pass'];
$balance = $row['balance'];
}
  if($check_adm == 1) {
    $fa = "success";
  }
  
    $result = array(
    'success' => "$fa",
	'error' => "$mess",
	'log' => "$login",
	'pass' => "$pass",
    'bal' => "$balance",
    'id' => "$id"
      
    ); 
  
}
if($type == "ban") {
$hash_ban = $_POST['hashuser'];
if($check_adm != 1) {
$error = 1;
$mess = "Вы не являетесь администратором";
$fa = "error";
}
if($check_adm == 1) {
$update_sql4 = "Update users set ban=1 WHERE id='$hash_ban'";
      mysql_query($update_sql4);
  $fa = "success";
}
$result = array(
	'success' => "$fa",
	'error' => "$mess"
    ); 
}

if($type == "unban") {
$hash_ban = $_POST['hashuser'];
if($check_adm != 1) {
$error = 1;
$mess = "Вы не являетесь администратором";
$fa = "error";
}
if($check_adm == 1) {
$update_sql4 = "Update users set ban=0 WHERE id='$hash_ban'";
      mysql_query($update_sql4);
  $fa = "success";
}
$result = array(
	'success' => "$fa",
	'error' => "$mess"
    ); 

}

if($type == "del_promo") {
$id_promo = $_POST['id_promo'];
if($check_adm == 1) {

$update_sql2 = "DELETE FROM promo WHERE id='$id_promo'";
      mysql_query($update_sql2);
$fa = "success";

}
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}

if($type == "creategift") {
$giftname = $_POST['giftname'];
$prize = $_POST['giftprize']; 
$maxusers = $_POST['giftmaxusers'];

$dpromo = strlen($giftname);

$check = "SELECT COUNT(*) FROM gift WHERE giftname = '$name'";
$result = mysql_query($check);
$row = mysql_fetch_array($result);
if($row)
{	
$countgift = $row['COUNT(*)'];
}
$dpromo = strlen($name);
if($countgift > 0) {
  $error = 1;
  $mess = "Такой айди конкурса уже существует";
  $fa = "error";
}
if($giftname == '' || $prize == '' || $maxusers == '') {
  $error = 2;
  $mess = "Заполните все поля";
  $fa = "error";
}
  if($check_adm != 1) {
  $error = 3;
  $mess = "Вы не являетесь администратором";
  $fa = "error";
}
  if($giftname > 4) {
  $error = 4;
  $mess = "Длина ID не меньше 4 символов";
  $fa = "error";
}
  if($prize < 50) {
  $error = 5;
  $mess = "Приз не может быть меньше 50 рублей";
  $fa = "error";
}
  if($maxusers == NULL) {
  $error = 6;
  $mess = "Кол-во победителей от 1";
  $fa = "error";
}


  if($error == 0) {
    $datas = date("d.m.Y");
	$datass = date("H:i:s");
	$data = "$datas $datass";
    $insert_sql111 = "INSERT INTO `gift` (`id`, `date`,  `giftname`, `prize`, `max_users`, `users`, `id_active`, `status`) VALUES (NULL, '$data', '$giftname', '$prize', '$maxusers', '0', '', '0');";
     mysql_query($insert_sql111);
    $fa = "success";
  }
  $result = array(
    'success' => "$fa",
	'error' => "$mess",
    'promoname' => "$name"
    ); 
}

if($type == "completeGift") {
$name_gift = $_POST['id_gift'];
if($check_adm == 1) {

$update_sql2 = "Update gift set status=1 WHERE id='$name_gift'";
      mysql_query($update_sql2);
$fa = "success";

}
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}




if($type == "sqlclear_games") {

if($check_adm != 1) {
$error = 1;
$mess = "Вы не являетесь администратором";
$fa = "error";
}

if($error == 0) {
$query = mysql_query("TRUNCATE `dice`");
$query = mysql_query("TRUNCATE `mines-game`");
$fa = "success";

}
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}

if($type == "sqlclear_chat") {

if($check_adm != 1) {
$error = 1;
$mess = "Вы не являетесь администратором";
$fa = "error";
}

if($error == 0) {
$query = mysql_query("TRUNCATE `chat`");
$login = '<span style="color: #ffc943;font-weight: 600">'.$sitename.'</span>';
$mess = '<span style="font-weight: 700">Чат очищен администрацией</span>';
$photo = '../images/logo-mob.png';
$query = mysql_query("INSERT INTO `chat` (`login`,`photo`,`mess`,`vk_id`,`id_users`) VALUES ('$login','$photo','$mess','https://vk.com/','none')");
$fa = "success";

}
  $result = array(
    'success' => "$fa",
	'error' => "$mess"
    ); 
}


echo json_encode($result);
?>