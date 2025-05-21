
<div class="modal fade" id="login" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content" style="border-radius: 0px;padding: 0;background: transparent;">
<button class="_nuxt_close_modal" data-dismiss="modal"><i class="fa fa-close"></i></button>
<div class="_nuxt_modal_login">
 <div class="_nuxt_modal_login_one">
   <a class="_nuxt_header_logo" style="text-align: center;">
 <span class="_nuxt_header_logo_title"><?=$sitename?></span>
 <span class="_nuxt_header_logo_description">Онлайн игры</span>
   </a>
 </div> 
 <div class="_nuxt_modal_login_two">
  <span>Вход в аккаунт</span>
  <div class="_nuxt_login_wrap">
    <span class="_nuxt_login_title">Войти с помощью:</span>
    <a class="_nuxt_btn_vk" href="/auth/vknew/redirect">ВКонтакте</a>
    <a class="_nuxt_btn_tg" disabled="" >Telegram</a>
  </div>
 </div>  
</div>
    
</div>
</div>
</div>
    

<div class="modal fade" id="logout" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<button class="_nuxt_close_modal" data-dismiss="modal"><i class="fa fa-close"></i></button>
<div class="_nuxt_modal_header mb20">
 <span class="_nuxt_modal_header_title">Выход из аккаунта</span>
</div>

<div class="_nuxt_modal_content">
 <span class="mb15 _nuxt_exit_text">Вы уверены, что хотите выйти из текущего аккаунта? Считаем важным напомнить:</span>
 <div class="_nuxt_exit_alert_warn mb15">
<span>Регистрация более 1 аккаунта строго запрещена и неминуемо приведет к блокировке всех аккаунтов.</span>
<i class="fa-solid fa-triangle-exclamation"></i>
 </div>
 <div class="_nuxt_exit_alert_info mb15">
<span>Блокировка происходит не в сам момент нарушения правил сайта, а значительно позже, например, при проверке заявки на вывод средств.</span>
<i class="fa-solid fa-circle-exclamation"></i>
 </div> 
<button class="_nuxt_button" style="background: #ed6b5e;box-shadow: 0px 0px 20px #ed6b5e4a;" onClick="location.href='/logout'">Выйти из аккаунта</button> 
</div>

</div>
</div>
</div>


<div class="modal fade" id="withdraw" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">
<button class="_nuxt_close_modal" data-dismiss="modal"><i class="fa fa-close"></i></button>
<div class="_nuxt_modal_header mb20">
 <span class="_nuxt_modal_header_title">Вывод средств</span>
</div>
<hr style="margin: 0;margin-top: -10px;margin-bottom: 40px;opacity: 0.1;">
<div class="_nuxt_modal_content">

<div class="_nuxt_combined_card gap20">
<div class="_nuxt_dice_card">
 <b>Укажите сумму:</b>    
 <input class="_nuxt_wallet_inp" onkeyup="final_sum_with();" id="withdraw_amount" value="<?=$min_withdraw_sum?>" placeholder="Сумма выплаты"> 
 <br>
 <b>Укажите Ваш кошелек:</b>    
 <input class="_nuxt_wallet_inp" id="withdraw_wallet" placeholder="Ваш кошелек"> 
 <br> 
 <span class="_nuxt_wallet_sum_final">К зачислению: <b id="withdraw_final"><?$min_final_w = ($min_withdraw_sum / 100) * 97;$min_final_w = round($min_final_w, 2);echo $min_final_w;?></b> <b><?=$site_vault?></b> </span>
 <span class="_nuxt_wallet_sum_final" style="font-size:12px;">Комиссия - 3%</span>
 <br>
 <button id="wbt" class="_nuxt_button" onClick="easy_withdraw();">Вывести</button>
</div>  

