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

<div class="_nuxt_combined_card mb25 gap20">
<div class="_nuxt_card gap15">
<div class="_nuxt_card_body">    
<span class="_nuxt_card_title mb10" style="font-size:22px;">Реферальная система</span>
<span class="_nuxt_main_info mb20">
В рамках такой программы партнеры получают комиссионные за каждого нового пользователя, которого они пригласили. Это может быть реализовано как процент от их депозитов или других действий на платформе. В вашем случае, программа предлагает <u><?=$get['ref_per']?>%</u> от депозитов, что означает, что за каждого нового клиента, пришедшего по реферальной ссылке, партнер будет получать пятую часть того, что этот клиент внес на свой счет. А так же <u><?=$refrandprize?> <?=$site_vault?></u> за каждого приглашенного реферала.
</span>
<span class="_nuxt_main_info mb20">
Партнерская программа является эффективным инструментом для увеличения аудитории и повышения дохода как для компании, так и для ее пользователей.    
</span>
<span class="_nuxt_card_title mb10" style="font-size:20px;">Ваша реферальная ссылка:</span>
<div style="width: 100%;display: flex;" class="gap15">
<input id="ref_url" class="_nuxt_input" value="<?=$linksite?>/?p=<?=$id?>" readonly="">
<button class="_nuxt_button" style="height: 39px;width: 250px;" onclick="copyRef();">Скопировать</button>
</div>
</div>
</div>

<div class="_nuxt_card gap15">

<div class="_nuxt_combined_card gap20">
<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;">   
 <span style="opacity: 0.5;font-size: 13px;">Приглашено:</span>
 <b style="font-size: 18px;"><?=round($get['refs'], 2);?> Шт</b> 
</div>
</div>

<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;">   
 <span style="opacity: 0.5;font-size: 13px;">Процент дохода:</span>
 <b style="font-size: 18px;"><u><?=$get['ref_per'];?>%</u></b> 
</div>
</div>
</div>

<div class="_nuxt_combined_card gap20">
<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;">   
 <span style="opacity: 0.5;font-size: 13px;">Заработано:</span>
 <b style="font-size: 18px;"><?=round($get['refearn'], 2);?> <?=$site_vault?></b> 
</div>
</div>

<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;">   
 <span style="opacity: 0.5;font-size: 13px;">Кол-во депозитов:</span>
 <b style="font-size: 18px;"><?=round($get['ref_deps'], 2);?> Шт</b> 
</div>
</div>
</div>

<div class="_nuxt_profile_bonus">
 <span class="_nuxt_profile_bonus_title">У Вас есть источник трафика?</span>   
 <span class="_nuxt_profile_bonus_desc">Для индивидуальных условий партнерской программы обратитесь в <a href="<?=$sitegroup?>">группу вк</a> с пометкой "Сотрудничество"</span>    
</div>

</div>
</div>





<?
require ("../include/footer.php");
?> 
  
</div> 
    
<script>
var ref_link_main = document.getElementById("ref_url");
var ref_link = $('#ref_url').val();
function copyRef() {
  ref_link_main.select();    
  document.execCommand("copy");
  toastr['success']("Скопировали значение: "+ref_link,"Успешно")
}      
</script>    
    
</body>
</html>    