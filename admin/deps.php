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
<span class="admin_info_navigator">Dashboard <span class="admin_info_navigator2">/ Deposits</span></span>
</div>
<!-- content -->


<div class="table-responsive" id="promo-table">
<table class="table table-light table-striped table-hover">
<thead>
<tr>
<th scope="col">ID</th>
<th scope="col">ID игрока</th>
<th scope="col">№ транзакции</th>
<th scope="col">Дата</th>
<th scope="col">Сумма</th>
<th scope="col">Статус</th>
</tr>
</thead>
<tbody>
<?php 
$sql_select5 = "SELECT * FROM deposits  ORDER BY id + 0 DESC";
$result5 = mysql_query($sql_select5);                                                                       
while($row = mysql_fetch_array($result5)) {
$id = $row['id'];
$date = $row['data'];
$sum = $row['suma'];
$user = $row['user_id'];
$transaction = $row['transaction'];
$status = $row['status'];
$sum = round($sum, 2);
$checkico = "<i style='color:#4ba136;font-size: 14px;margin-right:5px;' class='fa fa-check' aria-hidden='true'></i>";
$waitico = "<i style='color:#4b5261;font-size: 14px;margin-right:5px;' class='fa fa-clock' aria-hidden='true'></i>";
$sstatus = "<span style='color:#4ba136;'>$checkico Зачислен</span>";
echo "
<tr>
<td>$id</td>
<td>$user</td>
<td>#$transaction</td>
<td>$date</td>
<td>$sum</td>
<td>$sstatus</td>
</tr>";
}
?>
</tbody>
</table>
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