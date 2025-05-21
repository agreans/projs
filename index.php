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

$sql_select_count_users = "SELECT COUNT(*) FROM users";
$sql_res_count_users = mysql_query($sql_select_count_users);
$row = mysql_fetch_array($sql_res_count_users);
if($row)
{	
$users_current = $row['COUNT(*)'];
}

$sql_select_sum_withs = "SELECT SUM(sum) FROM withdraws";
$sql_res_sum_withs = mysql_query($sql_select_sum_withs);
$row = mysql_fetch_array($sql_res_sum_withs);
if($row)
{	
$withs_current_sum = $row['SUM(sum)'];
}

$online_rand = rand(340,370);
$online_rand = number_format($online_rand, 0, '.', ' ');

$users_rand = 122876 + $users_current;
$users_rand = number_format($users_rand, 0, '.', ' ');

$withdraws_rand = 239776 + $withs_current_sum;
$withdraws_rand = number_format($withdraws_rand, 0, '.', ' ');

require ("include/header.php");
?>

<body>
<script>
function _nuxt_game_history() {
if(navigator.onLine == true) {
$("._nuxt_games_history_list").load("index.php ._nuxt_games_history_list");
 } 
}
setInterval('_nuxt_game_history()',1000);
</script> 

<div class="_nuxt_container">

<div class="_nuxt_combined_card">
<div class="_nuxt_card gap15">
<span class="_nuxt_card_title">Играть</span>
<div class="_nuxt_card_body gap20">

<span>Выберите режим игры:</span>
<div class="_nuxt_selectgame mb10" data-toggle="modal" data-target="#selectGame">Нажмите сюда для выбора игры</div>

<span>Введите ставку:</span>
<div class="_nuxt_controls">
 <input type="number" class="_nuxt_input" id="mainInput" value="1" placeholder="Введите ставку">
 <button class="_nuxt_control_btn" onclick="$('#mainInput').val(Math.max(($('#mainInput').val()/2).toFixed(2), 1));">/2</button>
 <button class="_nuxt_control_btn" onclick="var x = ($('#mainInput').val()*2);$('#mainInput').val(parseFloat(x.toFixed(2)));">x2</button> 
 <button class="_nuxt_control_btn" onclick="var max = $('#userBalance').attr('myBalance');$('#mainInput').val(Math.max(max,1));">max</button>  
</div>

<button class="_nuxt_button" data-toggle="modal" data-target="#selectGame">Начать игру</button>


</div>
</div>




<div class="_nuxt_card gap15">
<span class="_nuxt_card_title">Информация</span>
<div class="_nuxt_card_body">

<span class="mb10"><?=$sitename?> - Сервис быстрых игр</span>
<span class="_nuxt_main_info mb20">Алгоритмы игр основаны на SHA-256 | ClientSeed, ServerSeed, Nonce | Никаким образом невозможно подделать результаты и повлиять на исход игры.</span>

<div class="_nuxt_main_info_prop mb25">
 <div class="_nuxt_main_info_more">
  <span class="_nuxt_main_counter"><?=$online_rand?></span>
  <span class="_nuxt_main_description">онлайн</span>
 </div>  
 <div class="_nuxt_main_info_more">
  <span class="_nuxt_main_counter"><?=$users_rand?></span>
  <span class="_nuxt_main_description">всего игроков</span>
 </div>  
 <div class="_nuxt_main_info_more">
  <span class="_nuxt_main_counter"><?=$withdraws_rand?> L</span>
  <span class="_nuxt_main_description">выведено</span>
 </div>   
</div>

<div class="_nuxt_main_shield"> <i class="fa-solid fa-shield-halved"></i> <span>Каждая игра имеет свой hash</span> </div>

</div>
</div>
</div>

<?
require ("include/gamehistory.php");
?>

<?
require ("include/footer.php");
?>  
  
  
    
</body>
</html>    