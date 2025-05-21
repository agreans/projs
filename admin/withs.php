<?
require ("../system/config.php");
session_start();
$sid = $_SESSION['hash'];

$select_current = "SELECT * FROM users WHERE hash = '$sid'";
$result_current = mysql_query($select_current);
$get = mysql_fetch_array($result_current);

if($get['admin'] == 1){
require("admin_materials/header.php");
?>

<!-- container start -->
<div class="admin_container">
<!-- info nav -->    
<div class="admin_info_nav mb20">
<span class="admin_info_title">DASHBOARD</span>
<span class="admin_info_navigator">Dashboard <span class="admin_info_navigator2">/ Withdraws</span></span>
</div>
<!-- content -->


                           <div class="table-responsive" id="withdraws-tbl">
<table class="table table-light table-striped table-hover">
                                 <thead>
                                    <tr>
                                       <th scope="col">ID</th>
                                       <th scope="col">Дата</th>
                                       <th scope="col">ID игрока</th>
                                       <th scope="col">Кошелек</th>
                                       <th scope="col">ПС</th>
                                       <th scope="col">Сумма</th>
                                       <th scope="col">БАНК</th>
                                       <th scope="col">Статус</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                        <?php
                                       $sql_select5 = "SELECT * FROM withdraws ORDER BY id + 0 DESC";
                                        $result5 = mysql_query($sql_select5);    
                                       while($row = mysql_fetch_array($result5)) {
                                       $id = $row['id'];
                                       $user_id = $row['user_id'];
                                       $sum = $row['sum'];
                                       $wallet = $row['wallet'];
                                       $status = $row['status'];
                                       $ps = $row['ps'];
                                       $fake = $row['fake'];
                                       $date = $row['date'];
                                       $sbpnking = $row['banksbp'];
                                       
                                       $sum = round($sum, 2);
$checkico = "<i style='color:#4ba136;font-size: 14px;margin-right:5px;' class='fa fa-check' aria-hidden='true'></i>";
$waitico = "<i style='color:#bd8c18;font-size: 14px;margin-right:5px;' class='fa fa-clock' aria-hidden='true'></i>";
$errorico = "<i style='color:#b13333;font-size: 14px;margin-right:5px;transform: rotate(45deg);' class='fa fa-plus' aria-hidden='true'></i>";
$procesico = "<i style='color:#000;font-size: 14px;margin-right:5px;' class='fa fa-bolt' aria-hidden='true'></i>";
                                       if($fake == 0) {
                                       $is_fake = "Нет";
                                       $sql_select2 = "SELECT * FROM users WHERE id='$user_id'";
                                       $result2 = mysql_query($sql_select2);
                                       $row = mysql_fetch_array($result2);
                                       if($row)
                                       {
                                       $login = $row['login'];
                                       }
                                       }
                                       if($fake == 1) {
                                         $user_id = "Нет";
                                         $is_fake = "Да";
                                         $login = $row['login_fake'];
                                       }
                                       if($status == 0) {
                                         $stat = "<td class='sorting_1' tabindex='0' onclick="."$('#editidw').html('$id');$('#useridw').html('$user_id');$('#usersumw').html('$sum');"." data-toggle='modal' data-target='#editstatus' style='cursor:pointer;'><span style='color:#bd8c18;font-weight:bold;'>$waitico Изменить</span></td>";
                                       }     
                                       
                                       
                                       
                                       if($status == 1) {
                                         $stat = "<td class='sorting_1' tabindex='0' onclick="."$('#editidw').html('$id');$('#useridw').html('$user_id');$('#usersumw').html('$sum');"." data-toggle='modal' data-target='#editstatus' style='cursor:pointer;'><span style='color:#bd8c18;font-weight:bold;'><span style='color:#4ba136;'>$checkico Выплачено</span></td>";
                                       }
                                       if($status == 2) {
                                         $stat = "<td class='sorting_1' tabindex='0' onclick="."$('#editidw').html('$id');$('#useridw').html('$user_id');$('#usersumw').html('$sum');"." data-toggle='modal' data-target='#editstatus' style='cursor:pointer;'><span style='color:#bd8c18;font-weight:bold;'><span style='color:#b13333;'>$errorico Ошибка</span></td>";
                                       }
                                       if($status == 3) {
                                         $stat = "<td class='sorting_1' tabindex='0' onclick="."$('#editidw').html('$id');$('#useridw').html('$user_id');$('#usersumw').html('$sum');"." data-toggle='modal' data-target='#editstatus' style='cursor:pointer;'><span style='color:#000;font-weight:bold;'><span style='color:#000;'>$procesico Агрегатор</span></td>";
                                       }                                       
                                       if($sbpnking == 0){
                                           $sbpnking = '-';
                                       }
                                       if($sbpnking == 1){
                                           $sbpnking = 'Сбербанк';
                                       } 
                                       if($sbpnking == 2){
                                           $sbpnking = 'Тинькофф';
                                       } 
                                       if($sbpnking == 3){
                                           $sbpnking = 'Райффайзен';
                                       } 
                                       if($sbpnking == 4){
                                           $sbpnking = 'Альфа-банк';
                                       } 
                                       if($sbpnking == 5){
                                           $sbpnking = 'ВТБ';
                                       }                                        
                                       if($sbpnking == 6){
                                           $sbpnking = 'OZON';
                                       }                                        
                                      if($sbpnking == 7){
                                           $sbpnking = 'МТС';
                                       }  
                                      if($sbpnking == 8){
                                           $sbpnking = 'Уралсиб';
                                       }   
                                      if($sbpnking == 9){
                                           $sbpnking = 'Ренессанс';
                                       }                                          
                                       echo "
                                                                         <tr>
                                                                           <td>$id</td>
                                                                           <td>$date</td>
                                                                           <td>$user_id</td>
                                                                           <td>$wallet</td>
                                                                           <td> <img style='width:20px' src='../media/payments/$ps.png'></td>
                                                                           <td>$sum</td>
                                                                           <td>$sbpnking</td>
                                       								 $stat
                                       								  </tr>
                                       ";
                                       }
                                         ?>
                                 </tbody>
                              </table>
                           </div>



<? require("admin_materials/footer.php"); ?>
</div>
<!-- container end -->


<div class="modal fade" id="editstatus" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit withdraw <b>#<span id="editidw"></span><span id="useridw" class="d-none"></span><span id="usersumw" class="d-none"> </span></b></h5>
<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body" style="display: flex;gap: 5px;flex-direction: column;">
<button class="btn btn-success" style="width:140px; display:inline-block;margin:0 auto;" onclick="withdraw_adm('succes')">Выполнить</button>  
<button class="btn btn-danger" style="width:140px; display:inline-block;margin:0 auto;" onclick="withdraw_adm('error')">Отменить</button>
<button class="btn btn-info" style="width:140px; display:inline-block;margin:0 auto;" onclick="withdraw_adm('procces')">Агрегатор</button>
</div>
</div>
</div>
</div>




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