<div class="_nuxt_dice_card" style="display: flex;flex-direction: column;">
 <b>Выберите систему:</b>
 <div class="_nuxt_wallet_systems mb20">
   <span class="_nuxt_wallet_system" onClick="$('#sysw').val('fkwallet');$('._nuxt_wallet_system').removeClass('active');$(this).addClass(' active');"><img src="../media/payments/fkwallet.png"> FKWallet</span>     
   <span class="_nuxt_wallet_system" onClick="$('#sysw').val('sbp');$('._nuxt_wallet_system').removeClass('active');$(this).addClass(' active');"><img src="../media/payments/sbp.png"> СБП</span>
   <span class="_nuxt_wallet_system" onClick="$('#sysw').val('bank_ru');$('._nuxt_wallet_system').removeClass('active');$(this).addClass(' active');"><img src="../media/payments/bank_ru.png"> Банк. карты</span>
<input id="sysw" value="" class="d-none">
 </div>
<div class="_nuxt_selectgame mb10" onClick="location.href='/profile/withdraws'">История выплат</div>
</div>  
</div>
<hr style="margin-top:25px;margin-bottom:15px;opacity: 0.1;">
<span class="_nuxt_wallet_warning">© 2024 <?=$sitename?> - Все права защищены и охраняются законом.</span>
</div>

</div>
</div>
</div>

<div class="modal fade" id="deposit" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">
<button class="_nuxt_close_modal" data-dismiss="modal"><i class="fa fa-close"></i></button>
<div class="_nuxt_modal_header mb20">
 <span class="_nuxt_modal_header_title">Пополнение баланса</span>
</div>
<hr style="margin: 0;margin-top: -10px;margin-bottom: 40px;opacity: 0.1;">
<div class="_nuxt_modal_content">

<div class="_nuxt_combined_card gap20">
<div class="_nuxt_dice_card">
 <b>Укажите сумму:</b>    
 <input class="_nuxt_wallet_inp" onkeyup="final_sum_dep();" id="depositSize" value="<?=$min_sum_dep?>" placeholder="Сумма пополнения"> 
 <button style="gap: 10px;display: flex;align-items: center;justify-content: center;" id="dbt" class="_nuxt_button" onClick="easy_deposit();">Пополнить  <span class="_nuxt_wallet_sum_final" style="background: #00000036;font-size: 14px;padding: 4px 7px;border-radius: 7px;"><b style="opacity: 0.6;" id="deposit_final"><?=$min_sum_dep?></b> <b style="opacity: 0.6;"><?=$site_vault?></b> </span></button>
</div>  

<div class="_nuxt_dice_card" style="display: flex;flex-direction: column;">
 <b>Выберите систему:</b>
 <div class="_nuxt_wallet_systems mb20">
   <span class="_nuxt_wallet_system" onClick="$('#sysp').val(<?=$pstype?>);$('._nuxt_wallet_system').removeClass('active');$(this).addClass(' active');"><img src="../media/payments/sbp.png"> СБП</span>
   <span class="_nuxt_wallet_system" onClick="$('#sysp').val(<?=$pstype?>);$('._nuxt_wallet_system').removeClass('active');$(this).addClass(' active');"><img src="../media/payments/sber.png"> Сбербанк</span>
   <span class="_nuxt_wallet_system" onClick="$('#sysp').val(<?=$pstype?>);$('._nuxt_wallet_system').removeClass('active');$(this).addClass(' active');"><img src="../media/payments/tinkoff.png"> Т-Банк</span>
   <span class="_nuxt_wallet_system" onClick="$('#sysp').val(<?=$pstype?>);$('._nuxt_wallet_system').removeClass('active');$(this).addClass(' active');"><img src="../media/payments/bank_ru.png"> Банк. карты</span>
   <span class="_nuxt_wallet_system" onClick="$('#sysp').val(<?=$pstype?>);$('._nuxt_wallet_system').removeClass('active');$(this).addClass(' active');"><img src="../media/payments/fkwallet.png"> FKWallet</span>   
<input id="sysp" value="" class="d-none">
 </div>
