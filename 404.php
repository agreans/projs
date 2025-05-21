<?

require ("system/config.php");
session_start();
$sid = $_SESSION['hash'];

$refer = $_GET['partner'];
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
 
<style>
._nuxt_404_wrap{
    justify-content: center;
    display: grid;
    align-items: center;
    width: 100%;
    text-align: center;    
}    
._nuxt_404_main{
    font-weight: bold;
    letter-spacing: -13px;
    font-size: 120px;    
}
._nuxt_404_add{
     text-transform: uppercase;
    font-size: 18px;
    text-align: center;
    margin: 0 auto;
    margin-top: -10px;   
}
._nuxt_404_main .first_path{
animation: anim404 2.8s infinite ease-out;
}
._nuxt_404_main .secon_path{
animation: anim404 3s infinite ease-out;    
}
._nuxt_404_main .third_path{
animation: anim404 3.2s infinite ease-out;    
}



@keyframes anim404 {
0% {
opacity:1;
}

50% {
opacity:0;
}

100% {
opacity:1;
}
}
</style>
<div class="_nuxt_container">

<div class="_nuxt_404_wrap">

<div class="_nuxt_404_main">
 <span class="first_path">4</span>
 <span class="secon_path">0</span>
 <span class="third_path">4</span>
</div>

<span class="_nuxt_404_add">страница не найдена</span>
<button class="_nuxt_button" style="margin-top: 20px;" onClick="location.href='/'">На главную</button>

</div>







<?
require ("include/footer.php");
?> 
  
</div> 
    
    
    
</body>
</html>    