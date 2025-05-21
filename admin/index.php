<?
require ("../system/config.php");
session_start();
$sid = $_SESSION['hash'];

$select_current = "SELECT * FROM users WHERE hash = '$sid'";
$result_current = mysql_query($select_current);
$get = mysql_fetch_array($result_current);

$sql_select_count_users = "SELECT COUNT(*) FROM users";
$sql_res_count_users = mysql_query($sql_select_count_users);
$row = mysql_fetch_array($sql_res_count_users);
if($row)
{	
$users_current = $row['COUNT(*)'];
}

$sql_select_count_games = "SELECT COUNT(*) FROM dice";
$sql_res_count_games = mysql_query($sql_select_count_games);
$row = mysql_fetch_array($sql_res_count_games);
if($row)
{	
$games_current = $row['COUNT(*)'];
}

$sql_select_count_promo = "SELECT COUNT(*) FROM promo";
$sql_res_count_promo = mysql_query($sql_select_count_promo);
$row = mysql_fetch_array($sql_res_count_promo);
if($row)
{	
$promo_current = $row['COUNT(*)'];
}

$sql_select_sum_withs = "SELECT SUM(sum) FROM withdraws WHERE status = 1";
$sql_res_sum_withs = mysql_query($sql_select_sum_withs);
$row = mysql_fetch_array($sql_res_sum_withs);
if($row)
{	
$withs_current_sum = $row['SUM(sum)'];
}

$sql_select_sum_deps = "SELECT SUM(suma) FROM deposits";
$sql_res_sum_deps = mysql_query($sql_select_sum_deps);
$row = mysql_fetch_array($sql_res_sum_deps);
if($row)
{	
$deps_current_sum = $row['SUM(suma)'];
}

if($get['admin'] == 1){
require("admin_materials/header.php");
?>


<!-- container start -->
<div class="admin_container">
<!-- info nav -->    
<div class="admin_info_nav mb20">
<span class="admin_info_title">DASHBOARD</span>
<span class="admin_info_navigator">Dashboard <span class="admin_info_navigator2">/ Main</span></span>
</div>
<!-- content -->

<div class="grid_template3 mb20">
   
 <div class="card">
  <div class="card-body">
    <span>Пополнений:</span>
    <h3><?=round($deps_current_sum, 2);?> ₽</h3>
    <i class="fa fa-plus adm_info bg-primary"></i>
  </div>
 </div>  
 
 <div class="card">
  <div class="card-body">
    <span>Выводов:</span>
    <h3><?=round($withs_current_sum, 2);?> ₽</h3>
    <i class="fa fa-minus adm_info bg-primary"></i>    
  </div>  
 </div>  
 
 <div class="card">
  <div class="card-body">
    <span>Доход:</span>
    <h3><?=round($deps_current_sum - $withs_current_sum, 2);?> ₽</h3>
    <i class="fa-solid fa-money-bills adm_info bg-primary"></i>    
  </div>  
 </div>   
   
    
</div>
<div class="grid_template3">
   
 <div class="card">
  <div class="card-body">
    <span>Всего игроков:</span>
    <h3><?=round($users_current, 2);?> Шт</h3>
    <i class="fa fa-users adm_info bg-primary"></i>
  </div>
 </div>  
 
 <div class="card">
  <div class="card-body">
    <span>Всего игр:</span>
    <h3><?=round($games_current, 2);?> Шт</h3>
    <i class="fa fa-gamepad adm_info bg-primary"></i>    
  </div>  
 </div>  
 
 <div class="card">
  <div class="card-body">
    <span>Всего промокодов:</span>
    <h3><?=round($promo_current, 2);?> Шт</h3>
    <i class="fa fa-gift adm_info bg-primary"></i>    
  </div>  
 </div>   
   
    
</div>

<? require("admin_materials/footer.php"); ?>
</div>
<!-- container end -->




</body>
</html>    

<?}else{
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$linksite.'/404";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$linksite.'/404" />';
        echo '</noscript>'; exit;
}?>