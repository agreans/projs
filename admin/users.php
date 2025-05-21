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
<span class="admin_info_navigator">Dashboard <span class="admin_info_navigator2">/ Users</span></span>
</div>
<!-- content -->


                           <div class="table-responsive" id="users-block">
                              <table class="table table-light table-striped table-hover" id="us-table">
                                 <thead>
                                    <tr>
                                <th class="tbl-name">ID</th>
                                       <th class="tbl-name ">Логин</th>
                                       <th class="tbl-name ">WAGER</th>
                                       <th class="tbl-name">Баланс</th>
                                       <th class="tbl-name">VK</th>
                                       <th class="tbl-name">TG</th>
                                       <th class="tbl-name">Статус</th>
                                       <th class="tbl-name text-center">Действия</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                   $sql_select5 = "SELECT * FROM users ORDER by id DESC";
                                     $result5 = mysql_query($sql_select5);    
                                       while($row = mysql_fetch_array($result5)) {
                                           $id = $row['id'];
                                       $userwager = $row['wager'];
                                       $img = $row['img'];
                                       $login = $row['login'];
                                       $names = $row['login'];
                                       
                                       $social = $row['social'];
                                       $balance = $row['balance'];
                                       $ban = $row['ban'];
                                       $admin = $row['admin'];
                                       $imgs = $row['img'];
                                       $ip = $row['ip'];
                                       $tg = $row['tg'];
                                       
                                       if($tg == 0){
                                           $tg = 'Нет';
                                       }
                                       if($tg == 1){
                                           $tg = 'Да';
                                       }                                       
                                       $balance = round($balance, 2);
                                       
                                       if($admin == 1) {
                                        $prava = "Админ";
                                       }
                                       if($admin == 0) {
                                        $prava = "Игрок"; 
                                       }
                                       if($login != '') {
                                         $name = $login; 
                                       }
                                       if($social == '') {
                                         $stat_social = '<font color="red">Не привязан</font>';
                                       }
                                       if($social != '') {
                                        $stat_social = 'Перейти'; 
                                       }
                                       
                                       if($ban == 1) {
                                        $button_ban = "<button class='additionalBtn text-danger fw-bold' style='width: 100%;height: 30px;margin-bottom: 0px;padding-top: 3px;margin-bottom:5px;' onclick="."unban_adm('$id')"."><h6 class='mob-b-t'>Разбан</h6></button>";
                                        $status = "Да";
                                        $ban_icon = "<i class='fa fa-lock' aria-hidden='true' style='color:orange; margin-top:5px;margin-left:5px;' id='icon-$id'></i>";
                                       }
                                       if($ban == 0) {
                                        $button_ban = "<button class='additionalBtn text-success fw-bold' style='width: 100%;height: 30px;margin-bottom: 0px;padding-top: 3px;margin-bottom:5px;' onclick="."ban_adm('$id');"."><h6 class='mob-b-t'>Бан</h6></button>";
                                        $status = "Нет";
                                        $ban_icon = "";
                                       }
                                       echo "<tr role='row' class='odd' >
                                       <td>$id</td>
                                       <td><span id='$id'><img style='width: 29px;    height: 29px;border-radius: 100px;' src='$imgs;' > $name $ban_icon</span></td>
                                       <td>$userwager</td>
                                       <td>$balance</td>
                                       <td><a href='$social' target='_blank'>$stat_social</a></td>
                                       <td>$tg</td>
                                       <td>$prava</td>
                                       <td>
                                       <button class='btn btn-primary' style='width: 100%;' onclick="."location.href='/admin/userInfo?id=$id'"."><h6 class='mob-b-t'>Подробнее</h6></button>
                                       
                                         </td>
                                       
                                       </tr>";
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

<script>
         $(document).ready(function() {
            $('#us-table').DataTable({ 
                pageLength : 10,
    lengthMenu: [[10, 20, 50], [10, 20, 50]],
            }); 
        });       
</script>


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