<?

require ("system/config.php");
session_start();
$sid = $_SESSION['hash'];

$refer = $_GET['p'];
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

require ("include/header.php");
?>



<body>
 

<div class="_nuxt_container">

<div class="_nuxt_card">
<span class="_nuxt_card_title">Выплаты</span>
<div class="_nuxt_games_history">
<header class="_nuxt_games_history_header"><span>#</span><span>Сумма</span><span>Реквизиты</span><span>ПС</span></header>
<div class="_nuxt_games_history_list">

<?
//1 panel
$id_withdrawal1 = rand(1100000,1200000);
$sum_withdrawal1 = number_format(rand(300,1500), 2, '.', ' ');
$generateps1 = rand(1,2);
if($generateps1 == 1){
$randfk1 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal1 = "F$randfk1";
$ps_withdrawal1 = 'fkwallet';
}
if($generateps1 == 2){
$randsbp1 = rand(011111111,911111111);
$wallet_withdrawal1 = "+79$randsbp1";
$ps_withdrawal1 = 'sbp';
}

//2 panel
$id_withdrawal2 = rand(1000000,1005000);
$sum_withdrawal2 = number_format(rand(300,1500), 2, '.', ' ');
$generateps2 = rand(1,2);
if($generateps2 == 1){
$randfk2 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal2 = "F$randfk2";
$ps_withdrawal2 = 'fkwallet';
}
if($generateps2 == 2){
$randsbp2 = rand(011111111,911111111);
$wallet_withdrawal2 = "+79$randsbp2";
$ps_withdrawal2 = 'sbp';
}

//3 panel
$id_withdrawal3 = rand(1005000,1000000);
$sum_withdrawal3 = number_format(rand(300,1500), 2, '.', ' ');
$generateps3 = rand(1,2);
if($generateps3 == 1){
$randfk3 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal3 = "F$randfk3";
$ps_withdrawal3 = 'fkwallet';
}
if($generateps3 == 2){
$randsbp3 = rand(011111111,911111111);
$wallet_withdrawal3 = "+79$randsbp3";
$ps_withdrawal3 = 'sbp';
}

//4 panel
$id_withdrawal4 = rand(950000,1000000);
$sum_withdrawal4 = number_format(rand(300,1500), 2, '.', ' ');
$generateps4 = rand(1,2);
if($generateps4 == 1){
$randfk4 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal4 = "F$randfk4";
$ps_withdrawal4 = 'fkwallet';
}
if($generateps4 == 2){
$randsbp4 = rand(011111111,911111111);
$wallet_withdrawal4 = "+79$randsbp4";
$ps_withdrawal4 = 'sbp';
}

//5 panel
$id_withdrawal5 = rand(900000,950000);
$sum_withdrawal5 = number_format(rand(300,1500), 2, '.', ' ');
$generateps5 = rand(1,2);
if($generateps5 == 1){
$randfk5 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal5 = "F$randfk5";
$ps_withdrawal5 = 'fkwallet';
}
if($generateps5 == 2){
$randsbp5 = rand(011111111,911111111);
$wallet_withdrawal5 = "+79$randsbp5";
$ps_withdrawal5 = 'sbp';
}

//6 panel
$id_withdrawal6 = rand(850000,900000);
$sum_withdrawal6 = number_format(rand(300,1500), 2, '.', ' ');
$generateps6 = rand(1,2);
if($generateps6 == 1){
$randfk6 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal6 = "F$randfk6";
$ps_withdrawal6 = 'fkwallet';
}
if($generateps6 == 2){
$randsbp6 = rand(011111111,911111111);
$wallet_withdrawal6 = "+79$randsbp6";
$ps_withdrawal6 = 'sbp';
}

//7 panel
$id_withdrawal7 = rand(800000,850000);
$sum_withdrawal7 = number_format(rand(300,1500), 2, '.', ' ');
$generateps7 = rand(1,2);
if($generateps7 == 1){
$randfk7 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal7 = "F$randfk7";
$ps_withdrawal7 = 'fkwallet';
}
if($generateps7 == 2){
$randsbp7 = rand(011111111,911111111);
$wallet_withdrawal7 = "+79$randsbp7";
$ps_withdrawal7 = 'sbp';
}

//8 panel
$id_withdrawal8 = rand(750000,800000);
$sum_withdrawal8 = number_format(rand(300,1500), 2, '.', ' ');
$generateps8 = rand(1,2);
if($generateps8 == 1){
$randfk8 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal8 = "F$randfk8";
$ps_withdrawal8 = 'fkwallet';
}
if($generateps8 == 2){
$randsbp8 = rand(011111111,911111111);
$wallet_withdrawal8 = "+79$randsbp8";
$ps_withdrawal8 = 'sbp';
}

//9 panel
$id_withdrawal9 = rand(700000,750000);
$sum_withdrawal9 = number_format(rand(300,1500), 2, '.', ' ');
$generateps9 = rand(1,2);
if($generateps9 == 1){
$randfk9 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal9 = "F$randfk9";
$ps_withdrawal9 = 'fkwallet';
}
if($generateps9 == 2){
$randsbp9 = rand(011111111,911111111);
$wallet_withdrawal9 = "+79$randsbp9";
$ps_withdrawal9 = 'sbp';
}

//10 panel
$id_withdrawal10 = rand(650000,700000);
$sum_withdrawal10 = number_format(rand(300,1500), 2, '.', ' ');
$generateps10 = rand(1,2);
if($generateps10 == 1){
$randfk10 = rand(7202440385554950,7902440385554950);
$wallet_withdrawal10 = "F$randfk10";
$ps_withdrawal10 = 'fkwallet';
}
if($generateps10 == 2){
$randsbp10 = rand(011111111,911111111);
$wallet_withdrawal10 = "+79$randsbp10";
$ps_withdrawal10 = 'sbp';
}


?>


<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal1?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal1?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal1?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal1?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal2?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal2?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal2?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal2?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal3?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal3?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal3?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal3?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal4?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal4?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal4?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal4?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal5?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal5?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal5?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal5?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal6?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal6?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal6?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal6?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal7?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal7?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal7?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal7?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal8?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal8?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal8?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal8?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal9?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal9?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal9?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal9?>.png"></div>  
</div>
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert"><?=$id_withdrawal10?></div>  
<div class="_nuxt_games_history_insert"><?=$sum_withdrawal10?> L</div>  
<div class="_nuxt_games_history_insert"><?=$wallet_withdrawal10?></div>  
<div class="_nuxt_games_history_insert"> <img style="width: 24px;height: 24px;" src="/media/payments/<?=$ps_withdrawal10?>.png"></div>  
</div>







</div>
</div>
</div>

<?
require ("include/footer.php");
?> 
  
</div> 
    
    
    
</body>
</html>    