<?

require ("../system/config.php");
session_start();
$sid = $_SESSION['hash'];

if (!isset($_SESSION['hash']) || empty($_SESSION['hash'])) {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$linksite.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$linksite.'" />';
        echo '</noscript>'; exit;
}

$refer = $_GET['partner'];
if($refer != '') {
$_SESSION['ref'] = $refer;
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$linksite.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$linksite.'" />';
        echo '</noscript>'; exit;
}

$session_site = $_GET['access'];
if($session_site != '') {
$_SESSION['access'] = $session_site;
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$linksite.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$linksite.'" />';
        echo '</noscript>'; exit;
}

$select_current = "SELECT * FROM users WHERE hash = '$sid'";
$result_current = mysql_query($select_current);
$get = mysql_fetch_array($result_current);
if($get)
{	
$login = $get['login'];
$pass = $get['pass'];
$balance = round($get['balance'], 2);
$id = $get['id'];
$social_link = $get['social'];
$is_admin = $get['admin'];
$is_ban = $get['ban'];
$img = $get['img'];
}

require ("../include/header.php");
?>



<body>
 

<div class="_nuxt_container">


<div class="_nuxt_profile_header mb20">
<div class="_nuxt_profile_header_user">
 <img src="<?=$img?>">    
 <span style="--webkit-user-select: text;user-select: text;"><?=$login?> &nbsp ID: <?=$get['id'];?></span>
</div> 
<div class="_nuxt_profile_header_balance">
 <span class="_nuxt_profile_header_balance_title">Баланс:</span>   
 <span><?=round($balance, 2)?></span>
<button data-toggle="modal" data-target="#deposit" class="_nuxt_profile_header_balance_payin"><i class="fa fa-plus"></i></button> 
<button data-toggle="modal" data-target="#withdraw" class="_nuxt_profile_header_balance_payout"><i class="fa fa-minus"></i></button> 
</div>
<div class="_nuxt_profile_header_datareg">
 <span class="_nuxt_profile_header_datareg_title">Дата регистрации:</span>  
 <span><?=$get['data_reg'];?></span>
</div>
</div>

<div class="_nuxt_profile_list mb20">
 <a href="/profile/main">Главная</a>  
 <a href="/profile/refs">Рефералы</a>  
 <a href="/profile/settings">Настройки</a>   
 <a href="/profile/deposits">История</a>     
 <a data-toggle="modal" data-target="#logout">Выход</a>    
</div>

<div class="_nuxt_profile_wallet_menu">
 <a class="active">Пополнения</a>   
 <a href="/profile/withdraws">Выплаты</a>    
</div>

<br>

<div class="_nuxt_games_history">
<header class="_nuxt_games_history_header"><span>#</span><span>Сумма</span><span>Дата</span></header>
<div class="_nuxt_games_history_list">
<?php 
$deposits1 = "SELECT COUNT(*) FROM deposits WHERE user_id='$id' ORDER BY id DESC";
$resultDes = mysql_query($deposits1);
$row = mysql_fetch_array($resultDes);
if($row['COUNT(*)'] == 0)
{
echo 
'
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert" style="color:#fff;">Нет пополнений</div>  
<div class="_nuxt_games_history_insert"></div>  
<div class="_nuxt_games_history_insert"></div>   
</div>
';
}else{
$sql_select5 = "SELECT * FROM deposits WHERE user_id = '$id' ORDER BY id + 0 DESC";
$result5 = mysql_query($sql_select5);
while($row = mysql_fetch_array($result5)) {
$id_pay = $row['id'];
$suma_pay = $row['suma'];
$data_pay = $row['data'];

$suma_pay = round($suma_pay, 2);
$suma_pay = number_format($suma_pay, 2, '.', ' ');


echo 
'
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert">'.$id_pay.'</div>  
<div class="_nuxt_games_history_insert"><b>'.$suma_pay.' L</b></div>  
<div class="_nuxt_games_history_insert"><b>'.$data_pay.'</b></div>   
</div>
';
}
}
?>
</div>
</div>
<?
require ("../include/footer.php");
?> 
  
</div> 
    
    
    
</body>
</html>    