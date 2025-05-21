<?
if ($get['ban'] == 1) {
        echo '<script type="text/javascript">';
        echo 'window.location.href="/ban";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=/ban" />';
        echo '</noscript>'; exit;
}
if ($is_teh == 1) {
        echo '<script type="text/javascript">';
        echo 'window.location.href="/teh";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=/teh" />';
        echo '</noscript>'; exit;
}
?>

<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="author" content="<?=$sitename?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../media/logo.png" type="image/png">
  <meta name="description" content="<?=$sitename?> - Онлайн игры с выводом денег">

  <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@800&family=Rubik&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="/dist/css/toastr.css"rel="stylesheet">
  <link href="/dist/css/all.css"rel="stylesheet">
  <link href="/dist/css/mines.css"rel="stylesheet">

  <script src="/dist/js/_nuxt.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" crossorigin="anonymous"></script>
  <script src="/dist/js/toastr.min.js" crossorigin="anonymous"></script>

<title><?=strtoupper($sitename);?> - Онлайн игры с выводом денег</title>
</head>

<div class="_nuxt_mobile_menu">
 <a href="/">Главная</a>
 <a href="/faq">Ответы на вопросы</a>
 <a href="/fairness">Проверка игры</a>
 <a href="/withdraws">Выплаты</a> 
 <a href="/bonus">Бонус</a>  
</div>

<header class="_nuxt_header">
 <div class="_nuxt_header_content">

<div class="_nuxt_header_compilation"> 

<i class="fa fa-bars" id="menumobile" style="display:none;font-size: 24px;margin-left: 10px;"></i>

<a href="/" class="_nuxt_header_logo">
 <span class="_nuxt_header_logo_title"><?=$sitename?></span>
 <span class="_nuxt_header_logo_description">Онлайн игры</span>
</a>

<div class="_nuxt_header_nav _nuxt_hide">
  <a href="/faq" class="_nuxt_header_navigator">Ответы на вопросы</a>  
  <a href="/fairness" class="_nuxt_header_navigator">Проверка игры</a>  
  <a href="/withdraws" class="_nuxt_header_navigator">Выплаты</a>  
<?if($sid){?>  
  <a href="/bonus" class="_nuxt_header_navigator">Бонус</a>  
  
  <?if($get['admin'] == 1){?>
  <a href="/admin" class="_nuxt_header_navigator">Админ панель</a>  
  <?}?>  
<?}?>  
</div>
</div>

<?if(!$sid){?>
<div class="_nuxt_selectgame auth" data-toggle="modal" data-target="#login" style="width: 150px;">Войти</div>
<?}else{?>
<div class="_nuxt_header_user">
 <div class="_nuxt_header_user_balance">
  <span class="_nuxt_header_user_balance_real" style="position: static;" id="userBalance" myBalance="<?=$balance?>"> <?=$balance?></span>
  <span><?=$site_vault?></span>
 </div>

<button data-toggle="modal" data-target="#deposit" class="_nuxt_header_user_payin"><i class="fa fa-plus"></i></button> 
<span class="_nuxt_header_user_login _nuxt_hide pmen"><?=strtok($login,' ');?></span>
<img class="_nuxt_header_user_photo pmen" src="<?=$img?>">
 
</div>
<?}?>

 <div class="_nuxt_header_profile_menu">
  <a href="/profile/main">Профиль</a>
  <a data-toggle="modal" data-target="#withdraw">Вывести</a>
  <a data-toggle="modal" data-target="#logout">Выйти</a>  
 </div>
<div class="_nuxt_header_profile_menu_bg"></div>


 </div>    
</header>


<script>
$(document).ready(function(){
	$('.pmen').click(function(){
		$('._nuxt_header_profile_menu').toggleClass('active');
		$('._nuxt_header_profile_menu_bg').toggleClass('active');
		return false;
	});
	$('._nuxt_header_profile_menu_bg').click(function(){
		$('._nuxt_header_profile_menu').toggleClass('active');
		$('._nuxt_header_profile_menu_bg').toggleClass('active');
		return false;
	});	

	$('#menumobile').click(function(){
		$('._nuxt_mobile_menu').toggleClass('active');
		return false;
	});	
	
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-default.min.css" integrity="sha512-jHurNV8IL4Q4DRHzlRaIboSWZqnA3KU6KTiRQrtU+jxE1MHxdiveHrztuHhyna6PWTE427SxNDDUqjaruirB2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js" integrity="sha512-51WDTV7haD9BBDc8RWH2r5TnuSiRyAqEnbGyuKHYn+qpYCrCckxFeqlr1I5UoOULijyLV2vnHO9LS4MrAzHxwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?
require('modals.php');
?>