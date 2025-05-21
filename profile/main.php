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

    $sql_select23 = "SELECT SUM(suma) FROM deposits WHERE user_id='$id'";
    $result23 = mysql_query($sql_select23);
    $row = mysql_fetch_array($result23);
    if ($row)
    {
        $sumdep = $row['SUM(suma)'];
    }

$total_deps_found = "SELECT SUM(suma) FROM deposits WHERE user_id = '$id' AND status = '1'";
$total_deps_found_query = mysql_query($total_deps_found);
$totalDepsRow = mysql_fetch_array($total_deps_found_query);
$allDepositsUser = $totalDepsRow['SUM(suma)'];
$allDepositsUser = number_format($allDepositsUser, 2, '.', ' ');

$total_games_found = mysql_query("SELECT COUNT(*) FROM dice WHERE user_id='$id'");
$total_deps_found_row = mysql_fetch_row($total_games_found);
$allGamesUser = $total_deps_found_row[0]; // всего записей
$allGamesUser = round($allGamesUser, 2);

$total_wins_found = "SELECT SUM(win) FROM dice WHERE user_id = '$id'";
$total_wins_found_query = mysql_query($total_wins_found);
$totalWinsRow = mysql_fetch_array($total_wins_found_query);
$allWinsUser = $totalWinsRow['SUM(win)'];
$allWinsUser = number_format($allWinsUser, 2, '.', ' ');

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
<span class="_nuxt_card_title mb10" style="font-size:22px;">Личный кабинет</span>
<span class="_nuxt_main_info mb20">Проведите настройку вашего аккаунта и следите за статистикой в личном кабинете.</span>

<span class="_nuxt_card_title mb10" style="font-size:16px;">Для моментального вывода и повышенного бонуса:</span>

<?if($sumdep < 2000){?>
<span class="_nuxt_main_info_d"><i style="font-size: 16px;color:#ed6b5e" class="fa-solid fa-xmark"></i> Сумарно пополнений на 2000 <?=$site_vault?></span>
<?}else{?>
<span class="_nuxt_main_info_d"><i style="font-size: 16px;color:var(--color)" class="fa fa-check"></i> Сумарно пополнений на 2000 <?=$site_vault?></span>
<?}?>
</div>
</div>

<div class="_nuxt_card gap15">

<div class="_nuxt_combined_card gap20">
<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;">   
 <span style="opacity: 0.5;font-size: 13px;">Вагер:</span>
 <b style="font-size: 18px;"><?=round($get['wager'], 2);?> <?=$site_vault?></b> 
</div>
</div>

<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;">   
 <span style="opacity: 0.5;font-size: 13px;">Проведено игр:</span>
 <b style="font-size: 18px;"><?=$allGamesUser?> Шт</b> 
</div>
</div>

<div class="_nuxt_card gap15">
<div class="_nuxt_card_body" style="padding: 25px;gap: 10px;">   
 <span style="opacity: 0.5;font-size: 13px;">Пополнено:</span>
 <b style="font-size: 18px;"><?=$allDepositsUser?> <?=$site_vault?></b> 
</div>
</div>
</div>

<div class="_nuxt_profile_bonus">
 <span class="_nuxt_profile_bonus_title">Получай много - Делай мало</span>   
 <span class="_nuxt_profile_bonus_desc">Каждый день мы публикуем промокоды в нашем телеграм канале. Не пропускай обновления!</span>    
</div>

</div>
</div>



<?
require ("../include/footer.php");
?> 
  
</div> 
    
    
    
</body>
</html>    