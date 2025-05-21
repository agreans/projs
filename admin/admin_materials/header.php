
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" crossorigin="anonymous"></script>
  <script src="admin_materials/toastr.min.js" crossorigin="anonymous"></script>
<link href="admin_materials/toastr.css"rel="stylesheet">
 <script src="js/functions.js"></script>
 <link href='admin_materials/css.css' rel='stylesheet'>
 <script src="admin_materials/datatables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title><?=strtoupper($sitename);?> - Admin Dashboard</title>
</head>


<div class="header">

<div class="header_user">
 <img src="<?=$get['img']?>">
 <span><?=$get['login']?></span>
</div>

</div>


  <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
  </label>
  <div id="sidebarMenu">
    <ul class="sidebarMenuInner">
      <li class="headText">Информация</li>
      <li><i class="fa fa-home"></i> <a href="/admin/">Главная</a></li>
      <li><i class="fa fa-gear"></i> <a href="/admin/settings">Настройки сайта</a></li>      
      <li><i class="fa fa-users"></i> <a href="/admin/users">Пользователи</a></li>
    </ul>
    <ul class="sidebarMenuInner">
      <li class="headText">Кошелек</li>
      <li><i class="fa fa-plus"></i> <a href="/admin/deps">Пополнения</a></li>
      <li><i class="fa fa-minus"></i> <a href="/admin/withs">Выводы</a></li>
    </ul>   
    <ul class="sidebarMenuInner">
      <li class="headText">Промокоды</li>
      <li><i class="fa fa-gift"></i> <a href="/admin/promo">Денежные</a></li>
      <!--<li><i class="fa fa-minus"></i> <a href="/admin/promodep">К депозиту</a></li>-->
    </ul>   
    <hr style="opacity: 0.1;color: #fff;margin: 0;">
     <ul class="sidebarMenuInner">
      <li><i class="fa fa-arrow-right"></i> <a href="/">Выход из dashboard</a></li>
      <!--<li><i class="fa fa-minus"></i> <a href="/admin/promodep">К депозиту</a></li>-->
    </ul>       
  </div>
