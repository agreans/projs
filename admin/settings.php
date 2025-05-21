<?
require ("../system/config.php");
session_start();
$sid = $_SESSION['hash'];

$select_current = "SELECT * FROM users WHERE hash = '$sid'";
$result_current = mysql_query($select_current);
$get = mysql_fetch_array($result_current);

if($is_teh == 0){
$is_tehSelect = '';
}else{
$is_tehSelect = 'selected';    
}

if($get['admin'] == 1){
require("admin_materials/header.php");
?>


<!-- container start -->
<div class="admin_container">
<!-- info nav -->    
<div class="admin_info_nav mb20">
<span class="admin_info_title">DASHBOARD</span>
<span class="admin_info_navigator">Dashboard <span class="admin_info_navigator2">/ Settings</span></span>
</div>
<!-- content -->

<div class="grid_template4">
<div class="mb-3">
  <label class="form-label">Вагер на промокоды</label>
  <input type="number" class="form-control" id="coefpromwag" placeholder="Коэф. вагера на промокоды" value="<?=$coefpromo?>">
</div>
<div class="mb-3">
  <label class="form-label">Вагер на прочие бонусы</label>
  <input type="number" class="form-control" id="coefbonwag" placeholder="Коэф. вагера на бонусы" value="<?=$coefbonus?>">
</div>
<div class="mb-3">
  <label class="form-label">Вагер на депозит</label>
  <input type="number" class="form-control" id="coefdepwag" placeholder="Коэф. вагера на депозит" value="<?=$coefdeposit?>">
</div>
<div class="mb-3">
  <label class="form-label">Сколько списывать с вагера</label>
  <input type="number" class="form-control" id="wager_for_bets" placeholder="Списывание вагер при ставке" value="<?=$wager_for_bets?>">
</div>
<div class="mb-3">
  <label class="form-label">Название сайта</label>
  <input type="text" class="form-control" id="sitename" placeholder="Название сайта" value="<?=$sitename?>">
</div>
<div class="mb-3">
  <label class="form-label">Домен сайта</label>
  <input type="text" class="form-control" id="sitedomen" placeholder="Домен ~(.site)" value="<?=$sitedomen?>">
</div>
<div class="mb-3">
  <label class="form-label">Ссылка на сайт</label>
  <input type="text" class="form-control" id="" placeholder="" value="<?=$linksite?>" readonly="">
</div>
<div class="mb-3">
  <label class="form-label">Технические работы</label>
  <select type="text" class="form-control" id="tehworks">
           <option value="0" <?=$is_tehSelect?>>Нет</option>
           <option value="1" <?=$is_tehSelect?>>Да</option>  
  </select>   
</div>
<div class="mb-3">
  <label class="form-label">Ключ gRecaptcha</label>
  <input type="text" class="form-control" id="grecaptchakeys" placeholder="Ключ рекапчи" value="<?=$grecaptcha?>">
</div>
<div class="mb-3">
  <label class="form-label">Ссылка на группу ВК</label>
  <input type="text" class="form-control" id="sitegroup" placeholder="Ссылка на группу vk" value="<?=$sitegroup?>">
</div>
<div class="mb-3">
  <label class="form-label">Ссылка на Телеграм</label>
  <input type="text" class="form-control" id="sitesupport" placeholder="Ссылка на тг" value="<?=$sitesupport?>">
</div>
<div class="mb-3">
  <label class="form-label">Мин. ставка в режимах</label>
  <input type="number" class="form-control" id="minbet" placeholder="Мин. ставка в режимах" value="<?=$minbet?>">
</div>
<div class="mb-3">
  <label class="form-label">Макс. ставка в режимах</label>
  <input type="number" class="form-control" id="maxbet" placeholder="Макс. ставка в режимах" value="<?=$maxbet?>">
</div>
<div class="mb-3">
  <label class="form-label">Макс. коэф. в минах</label>
  <input type="number" class="form-control" id="max_mines" placeholder="Макс. коэф. в минах" value="<?=$max_mines?>">
</div>
<div class="mb-3">
  <label class="form-label">ID ВК группы</label>
  <input type="number" class="form-control" id="id_vk" placeholder="ID ВК группы" value="<?=$id_vk?>">
</div>
<div class="mb-3">
  <label class="form-label">Токен ВК группы</label>
  <input type="text" class="form-control" id="token_vk" placeholder="Токен ВК группы" value="<?=$token_vk?>">
</div>
<div class="mb-3">
  <label class="form-label">ID FreeKassa</label>
  <input type="number" class="form-control" id="fkid" placeholder="ID FreeKassa (new)" value="<?=$fkid?>">
</div>
<div class="mb-3">
  <label class="form-label">Секретный 1 FreeKassa</label>
  <input type="text" class="form-control" id="fks1" placeholder="Secret1 FreeKassa (new)" value="<?=$fks1?>">
</div>
<div class="mb-3">
  <label class="form-label">Секретный 2 FreeKassa</label>
  <input type="text" class="form-control" id="fks2" placeholder="Secret2 FreeKassa (new)" value="<?=$fks2?>">
</div>
<div class="mb-3">
  <label class="form-label">ID Linepay</label>
  <input type="number" class="form-control" id="lpid" placeholder="ID Linepay" value="<?=$lpid?>">
</div>
<div class="mb-3">
  <label class="form-label">Секретный 1 Linepay</label>
  <input type="text" class="form-control" id="lps1" placeholder="Секретный 1 Linepay" value="<?=$lps1?>">
</div>
<div class="mb-3">
  <label class="form-label">Секретный 2 Linepay</label>
  <input type="text" class="form-control" id="lps2" placeholder="Секретный 2 Linepay" value="<?=$lps2?>">
</div>
<div class="mb-3">
  <label class="form-label">Сумма депа для вывода</label>
  <input type="number" class="form-control" id="dep_withdraw" placeholder="Сумма депозита для вывода" value="<?=$dep_withdraw?>">
</div>
<div class="mb-3">
  <label class="form-label">Мин. сумма депа</label>
  <input type="number" class="form-control" id="min_deposit" placeholder="Минимальная сумма депозита" value="<?=$min_sum_dep?>">
</div>
<div class="mb-3">
  <label class="form-label">Мин. сумма вывода</label>
  <input type="number" class="form-control" id="min_withdraw_sum" placeholder="Мининимальная сумма вывода" value="<?=$min_withdraw_sum?>">
</div>
<div class="mb-3">
  <label class="form-label">Бонус за подписку на группу</label>
  <input type="number" class="form-control" id="vkgroupsize" placeholder="Бонус за подписку на группу" value="<?=$vkgroupsize?>">
</div>
<div class="mb-3">
  <label class="form-label">Бонус за репост записи</label>
  <input type="number" class="form-control" id="vkrepostsize" placeholder="Бонус за репост записи" value="<?=$vkrepostsize?>">
</div>
<div class="mb-3">
  <label class="form-label">Бонус за привязку ТГ</label>
  <input type="number" class="form-control" id="tgsize" placeholder="Бонус за тг" value="<?=$tgsize?>">
</div>
<div class="mb-3">
  <label class="form-label">Мин. сумма в раздаче</label>
  <input type="number" class="form-control" id="daily_min" placeholder="Мин. сумма в раздаче" value="<?=$min_daily_size?>">
</div>
<div class="mb-3">
  <label class="form-label">Макс. сумма в раздаче</label>
  <input type="number" class="form-control" id="daily_max" placeholder="Макс. сумма в раздаче" value="<?=$max_daily_size?>">
</div>
<div class="mb-3">
  <label class="form-label">Токен группы вк</label>
  <input type="text" class="form-control" id="vkgrouptoken" placeholder="Токен группы вк" value="<?=$vkgrouptoken?>">
</div>
<div class="mb-3">
  <label class="form-label">Айди группы вк</label>
  <input type="text" class="form-control" id="vkgoupid" placeholder="Айди группы вк" value="<?=$vkgoupid?>">
</div>
<div class="mb-3">
  <label class="form-label">Ссылка на репост</label>
  <input type="text" class="form-control" id="repostUrl" placeholder="Ссылка на репост" value="<?=$repostUrl?>">
</div>
<div class="mb-3">
  <label class="form-label">Награда за реферала</label>
  <input type="text" class="form-control" id="refrandprize" placeholder="Награда за реферала" value="<?=$refrandprize?>">
</div>
<div class="mb-3">
  <label class="form-label">Сохранить информацию</label>
  <button class="btn-primary btn" style="width:100%;" onclick="saves()">Сохранить</button>
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