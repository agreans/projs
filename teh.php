<?

require ("system/config.php");
session_start();
$sid = $_SESSION['hash'];

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

?>


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
  <link href="/dist/css/toastr.css"rel="stylesheet">
  <link href="/dist/css/all.css"rel="stylesheet">
  <link href="/dist/css/mines.css"rel="stylesheet">

  <script src="/dist/js/_nuxt.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" crossorigin="anonymous"></script>
  <script src="/dist/js/toastr.min.js" crossorigin="anonymous"></script>

<title><?=strtoupper($sitename);?> - Онлайн игры с выводом денег</title>
</head>
<body>
 

<div class="_nuxt_container">


<div style="
    display: grid;
    justify-content: center;
    text-align: center;
    gap: 20px;
">

<a class="_nuxt_header_logo">
 <span class="_nuxt_header_logo_title">LOTBET</span>
 <span class="_nuxt_header_logo_description">Онлайн игры</span>
</a>    
    
<h1 style="
font-size: 50px;
    font-weight: bold;
">Доступ ограничен</h1>
<span style="
    opacity: 0.7;
">Сайт на техническом обслуживании</span>
<span style="
    opacity: 0.7;
">Следите за обновлениями в нашем Telegram</span>
</div>


  
</div> 
    
    <script>
    const url = "/";
history.pushState({}, "", url);    
    </script>
    
</body>
</html>    