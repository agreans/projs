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
$("._nuxt_games_history_list").load("mines.php ._nuxt_games_history_list");
 } 
}
setInterval('_nuxt_game_history()',1000);
</script> 

<div class="_nuxt_container">

<div class="_nuxt_combined_card mb25">
<div class="_nuxt_card gap15">
<span class="_nuxt_card_title">Играть</span>
<div class="_nuxt_card_body gap20">

<span>Выберите режим игры:</span>
<div class="_nuxt_selectgame mb10" data-toggle="modal" data-target="#selectGame"><i style="margin-right: 7px;font-size: 8px;" class="fa fa-chevron-right"></i> Баблс</div>

<span>Введите ставку:</span>
<div class="_nuxt_controls">
 <input type="number" class="_nuxt_input" id="BetSize" value="1" placeholder="Введите ставку">
 <button class="_nuxt_control_btn" onclick="$('#BetSize').val(Math.max(($('#BetSize').val()/2).toFixed(2), 1));profitDice();">/2</button>
 <button class="_nuxt_control_btn" onclick="var x = ($('#BetSize').val()*2);$('#BetSize').val(parseFloat(x.toFixed(2)));profitDice();">x2</button> 
 <button class="_nuxt_control_btn" onclick="var max = $('#userBalance').attr('myBalance');$('#BetSize').val(Math.max(max,1));profitDice();">max</button>  
</div>

<span>Коэффициент:</span>
<div class="_nuxt_controls">
 <input type="number" class="_nuxt_input" value="2"  id="BetPercent" placeholder="Введите коэффициент">
 <button class="_nuxt_control_btn" onclick="$('#BetPercent').val(2);">2</button>
 <button class="_nuxt_control_btn" onclick="$('#BetPercent').val(5);">5</button> 
 <button class="_nuxt_control_btn" onclick="$('#BetPercent').val(10);">10</button>  
</div>

<button class="_nuxt_button mt-3" style="width:100%;" id="bubbles_btn" onClick="bubbles();">Начать игру</button>

</div>
</div>




<div class="_nuxt_card gap15">
<span class="_nuxt_card_title">Баблс</span>
<div class="_nuxt_card_body" style="padding: 10px;    position: relative;">

<div class="_nuxt_bubbles_block">
<div class="_nuxt_bubbles_w100">
<b>Х</b> <span id="BetProfit">2.00
</span>
</div>
</div>


<span class="_nuxt_game_hash _nuxt_hash_bubbles">HASH <span id="hash">Начните игру</span></span>

</div>
</div>
</div>


<script>
                                          function validateBetPercent(inp) {
                                if (inp.value > 10000) {
                                    inp.value = 10000;
                                }


                                inp.value = inp.value.replace(/[,]/g, '.')
                                    .replace(/[^\d,.]*/g, '')
                                    .replace(/([,.])[,.]+/g, '$1')
                                    .replace(/^[^\d]*(\d+([.,]\d{0,2})?).*$/g, '$1');



                            }

                            function updateProfit() {
                                $('#MinRange').html(Math.floor(($('#BetPercent').val() / 100) * 999999));
                                $('#MaxRange').html(999999 - Math.floor(($('#BetPercent').val() / 100) * 999999));
                                $('#BetX').html((100 / $('#BetPercent').val()).toFixed(2));
                                $('#upgradeCef').html((($('#upgradeWin').val() / $('#BetSizeUpgrade').val())).toFixed(2));
                                $('#upgradeChance').html(((100 / $('#upgradeCef').html())).toFixed(2));
                                $('#BetProfit').html(($('#BetPercent').val() * $('#BetSize').val()).toFixed(2));
                            }

                            function validateBetSize(inp) {

                                inp.value = inp.value.replace(/[,]/g, '.')
                                    .replace(/[^\d,.]*/g, '')
                                    .replace(/([,.])[,.]+/g, '$1')
                                    .replace(/^[^\d]*(\d+([.,]\d{0,2})?).*$/g, '$1');
                            }

                            function bubbles() {
                                $.ajax({
                                    type: 'POST',
                                    url: '/actions/bubbles_action.php',
                                    beforeSend: function() {
                                    $('#bubbles_btn').html('<span class="loader"></span>');
                                    $('#bubbles_btn').prop('disabled', true);
                                    },
                                    data: {
                                        type: 'bubbles',
                                        per: $('#BetPercent').val(),
                                        sum: $('#BetSize').val(),
                                    },
                                    success: function(data) {
                                        var obj = jQuery.parseJSON(data);
                                        
                                        setTimeout(function() {
                                        if (obj.success == "success") {
                                            $('._nuxt_bubbles_w100').css('color', 'var(--color)');
                                            //toastr.success("Ура! Вы выиграли!", "Поздравляем");
                                            $('#userBalance').text(obj.new_balance);
                                            $('#hash').html(obj.hash);
                                            $('#userBalance').attr('myBalance', obj.new_balance);
                                            greenBalance();
                                            $('#bubbles_btn').html('Начать игру'); 
                                            $('#BetProfit').html(obj.number);
                                        }
                                        if (obj.success == "error") {
                                            $('._nuxt_bubbles_w100').css('color', '#a14759');
                                            //toastr.error(obj.error, "Проигрыш");
                                            $('#hash').html(obj.hash);
                                            $('#userBalance').text(obj.new_balance);
                                            $('#userBalance').attr('myBalance', obj.new_balance);
                                            redBalance();
                                            $('#bubbles_btn').html('Начать игру'); 
                                            $('#BetProfit').html(obj.number);
                                        }
                                        if (obj.success == "exclusive") {
                                        toastr.error(obj.error, "Ошибка");
                                        $('#bubbles_btn').html('Начать игру');
                                        }
                                        $('#bubbles_btn').prop('disabled', false);
                                        }, 500);
                                    }
                                });
                            }
            </script>

<?
require ("include/gamehistory.php");
?>

<?
require ("include/footer.php");
?> 

    
</body>
</html>    