<div class="_nuxt_selectgame mb10" onClick="location.href='/profile/deposits'">История пополнений</div> 
</div>  
</div>
<hr style="margin-top:25px;margin-bottom:15px;opacity: 0.1;">
<span class="_nuxt_wallet_warning">© 2024 <?=$sitename?> - Все права защищены и охраняются законом.</span>
</div>

</div>
</div>
</div>

<script>
function final_sum_dep(){
  var dep_sum = $('#depositSize').val();
  if(dep_sum == null || dep_sum == '' || dep_sum == '0'){
  $('#deposit_final').html(0);     
  }else{
  $('#deposit_final').html(dep_sum);  
  }
}    
function easy_deposit() {
    $.ajax({
        type: 'POST',
        url: '../server.php',
        beforeSend: function() {
        },
        data: {
            type: "deposit",
            system: $('#sysp').val(),
            sum: $("#depositSize").val()
        },
        success: function(data) {
            var obj = jQuery.parseJSON(data);
            if (obj.success == "success") {
                $('#dbt').html('<div class="loader"></div>'); 
            setTimeout(function() {    
                toastr['success']("Переадресовываем на страницу с оплатой","Успешно")
                window.location.href = obj.locations;
            }, 1000);    
            }
            if (obj.success == "error") {
                toastr['error'](obj.error,"Ошибка")
            }
        }
    });
}
function final_sum_with(){
  var with_sum = $('#withdraw_amount').val();
  var with_sum2 = ( (with_sum / 100) * 97 ).toFixed(2);
  
  if(with_sum2 == null || with_sum2 == '' || with_sum2 == '0'){
  $('#withdraw_final').html(0);     
  }else{
  $('#withdraw_final').html(with_sum2).toFixed(2); 
  }
}    
function easy_withdraw() {
        $.ajax({
            type: 'POST',
            url: '../server.php',
            beforeSend: function() {
                $('#wbt').html('<div class="loader"></div>');
            },
            data: {
                type: "withdrawuser",
                system: $('#sysw').val(),
                wallet: $('#withdraw_wallet').val(),
                sbpbank: $('#sbp_type').val(),
                sum: $('#withdraw_amount').val()
            },
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                if (obj.success == "success") {
                    $("#wbt").html('Вывести');
                    toastr['success']("Выплата #"+obj.id_with+" успешно создана","Успешно")
                    $('#userBalance').text(obj.new_balance);
                    $('#userBalance').attr('myBalance', obj.new_balance);        
                    redBalance();
                    return
                } else {
                    $("#wbt").html('Вывести');


                    toastr['error'](obj.error,"Ошибка")
                }
            }
        });
}
</script>



<div class="modal fade" id="selectGame" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl">
<div class="modal-content">
<button class="_nuxt_close_modal" data-dismiss="modal"><i class="fa fa-close"></i></button>
<div class="_nuxt_modal_header mb20">
 <span class="_nuxt_modal_header_title">Режимы игры</span>
 <span class="_nuxt_modal_header_more">Выберите режим игры что бы начать игру</span>
</div>

<div class="_nuxt_modal_content">
 <div class="_nuxt_select_game_block">
   
   <div class="_nuxt_select_game_list">
     <i class="fa fa-dice"></i>
     <span>Дайс</span>
     <button onClick="location.href='/dice'" class="_nuxt_button">Выбрать</button>
   </div>
   
   <div class="_nuxt_select_game_list">
     <i class="fa fa-bomb"></i>
     <span>Мины</span>
     <button onClick="location.href='/mines'" class="_nuxt_button">Выбрать</button>
   </div>
   
   <div class="_nuxt_select_game_list">
     <i class="fa-solid fa-soap"></i>
     <span>Баблс</span>
     <button onClick="location.href='/bubbles'" class="_nuxt_button">Выбрать</button>
   </div>
   
<!--  <div class="_nuxt_select_game_list">
     <i class="fa-solid fa-khanda"></i>
     <span>Джекпот</span>
     <button onClick="location.href='#'" class="_nuxt_button">Выбрать</button>
   </div>
-->   
     
 </div>
</div>

</div>
</div>
</div>