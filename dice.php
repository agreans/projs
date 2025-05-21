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
<script>
function _nuxt_game_history() {
if(navigator.onLine == true) {
$("._nuxt_games_history_list").load("dice.php ._nuxt_games_history_list");
 } 
}
setInterval('_nuxt_game_history()',1000);
</script> 

<div class="_nuxt_container">

<div class="_nuxt_combined_card">
<div class="_nuxt_card gap15">
<span class="_nuxt_card_title">Играть</span>
<div class="_nuxt_card_body gap20">

<span>Выберите режим игры:</span>
<div class="_nuxt_selectgame mb10" data-toggle="modal" data-target="#selectGame"><i style="margin-right: 7px;font-size: 8px;" class="fa fa-chevron-right"></i> Дайс</div>

<span>Введите ставку:</span>
<div class="_nuxt_controls">
 <input type="number" class="_nuxt_input" id="betSizeDice" onkeyup="profitDice();" value="1" placeholder="Введите ставку">
 <button class="_nuxt_control_btn" onclick="$('#betSizeDice').val(Math.max(($('#betSizeDice').val()/2).toFixed(2), 1));profitDice();">/2</button>
 <button class="_nuxt_control_btn" onclick="var x = ($('#betSizeDice').val()*2);$('#betSizeDice').val(parseFloat(x.toFixed(2)));profitDice();">x2</button> 
 <button class="_nuxt_control_btn" onclick="var max = $('#userBalance').attr('myBalance');$('#betSizeDice').val(Math.max(max,1));profitDice();">max</button>  
</div>

<button class="_nuxt_button" id="betDice" onClick="betdice();">Начать игру</button>


</div>
</div>




<div class="_nuxt_card gap15">
<span class="_nuxt_card_title">Дайс</span>
<div class="_nuxt_card_body">


<div class="_nuxt_combined_card gap20">
<div class="_nuxt_dice_card">

<span class="mb10">Выплата:</span>
<div class="_nuxt_dice_card_inp mb20">
<input id="dice_coef" value="2.00" disabled="">  
<span>×</span>
</div>

<div class="_nuxt_dice_card_inner">
<span class="_nuxt_dice_win" id="dice_wins" style="color: var(--color);">2.00</span>
<span class="_nuxt_dice_type">Выигрыш</span>
</div>

</div>

<div class="_nuxt_dice_card">

<span class="mb10">Шанс на победу:</span>
<div class="_nuxt_dice_card_inp mb20">
<input id="dice_per" value="50.00" disabled="">  
<span>%</span>
</div>

<div class="_nuxt_dice_card_inner">
<span class="_nuxt_dice_win" id="dice_per2">50.00%</span>
<span class="_nuxt_dice_type">Шанс на победу</span>
</div>

</div>
</div>

<span class="_nuxt_game_hash">HASH <span id="hash">Начните игру</span></span>

<div class="wrap_range">
<div class="_nuxt_dice_indicator">
<div class="_nuxt_range_dice">
<span id="nums">...</span>
</div>
</div>
<div class="">
<input type="range" oninput="fun1();profitDice();" id="r1" name="chance" min="2" value="50" max="99" step="0.01" class="range">
</div>
</div>


</div>
</div>
</div>

<?
require ("include/gamehistory.php");
?>

<?
require ("include/footer.php");
?> 
  
  
<script>
function profitDice() {
$('#dice_wins').html( ($('#betSizeDice').val() * $('#dice_coef').val()).toFixed(2) );
}     

function betdice() {
$('#betDice').html('<span class="loader"></span>');                                                       	
$('#betDice').prop('disabled', true);		
$.ajax({
type: 'POST',
url: '/actions/dice_action.php',
beforeSend: function() {
},	
data: {
type: "dice",
betsize: $('#betSizeDice').val(),
celwin: $('#r1').val(),
},
success: function(data) {
var obj = jQuery.parseJSON(data);
if(obj.success == "fatal")
{
//$('#hash').html(obj.hash);
$('#betDice').html('Начать игру');                                                       	
$('#betDice').prop('disabled', false);
toastr['error'](obj.error)
return false;
}
if (obj.success == "success")
{
$('#hash').html(obj.hash);
$('._nuxt_dice_indicator').show();
$('._nuxt_dice_indicator').animate({
'left': $('#r1').width() / 100 * obj.num + 'px'
});
$('._nuxt_dice_indicator').addClass(' win');
$('._nuxt_dice_indicator').removeClass('lose');
$('#nums').html(obj.num);
setTimeout(function() {
greenBalance();    
$('#userBalance').text(obj.new_balance);
$('#userBalance').attr('myBalance', obj.new_balance);
$('#betDice').html('Начать игру');                                                       	
$('#betDice').prop('disabled', false);
}, 700);
}else{
$('#hash').html(obj.hash);    
$('._nuxt_dice_indicator').show();
$('._nuxt_dice_indicator').animate({
'left': $('#r1').width() / 100 * obj.num + 'px'
});
$('._nuxt_dice_indicator').addClass(' lose');
$('._nuxt_dice_indicator').removeClass('win');
$('#nums').html(obj.num);
setTimeout(function() {
redBalance();    
$('#userBalance').text(obj.new_balance);
$('#userBalance').attr('myBalance', obj.new_balance);
$('#betDice').html('Начать игру');                                                       	
$('#betDice').prop('disabled', false);
}, 700);							
}
}
});
}


function fun1() {
var val = $('.range').val(); 
$('.range').css({ 
'background': '-webkit-linear-gradient(left ,#ab6979 0%,#a14759 ' + val + '%,#40c46e ' + val + '%, #69be8e 100%)' 
}); 
var chance = (100 - $('#r1').val()).toFixed(2); 
var viplata = 99 / chance; 
$('#dice_per2').html(chance+'%');  
$('#dice_per').val(chance); 
$('#dice_coef').val(viplata.toFixed(2)); 
var summ = $("#stavka_dice").val(); 
var win1 = $('#dice_coef').val(); 
var summa = summ * win1; 
$("#win").text(summa.toFixed(2)) 
$('#chance_2').val((100 - $('#r1').val()).toFixed(2));
}
</script>  
  
  
    
</body>
</html>    