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
 <a href="/profile/deposits">Пополнения</a>   
 <a class="active">Выплаты</a>    
</div>

<br>

<div class="_nuxt_games_history">
<header class="_nuxt_games_history_header"><span>#</span><span>Сумма</span><span>Метод</span><span>Статус</span></header>
<div class="_nuxt_games_history_list" id="withdraws-table">
<?php 
$deposits1 = "SELECT COUNT(*) FROM withdraws WHERE user_id='$id' ORDER BY id DESC";
$resultDes = mysql_query($deposits1);
$row = mysql_fetch_array($resultDes);
if($row['COUNT(*)'] == 0)
{
echo 
'
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert" style="color:#fff;">Нет выплат</div>  
<div class="_nuxt_games_history_insert"></div>  
<div class="_nuxt_games_history_insert"></div>   
<div class="_nuxt_games_history_insert"></div>   
</div>
';
}else{
$sql_select5 = "SELECT * FROM withdraws WHERE user_id = '$id' ORDER BY id + 0 DESC";
$result5 = mysql_query($sql_select5);
while($row = mysql_fetch_array($result5)) {
$id_pay = $row['id'];
$suma_pay = $row['sum'];
$suma_pay = round($suma_pay, 2);
$suma_pay_real = ($suma_pay * 100) / 97;
$suma_pay_real = round($suma_pay_real, 2);
$data_pay = $row['date'];
$ps_pay = $row['ps'];
$status_pay = $row['status'];
$wallet_pay = $row['wallet'];

$suma_pay = round($suma_pay, 2);
$suma_pay = number_format($suma_pay, 2, '.', ' ');

if($status_pay == 0){
$withdraw_btn = '<div onClick="removeWithdraw('.$id_pay.');" class="_nuxt_button _nuxt_with_btn" style="    border-radius: 5px;font-size: 13px;">Отменить</div>';
$withdraw_more_status = 'Ожидание';
$withdraw_color = 'color:#ee9718';
}
if($status_pay == 1){
$withdraw_btn = '<span style="color: var(--color);">Успешно</span>';
$withdraw_more_status = 'Успешно';
$withdraw_color = 'color: var(--color)';
}
if($status_pay == 2){
$withdraw_btn = '<span style="color: #ed6b5e;">Ошибка</span>';
$withdraw_more_status = 'Ошибка';
$withdraw_color = 'color: #ed6b5e;';
}
if($status_pay == 3){
$withdraw_btn = '<span style="color:#ffff">Агрегатор</span>';
$withdraw_more_status = 'Агрегатор';
$withdraw_color = 'color:#fff';
}

echo 
'
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert" style="cursor:pointer;" onClick="showWithdraw('.$id_pay.');"><i style="margin-right: 5px;" class="fa-solid fa-circle-question"></i> '.$id_pay.'</div>  
<div class="_nuxt_games_history_insert"><b>'.$suma_pay_real.' L</b></div>  
<div class="_nuxt_games_history_insert"><img style="width: 24px;height: 24px;" src="../media/payments/'.$ps_pay.'.png"></div>   
<div class="_nuxt_games_history_insert">'.$withdraw_btn.'</div>   
</div>

<div id="'.$id_pay.'" class="_nuxt_withdraw_hiden" style="display:none;">
<div class="_nuxt_grd_wd"> <span class="_nuxt_wd_title">ID выплаты:</span> <span class="_nuxt_wd_infos">'.$id_pay.'</span> </div>
<div class="_nuxt_grd_wd"> <span class="_nuxt_wd_title">Сумма:</span> <span class="_nuxt_wd_infos">'.$suma_pay_real.' '.$site_vault.'</span> </div>
<div class="_nuxt_grd_wd"> <span class="_nuxt_wd_title">Сумма к получению:</span> <span class="_nuxt_wd_infos">'.$suma_pay.' '.$site_vault.'</span> </div>
<div class="_nuxt_grd_wd"> <span class="_nuxt_wd_title">Метод:</span> <span class="_nuxt_wd_infos">'.$ps_pay.'</span> </div>
<div class="_nuxt_grd_wd"> <span class="_nuxt_wd_title">Дата:</span> <span class="_nuxt_wd_infos">'.$data_pay.'</span> </div>
<div class="_nuxt_grd_wd"> <span class="_nuxt_wd_title">Реквизиты:</span> <span class="_nuxt_wd_infos">'.$wallet_pay.'</span> </div>
<div class="_nuxt_grd_wd"> <span class="_nuxt_wd_title">Статус:</span> <span class="_nuxt_wd_infos" style="'.$withdraw_color.'">'.$withdraw_more_status.'</span> </div>
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
    
<script>
function showWithdraw(id){
var with_id = id;
var with_id2 = '#'+id;
$(with_id2).slideToggle(200);
}
function loadWithdraws(){
$("#withdraws-table").load("../profile/withdraws.php #withdraws-table");    
}
function removeWithdraw(id) {
    $.ajax({
        type: "POST",
        url: "../server.php",
        data: {
            type: "deletewithdraw",
            del: id
        },
        success: function(data) {
            var obj = jQuery.parseJSON(data);
            if (obj.success == "success") {
loadWithdraws();
$('#userBalance').text(obj.new_balance);
$('#userBalance').attr('myBalance', obj.new_balance);   
greenBalance();
toastr['success']("Выплата отменена","Успешно")
            }
            
            if (obj.success == "error") {
            toastr['error'](obj.error,"Ошибка")
            }
        },
    });
}         
</script>    
    
</body>
</html>    