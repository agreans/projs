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
 

<div class="_nuxt_container">


<section class="accordion">
	    
<div class="tab">
<input type="checkbox" name="accordion-1" id="cb1" />
<label for="cb1" class="tab__label"><span>Через сколько приходит выплата?</span></label>
<div class="tab__content">
<p>
Вывод средств осуществляется от 5 минут до 72 часов с момента создания заявки.
</p>
</div>
</div>

<div class="tab">
<input type="checkbox" name="accordion-1" id="cb2" />
<label for="cb2" class="tab__label"><span>Реферал зарегистрировался по моей ссылке и не появился в списке</span></label>
<div class="tab__content">
<p>
Значит пользователь ранее переходил по чужой реферальной ссылке.
</p>
</div>
</div>

<div class="tab">
<input type="checkbox" name="accordion-1" id="cb3" />
<label for="cb3" class="tab__label"><span>Что делать если введены неверные реквизиты?</span></label>
<div class="tab__content">
<p>
Если такие реквизиты не существуют в выбранной платежной системе, то средства вернутся на Ваш баланс автоматически.
</p>
</div>
</div>

<div class="tab">
<input type="checkbox" name="accordion-1" id="cb4" />
<label for="cb4" class="tab__label"><span>Как отменить выплату?</span></label>
<div class="tab__content">
<p>
Для отмены выплаты нажмите 'Отмена' в разделе 'Вывод'. Баланс аккаунта мгновенно пополнится на сумму отмененной заявки.
</p>
</div>
</div>

<div class="tab">
<input type="checkbox" name="accordion-1" id="cb5" />
<label for="cb5" class="tab__label"><span>Что ни в коем случае нельзя делать на сайте?</span></label>
<div class="tab__content">
<p>
Регистрироваться по своим реферальным ссылкам. Создавать 2 и более аккаунтов намеренно, в случае если вы не заходите на сайт только ради бесплатных бонусов, а являетесь активным игроком, вас никогда не заблокируют!
</p>
<p>Запрещено использовать баги/уязвимости сайта. Все попытки использование таковых ведут за собой блокировку аккаунта.
</p>
</div>
</div>

<div class="tab">
<input type="checkbox" name="accordion-1" id="cb6" />
<label for="cb6" class="tab__label"><span>Не нашли ответ на свой вопрос?</span></label>
<div class="tab__content">
<p>
Если вы не нашли свой ответ на указанный вами вопрос, то <a href="<?=$sitegroup?>">напишите нам</a>.
</p>
</div>
</div>

<div class="tab">
<input type="checkbox" name="accordion-1" id="cb7" />
<label for="cb7" class="tab__label"><span>Сотрудничество</span></label>
<div class="tab__content">
<p>
Если у вас есть источник трафика, то вы можете обратится к менеджеру в телеграм по поводу сотрудничества <a href="https://t.me/lotbetpartners">@lotbetpartners</a>.
</p>
</div>
</div>

</section>










<?
require ("include/footer.php");
?> 
  
</div> 
    
    
    
</body>
</html>    