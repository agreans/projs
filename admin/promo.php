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
<span class="admin_info_navigator">Dashboard <span class="admin_info_navigator2">/ Promocodes</span></span>
</div>
<!-- content -->

<button data-toggle="modal" data-target="#createPromocode" class="btn btn-primary mb10">Создать промокод</button>
                           <div class="table-responsive" id="promo-table">
                              <table class="table table-light table-striped">
                                 <thead>
                                    <tr>
                                       <th scope="col">ID</th>
                                       <th scope="col">Дата</th>
                                       <th scope="col">Название</th>
                                       <th scope="col">Сумма</th>
                                       <th scope="col" >Активаций</th>
                                       <th scope="col">Действие</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 

   $sql_select5 = "SELECT * FROM promo ORDER BY id + 0 DESC";
   $result5 = mysql_query($sql_select5); 
                                       while($row = mysql_fetch_array($result5)) {
                                       $id = $row['id'];
                                       $date = $row['date'];
                                       $name = $row['name'];
                                       $sum = $row['sum'];
                                       $active = $row['active'];
                                       $actived = $row['actived'];
                                       
 
                                       
                                       echo "
                                                                         <tr>
                                                                           <td>$id</td>
                                                                           <td>$date</td>
                                                                           <td>$name</td>
                                                                           <td>$sum</td>
                                                                           <td>$active / $actived</td>
                                                                            <td onclick='del_promo(".$id.")'><button class='btn btn-danger'>Удалить</button></td>
                                                                     
                                                                           
                                                                           
                                                                           
                                       								  </tr> ";
                                       }
                                       
                                       
                                         ?>
                                 </tbody>
                              </table>
                           </div>


<? require("admin_materials/footer.php"); ?>
</div>
<!-- container end -->


<div class="modal fade" id="createPromocode" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create promocode</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="mb-3">
  <label class="form-label">Название</label>
  <div style="display: flex;gap: 5px;">
  <input type="text" class="form-control" id="promoname" placeholder="Название промокода">
  <button class="btn btn-primary" onclick="generateRandomCode()"><i class="fa fa-edit"></i></button>
  </div>
</div>
<div class="mb-3">
  <label class="form-label">Сумма</label>
  <input type="number" class="form-control" id="promosum" placeholder="Сумма промокода">
</div>
<div class="mb-3">
  <label class="form-label">Активаций</label>
  <input type="number" class="form-control" id="promoact" placeholder="Количество активаций">
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" onclick="create()">Создать промокод</button>
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