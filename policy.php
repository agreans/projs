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

require ("include/header.php");
?>



<body>
 
<style>
.agree_banner {
position: relative;
    border-radius: 8px;
    background: var(--color);
    padding: 18px 20px;
    color: #fff;
    font-size: 13px;
    text-align: center;
    font-weight: 500;
    line-height: 22px;
    margin-bottom: -30px;
}
.text_borders {
height: 5px;
    width: 100%;
    background: var(--color);
    opacity: 0.5;
    border-radius: 100px;
    margin-top: 10px;
    margin-bottom: 20px;
}
.text__content h3 {
    font-size: 19px;
    color: var(--main-color);
}
.text__content p {
    position: relative;
    margin: 14px 0;
    font-size: 12px;
    color: var(--main-color);
    opacity: 0.5;
    line-height: 20px;
}
</style> 

<div class="_nuxt_container">


<span class="_nuxt_card_title">Политика конфиденциальности</span>
<div class="_nuxt_card_body gap10" style="    margin-top: 10px;display: grid;height: auto;">
<div class="text__content">
                        <h3>1. Какая информация подлежит сбору</h3>
                        <p>1.1. Сбору подлежат только сведения, обеспечивающие возможность поддержки обратной связи с пользователем.</p>
                        <p>1.2. Некоторые действия пользователей автоматически сохраняются в журналах сервера:</p>
                        <p>1.2.1. IP-адрес, данные о типе браузера;</p>
                        <p>1.2.2. Надстройках, времени запроса и т. д.</p>
                        <div class="text_borders"></div>
                        <h3>2. Как используется полученная информация</h3>
                        <p>2.1. Сведения, предоставленные пользователем, используются для связи с ним, в том числе для направления уведомлений.</p>
                        <div class="text_borders"></div>
                        <h3>3. Управление личными данными</h3>
                        <p>3.1. Личные данные доступны для просмотра, изменения и удаления в личном кабинете пользователя.</p>
                        <p>3.2. В целях предотвращения случайного удаления или повреждения данных информация хранится в резервных копиях в течение 7 дней и может быть восстановлена по запросу пользователя.</p>
                        <div class="text_borders"></div>
                        <h3>4. Предоставление данных третьим лицам</h3>
                        <p>4.1. Личные данные пользователей могут быть переданы лицам, не связанным с настоящим сайтом, если это необходимо:</p>
                        <p>4.1.1. Для соблюдения закона, нормативно-правового акта, исполнения решения суда;</p>
                        <p>4.1.2. Для выявления или воспрепятствования мошенничеству;</p>
                        <p>4.1.3. Для устранения технических неисправностей в работе сайта;</p>
                        <p>4.1.4. Для предоставления информации на основании запроса уполномоченных государственных органов.</p>
                        <p>4.2. В случае продажи настоящего сайта пользователи должны быть уведомлены об этом не позднее чем за 10 дней до совершения сделки.</p>
                        <div class="text_borders"></div>
                        <h3>5. Безопасность данных</h3>
                        <p>5.1. Администрация сайта принимает все меры для защиты данных пользователей от несанкционированного доступа, в частности:</p>
                        <p>5.1.1. Регулярное обновление служб и систем управления сайтом и его содержимым;</p>
                        <p>5.1.2. Шифровка архивных копий ресурса;</p>
                        <p>5.1.3. Регулярные проверки на предмет наличия вредоносных кодов;</p>
                        <p>5.1.4. Использование для размещения сайта виртуального выделенного сервера.</p>
                        <div class="text_borders"></div>
                        <h3>6. Изменения</h3>
                        <p>6.1. Обновления политики конфиденциальности публикуются на данной странице.</p>
                    </div>


</div>




<?
require ("include/footer.php");
?> 
  
</div> 
    
    
    
</body>
</html>    