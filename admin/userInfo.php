<?
require ("../system/config.php");
session_start();
$sid = $_SESSION['hash'];
$userInf = $_GET['id'];

$select_current = "SELECT * FROM users WHERE hash = '$sid'";
$result_current = mysql_query($select_current);
$get = mysql_fetch_array($result_current);

   // получаем данные пользователя
   $getInfouser = "SELECT * FROM users WHERE id = '$userInf'";
   $getInfouser222 = mysql_query($getInfouser);
   $row = mysql_fetch_array($getInfouser222);
   if($row)
   {
   $imgUser = $row['img'];
   $loginUser = $row['login'];  
   $regUser = $row['data_reg'];   
   $balanceUser = $row['balance'];
   $datareg_User = $row['data_reg'];
   $ref_idUser = $row['ref_id'];    
   $vkUser = $row['social'];   
   $vkUserURL = $row['social'];   
   $refsUser = $row['refs'];   
   $refearnUser = $row['refearn'];  
   $refdeps_User = $row['ref_deps']; 
   $ref_deps_sum_User = $row['ref_deps_sum']; 
   $banUser = $row['ban'];  
   $admUser = $row['admin'];     
   $chat_banUser = $row['chat_ban'];
   $podkrutUser = $row['podkrut'];
   $podkrutUser2 = $row['podkrut'];
   $wagerUser = $row['wager'];  
   $ipUser = $row['ip'];    
   $refper_User = $row['ref_per'];       
   $TGUserURL = $row['tg_id'];
   $vkUser = substr($vkUser, -9);   
   $tg_bonus = $row['tg'];
   $vk_sub_bonus = $row['vkb'];
   $vk_rep_bonus = $row['vkrep'];
   } 



if($tg_bonus == 0){
$tg_bonus = 'Не получен';
}else{
$tg_bonus = 'Получен';    
}
if($vk_sub_bonus == 0){
$vk_sub_bonus = 'Не получен';
}else{
$vk_sub_bonus = 'Получен';    
}
if($vk_rep_bonus == 0){
$vk_rep_bonus = 'Не получен';
}else{
$vk_rep_bonus = 'Получен';    
}

if($TGUserURL == 0){
$TGUserURL = 'Не привязан';    
}else{
$TGUserURL = $TGUserURL;    
}

if($admUser == 1){
$admUser = 'Администратор';    
}else{
$admUser = 'Пользователь';    
}

if($podkrutUser2 == 0){
$getPodSec = '';
}else{
$getPodSec = 'selected';    
}

if($banUser == 0){
$getUserBan = '';
}else{
$getUserBan = 'selected';    
} 

if($admUser == 'Пользователь'){
$admUserSelect = '';
}else{
$admUserSelect = 'selected';    
} 

if($ref_idUser == NULL || $ref_idUser == 0){
$ref_idUser = 'Нет';    
}
if($banUser == NULL || $banUser == 0){
$banUser = 'Нет';    
}else{
$banUser = 'Да';      
}

$sql_select_sum_withs = "SELECT SUM(sum) FROM withdraws WHERE user_id='$userInf' AND status = 1";
$sql_res_sum_withs = mysql_query($sql_select_sum_withs);
$row = mysql_fetch_array($sql_res_sum_withs);
if($row)
{	
$withs_current_sum = $row['SUM(sum)'];
}

$sql_select_sum_deps = "SELECT SUM(suma) FROM deposits WHERE user_id='$userInf'";
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
<span class="admin_info_navigator">Dashboard <span class="admin_info_navigator2">/ Edit user</span></span>
</div>
<!-- content -->

<div class="admin_userinfo_block">
<span id="userid" class="d-none"><?=$userInf?></span>  
<div class="card" id="main_info_card" style="width:50%">
  <div class="card-header">
     Профиль №<?=$userInf?> 
  </div>
  <div class="card-body">
    
    <div class="admin_userinfo_login">
      <img src="<?=$imgUser?>">
      <div class="admin_userinfo_login_group">
        <span class="admin_userinfo_login_group_name"><?=$loginUser?></span>  
        <span class="admin_userinfo_login_group_status"><?=$admUser?></span>  
      </div>
    </div>

