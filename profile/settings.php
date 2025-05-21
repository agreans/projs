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
<span class="_nuxt_card_title mb10" style="font-size:22px;">Настройки</span>
<span class="_nuxt_main_info mb20">
Настройки профиля – это раздел в различных онлайн-сервисах и приложениях, который позволяет пользователям персонализировать и настраивать свой аккаунт в соответствии с личными предпочтениями и потребностями.
</span>
</div>
</div>

<div class="_nuxt_card gap15">

<div class="_nuxt_combined_card gap20">
<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;background: linear-gradient(75deg, #2375dd, #4b8cdf);">   
 <span style="opacity: 0.5;font-size: 13px;">Аккаунт ВКонтакте:</span>
 <?if($get['social'] == NULL){?>
 <b style="font-size: 18px;">Не привязан</b>  
 <?}else{?>
 <b style="font-size: 18px;"><?$social_vk = $get['social']; $social_vk = substr($social_vk, -9); echo "vk.com/$social_vk";?></b>  
  <?}?>
</div>
</div>

<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;background: linear-gradient(75deg, #23a1dd, #4bb6df);">   
 <span style="opacity: 0.5;font-size: 13px;">Аккаунт Telegram:</span>
 <?if($get['tg_id'] == 0){?>
 <b style="font-size: 18px;">Не привязан</b>  
 <?}else{?>
 <b style="font-size: 18px;"><?$social_tg = $get['tg_id']; echo "t.me/$social_tg";?></b> 
 <?}?>
</div>
</div>
</div>


</div>
</div>





<?
require ("../include/footer.php");
?> 
  
</div> 
    
    
</body>
</html>    