<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Баланс</label>
  <input class="form-control" id="ball" value="<?=round($balanceUser, 2)?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Вагер</label>
  <input class="form-control" id="wager_stat" value="<?=round($wagerUser, 2)?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Дата регистрации</label>
  <input class="form-control" value="<?=$datareg_User?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Бан</label>
  <input class="form-control" value="<?=$banUser?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">IP</label>
  <input class="form-control" id="ipm" value="<?=$ipUser?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">VK</label>
  <input class="form-control" value="<?=$vkUserURL?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">TG</label>
  <input class="form-control" value="<?=$TGUserURL?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Статус</label>
  <input class="form-control" value="<?=$admUser?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Рефералов</label>
  <input class="form-control" value="<?=round($refsUser, 2);?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Процент рефки</label>
  <input class="form-control" value="<?=round($refper_User, 2);?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Заработано с рефки</label>
  <input class="form-control" value="<?=round($refearnUser, 2);?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Депозитов по рефке</label>
  <input class="form-control" value="<?=round($refdeps_User, 2);?> Шт" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Сумма депов по рефке</label>
  <input class="form-control" value="<?=round($ref_deps_sum_User, 2);?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Пополнений</label>
  <input class="form-control" value="<?=round($deps_current_sum, 2);?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Выводов</label>
  <input class="form-control" value="<?=round($withs_current_sum, 2);?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Бонус за репост</label>
  <input class="form-control" value="<?=$vk_rep_bonus?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Бонус за подписку</label>
  <input class="form-control" value="<?=$vk_sub_bonus?>" disabled="">
</div>
<div class="mb-3">
  <label class="form-label" style="font-size: 14px;margin-bottom: 6px;">Бонус за тг</label>
  <input class="form-control" value="<?=$tg_bonus?>" disabled="">
</div>


    
  </div>
 </div>  

<div class="admin_userinfo_block2">
    
 <div class="card">
  <div class="card-header">
     Редактирование профиля
  </div>
  <div class="card-body">
   <div class="grid_template2">
     <div class="mb-3">
      <label class="form-label">Баланс</label>
      <input type="number" class="form-control" id="userbal" value="<?=round($balanceUser, 2)?>">
     </div>
     <div class="mb-3">
      <label class="form-label">Бан</label>
           <select type="text" class="form-control" id="ban_user">
           <option value="0" <?=$getUserBan?>>Нет</option>
           <option value="1" <?=$getUserBan?>>Да</option>  
           </select>   
     </div> 
     <div class="mb-3">
      <label class="form-label">Роль</label>
           <select type="text" class="form-control" id="role_user">
           <option value="0" <?=$admUserSelect?>>Пользователь</option>
           <option value="1" <?=$admUserSelect?>>Администратор</option>  
           </select>   
     </div>      
   </div>
  </div> 
  <div class="card-footer">
   <button class="btn btn-primary" style="float: right;margin-left:10px;" onClick="save_user_edit();">Сохранить</button>    
   <button class="btn btn-warning" style="float: right;" onClick="resetWager();">Обнулить вагер</button>      
  </div>
 </div> 
 
 
 <div class="card">
  <div class="card-header">
     Мульти-акк чекер
  </div>
  <div class="card-body">
      
<div class="table-responsive">
<table class="table table-light table-striped table-hover">
<thead>
<tr>
<th scope="col">ID</th>
<th scope="col">Логин</th>
<th scope="col">Баланс</th>
<th scope="col">IP</th>
<th scope="col">Действие</th>
</tr>
</thead>
<tbody>
<?php 


$sql_select5 = "SELECT * FROM users WHERE ip = '$ipUser' AND id != $userInf ORDER by id DESC";
$result5 = mysql_query($sql_select5);                                                                       
while($row = mysql_fetch_array($result5)) {
$multi_id = $row['id'];
$multi_login = $row['login'];
$multi_balance = round($row['balance'], 2);
$multi_ip = $row['ip'];
$multi_ban_status = $row['ban'];

if($multi_ban_status == 0){
$ban_btn_m = "<button class='btn btn-danger' onClick='ban_adm($multi_id);'>Заблокировать</button>";    
}else{
$ban_btn_m = "<button class='btn btn-warning' onClick='unban_adm($multi_id);'>Разблокировать</button>";        
}

echo "
<tr>
<td>$multi_id</td>
<td>$multi_login</td>
<td>$multi_balance</td>
<td>$multi_ip</td>
<td>$ban_btn_m</td>
</tr>";
}
?>
</tbody>
</table>
</div>

  </div>      
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