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
<div class="_nuxt_selectgame mb10" data-toggle="modal" data-target="#selectGame"><i style="margin-right: 7px;font-size: 8px;" class="fa fa-chevron-right"></i> Мины</div>

<span>Введите ставку:</span>
<div class="_nuxt_controls">
 <input type="number" class="_nuxt_input" id="inputBetAmount" value="1" placeholder="Введите ставку">
 <button class="_nuxt_control_btn" onclick="$('#inputBetAmount').val(Math.max(($('#inputBetAmount').val()/2).toFixed(2), 1));profitDice();">/2</button>
 <button class="_nuxt_control_btn" onclick="var x = ($('#inputBetAmount').val()*2);$('#inputBetAmount').val(parseFloat(x.toFixed(2)));profitDice();">x2</button> 
 <button class="_nuxt_control_btn" onclick="var max = $('#userBalance').attr('myBalance');$('#inputBetAmount').val(Math.max(max,1));profitDice();">max</button>  
</div>

<span>Количество бомб:</span>
<div class="_nuxt_controls">
 <input class="_nuxt_input mines-betzzz" value="2" max="24" onkeyup="_mines.setXS($(this).val());" onchange="minesR();" name="amount" id="betBombMines" placeholder="Введите ставку">
 <button class="_nuxt_control_btn" onclick="$('#betBombMines').val(2); _mines.setXS(2);">2</button>
 <button class="_nuxt_control_btn" onclick="$('#betBombMines').val(5); _mines.setXS(5);">5</button> 
 <button class="_nuxt_control_btn" onclick="$('#betBombMines').val(15); _mines.setXS(15);">15</button>  
</div>

<button class="_nuxt_button start-game-btn mt-3" style="width:100%;" id="mines_start" onClick="startgameMine();" data-btn="game">Начать игру</button>


<div class="">
<button data-btn="collect" id="finishmines" disabled="disabled" class="_nuxt_button finish-game-btn mt-3 mb20" style="width:100%;" onClick="finishgameMine();">Забрать<span style='margin-left:5px;' id="win">0.00</span> <?=$site_vault?></button>

<button class="_nuxt_button" style="width:100%;visibility:hidden;" id="automines" data-btn="collect" onClick="autoselect_mines();">Автовыбор</button>
</div>

</div>
</div>




<div class="_nuxt_card gap15">
<span class="_nuxt_card_title">Мины</span>
<div class="_nuxt_card_body" style="padding: 10px;">

<div id="mines" class="minefield">
<button onclick="mmine(1)" id="b1" class="mine btn btn-mines"></button>
<button onclick="mmine(2)" id="b2" class="mine btn btn-mines"></button>
<button onclick="mmine(3)" id="b3" class="mine btn btn-mines"></button>
<button onclick="mmine(4)" id="b4" class="mine btn btn-mines"></button>
<button onclick="mmine(5)" id="b5" class="mine btn btn-mines"></button>
<button onclick="mmine(6)" id="b6" class="mine btn btn-mines"></button>
<button onclick="mmine(7)" id="b7" class="mine btn btn-mines"></button>
<button onclick="mmine(8)" id="b8" class="mine btn btn-mines"></button>
<button onclick="mmine(9)" id="b9" class="mine btn btn-mines"></button>
<button onclick="mmine(10)" id="b10" class="mine btn btn-mines"></button>
<button onclick="mmine(11)" id="b11" class="mine btn btn-mines"></button>
<button onclick="mmine(12)" id="b12" class="mine btn btn-mines"></button>
<button onclick="mmine(13)" id="b13" class="mine btn btn-mines"></button>
<button onclick="mmine(14)" id="b14" class="mine btn btn-mines"></button>
<button onclick="mmine(15)" id="b15" class="mine btn btn-mines"></button>
<button onclick="mmine(16)" id="b16" class="mine btn btn-mines"></button>
<button onclick="mmine(17)" id="b17" class="mine btn btn-mines"></button>
<button onclick="mmine(18)" id="b18" class="mine btn btn-mines"></button>
<button onclick="mmine(19)" id="b19" class="mine btn btn-mines"></button>
<button onclick="mmine(20)" id="b20" class="mine btn btn-mines"></button>
<button onclick="mmine(21)" id="b21" class="mine btn btn-mines"></button>
<button onclick="mmine(22)" id="b22" class="mine btn btn-mines"></button>
<button onclick="mmine(23)" id="b23" class="mine btn btn-mines"></button>
<button onclick="mmine(24)" id="b24" class="mine btn btn-mines"></button>
<button onclick="mmine(25)" id="b25" class="mine btn btn-mines"></button>
</div>

<span class="_nuxt_game_hash" style="width: 80%;margin: 0 auto;">HASH <span id="hash">Начните игру</span></span>

</div>
</div>
</div>


<div class="_nuxt_card_body" style="height:150px;position:relative;">

<div class="xs" id="xss">
</div>
    
</div>



<?
require ("include/gamehistory.php");
?>

<?
require ("include/footer.php");
?> 

<script>

function minesR(){
    var bombscount = $('#betBombMines').val();
    if(bombscount > 24){
    $('#betBombMines').val('24');    
    }
}

    var _mines = {
        mine: 3,
        active: false,
        p: 0,
        game: false,
        xs: JSON.parse(`{"1":[1.04,1.09,1.14,1.19,1.25,1.32,1.39,1.47,1.56,1.67,1.79,1.92,2.08,2.27,2.50,2.78,3.12,3.57,4.17,5.00,6.25,8.33,12.50,25.00],"2":[1.09,1.19,1.3,1.43,1.58,1.75,1.96,2.21,2.5,2.86,3.3,3.85,4.55,5.45,6.67,8.33,10.71,14.29,20,30,50,100,300],"3":[1.14,1.3,1.49,1.73,2.02,2.37,2.82,3.38,4.11,5.05,6.32,8.04,10.45,13.94,19.17,27.38,41.07,65.71,115,230,575,2300],"4":[1.19,1.43,1.73,2.11,2.61,3.26,4.13,5.32,6.95,9.27,12.64,17.69,25.56,38.33,60.24,100.4,180.71,361.43,843.33,2530,12650],"5":[1.25,1.58,2.02,2.61,3.43,4.57,6.2,8.59,12.16,17.69,26.54,41.28,67.08,115,210.83,421.67,948.75,2530,8855,53130],"6":[1.32,1.75,2.37,3.26,4.57,6.53,9.54,14.31,22.12,35.38,58.97,103.21,191.67,383.33,843.33,2108.33],"7":[1.39,1.96,2.82,4.13,6.2,9.54,15.1,24.72,42.02,74.7,140.06,280.13,606.94,1456.67,4005.83,13352.78],"8":[1.47,2.21,3.38,5.32,8.59,14.31,24.72,44.49,84.04,168.08,360.16,840.38,2185,6555,24035,120175,1081575],"9":[1.56,2.5,4.11,6.95,12.16,22.12,42.02,84.04,178.58,408.19,1020.47,2857.31,9286.25,37145,204297.5,2042975],"10":[1.67,2.86,5.05,9.27,17.69,35.38,74.7,168.08,408.19,1088.5,3265.49,11429.23,49526.67,297160,3268760],"11":[1.79,3.3,6.32,12.64,26.54,58.97,140.06,360.16,1020.47,3265.49,12245.6,57146.15,371450,4457400],"12":[1.92,3.85,8.04,17.69,41.28,103.21,280.13,840.38,2857.31,11429.23,57146.15,400023.08,5200300],"13":[2.08,4.55,10.45,25.56,67.08,191.67,606.94,2185,9286.25,49526.67,371450,5200300],"14":[2.27,5.45,13.94,38.33,115,383.33,1456.67,6555,37145,297160,4457400],"15":[2.5,6.67,19.17,60.24,210.83,843.33,4005.83,24035,204297.5,3268760],"16":[2.78,8.33,27.38,100.4,421.67,2108.33,13352.78,120175,2042975],"17":[3.13,10.71,41.07,180.71,948.75,6325,60087.5,1081575],"18":[3.57,14.29,65.71,361.43,2530,25300,480700],"19":[4.17,20,115,843.33,8855,177100],"20":[5,30,230,2530,53130],"21":[6.25,50,575,12650],"22":[8.33,100,2300],"23":[12.5,300],"24":[25]}`),
        calc: function (type, value) {
            if(_mines.game) return toastr["error"]("Активная игра");
            if($('.mines-bg [name="amount"]').attr('disabled')) return false;
            let amount = parseFloat($('.mines-bg [name="amount"]').val());
            if(!amount) amount = 1;
            if(type == 1) amount += value;
            else if(type == 2) amount *= value;
            else if(type == 3) amount /= value;
            let user_money = parseFloat($('#balance-ajax').text());
            if(amount > user_money) amount = user_money;
            return $('.mines-bg [name="amount"]').val(parseFloat(amount).toFixed(2));
        },
        setXS: (x) => {
            if(_mines.game) return toastr["error"]("Активная игра");

            let array = (_mines.xs[x]).slice(0), html = "";
            $(' .xs').html("");
            $('[data-minesin]').val(x);
            let diamons = 25 - parseInt(x);
            $('.diamons span').text(diamons);
            $('.minebomb span').text(25 - diamons);
            _mines.mine = x;
            for(let i in array) $('.xs').append('<div class="item" data-p="'+ (parseInt(i) + 1) +'" data-mine="'+ array[i]+'">'+ array[i] +'x <span class="xs_count">Шаг '+ (parseInt(i) + 1) +'</span></div>');
        }
    };
    _mines.setXS(2);

      
        function autoselect_mines(){
            $.ajax({
                url: '/server.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        type: "autoselect_mines",
                    },
                    success: function(data){
                        obj = JSON.parse(data);
                        if(obj.success == 'true'){
                            mmine(obj.select)
                            $('.finish-game-btn').show();
                            
                                                $('.start-game-btn').hide();
                                                $('.start-game-btn').attr('disabled', 'disabled');
                                                $('.finish-game-btn').removeAttr('disabled', 'disabled');
                            $("#startmines").attr("disabled","disabled");
                $("#finish-game-btn").removeAttr("disabled","disabled");
                        }
                        if(obj.success == 'false'){
                        toastr['error'](obj.mess)
                        }
                    }
        })
        }
                    function minesnew(){
                    $.ajax({
                        type: 'POST',
                        url: '/server.php',
        
                        data: {
                        type: "minesnew",
                        },
                        success: function(data) {
                        var obj = data;
        
                        if (obj.success == "success") {
                        if(obj.win != ''){
                            $('#inputBetAmount').val(obj.bet);
        
                            $('#win').html(obj.win);   
        
        
                            mine = JSON.parse(obj.click);
                            lm = mine.length;
        
                            for(i=0;i<lm;i++){
                            $("#b"+mine[i]).removeClass('btn-theme').addClass('btn-success').html("");
                        }
                        $('.finish-game-btn').show();
                        
                        
                                                $('.start-game-btn').hide();
                                                $('.start-game-btn').attr('disabled', 'disabled');
                                                $('.finish-game-btn').removeAttr('disabled', 'disabled');
                        $("#startmines").attr("disabled","disabled");
                        $("#finishmines").removeAttr("disabled","disabled");
        
                        }}
                    }
                    });
                    }
        
        var path = "/actions/mines_action.php";
        
        function startgameMine(){
            $(`[data-p]`).removeClass("active");
            $('#minesgamecheck1').hide();
            $("#startmines").attr("disabled","disabled");
            var bet = $("#inputBetAmount").val();
            var mine = "mine";
            $.ajax({
            url: "/actions/mines_action.php",
            type: "POST",
            dataType: "html",
            data: {
                type: mine,
                mines: $(".mines-betzzz").val(),
                bet: bet,
            },
            success: function(response){
                obj = $.parseJSON(response);
                if(obj.info == "warning"){
                    
                   toastr.error(obj.warning); 
                   
                   
                    $("#startmines").removeAttr("disabled","disabled");
        
        
            }else{
                if(obj.info == "true"){
                redBalance();    
                $(".minesModaled").hide();    
                $("#win").html("0.00");
                $("#MineProfit").html("1.00");
                $("#hash").html(obj.hash);
                $(".allin-win").css("visibility","visible");
        
        
                for(i=0;i<26;i++){
        
                    $("#b"+i).css('opacity','1').removeClass("mmnError mmnSuccess btn-theme").addClass('btn-theme').removeAttr("disabled","disabled").html("");
                }
                $('.start-game-btn').hide();
                $('.finish-game-btn').show();
                                                $('.start-game-btn').attr('disabled', 'disabled');
                                                $('.finish-game-btn').removeAttr('disabled', 'disabled');
                $("#startmines").attr("disabled","disabled");
                $("#finishmines").removeAttr("disabled","disabled");
                $('#automines').css("visibility","visible");
$('#userBalance').text(obj.money);
$('#userBalance').attr('myBalance', obj.money);
                
                aa = $("#betBombMines").val();
                $('#hashBet').fadeOut('slow', function () {
                $('#hashBet').fadeIn('slow', function () {
                        });
                    });
                $('#hashBet').html(obj.hash);
                }
                if(obj.info == "false"){
                toastr.error("У есть незавершенная игра"); 
                }
            }
            }
        });
        };
        if(1 > 0){
        
            function mmine(bombs){
            var pressmine = bombs;
            $.ajax({
            url: path,
            type: "POST",
            dataType: "html",
            data: {
                mmine: pressmine,
            },
            success: function(response){
            obj = $.parseJSON(response); 
            if(obj.info == "warning"){
            //toastr.error(obj.warning); 
            }
            if(obj.info == "click"){
                if(obj.bombs == "true"){


toastr.error("Вы проиграли "+obj.bet+" "+obj.site_vault,"Проигрыш!");
$('#automines').css("visibility","hidden");


$('.xs').stop().animate({ scrollLeft: `0px` }, 550);




                    $('.start-game-btn').show();
                    $('.finish-game-btn').hide();
                    $('.finish-game-btn').attr('disabled', 'disabled');
                    $('.start-game-btn').removeAttr('disabled', 'disabled');
                    $("#startmines").removeAttr("disabled","disabled");
                    $("#finishmines").attr("disabled","disabled");
                    $("#win").html("0.00");
                    for(i=0;i<26;i++){
                    if(!$("#b"+i).hasClass("btn-success")) {
                        $("#b"+i).css('opacity','0.5').removeClass('btn-theme').addClass('mmnSuccess').html('<img src="/media/mines/diamond.png" class="insertmined">');
                    }
                    }
        
                    $("#b"+bombs).css('opacity','1').removeClass('btn-theme').addClass('mmnError').html('<img src="/media/mines/bomb.png" class="insertmined">');       
                    obj.tamines = $.parseJSON(obj.tamines);
                    for(i = 0; i < obj.tamines.length; i++){
                    if(!$("#b"+obj.tamines[i]).hasClass("mmnError")) {
                        $("#b"+obj.tamines[i]).css('opacity','0.5').addClass('mmnError').html('<img src="/media/mines/bomb.png" class="insertmined">');
                    }
$('#userBalance').text(obj.money);
$('#userBalance').attr('myBalance', obj.money);
                    };
                }else{
                   
                    miner = obj.step
                    $('#win').html(obj.win);
                    var min =  $('#betBombMines').val();
                    var win = obj.win;
                    var win = win.replace(/[\.\/]/g,'_');
                    $("#mines"+min+"_"+win).addClass("coeff-item-active ");
                    $('.diamons span').text(obj.gem);
                    $("#mines"+min+"_"+win).removeClass("coeff-item");
                    $(`[data-p]`).removeClass("active");
                    $(`[data-p="${ miner }"]`).addClass("active");
                    $('.xs').stop().animate({ scrollLeft: `${ (miner - 2) * 150 }px` }, 800);
        
                    $("#b"+obj.pressmine).removeClass('btn-theme').addClass("mmnSuccess").html('<img src="/media/mines/diamond.png" class="insertmined">');
                    $("#startmines").attr("disabled","disabled");
                    $("#finishmines").removeAttr("disabled","disabled");
                    $("#MinesProfit").text(obj.win);
                    $("#b"+obj.pressmine).attr("disabled","disabled");
                    $("#MineProfit").text(obj.nextX);
                    if(obj.nextX > 0){
                    }else{
                    finishgameMine();
                    }
                }
                }
            }
            })
        
            }
        }else{
       toastr.error("Не спешите!");
        };
        
        function finishgameMine(){
            $.ajax({
            url: path,
            type: "POST",
            dataType: "html",
            data: {
                finish: true,
            },
            success: function(response){
            obj = $.parseJSON(response);
            
            if(obj.info == "warning"){
                toastr.error(obj.warning);
        
        
            }else{
                obj.tamines = $.parseJSON(obj.tamines);
                if (obj.info = true){
                for(i=0;i<26;i++){
            
                }
  greenBalance();       
 $('.xs').stop().animate({ scrollLeft: `0px` }, 550);       
$('#automines').css("visibility","hidden");
$(".minesModaled").fadeIn();
$(".contentMultiplier").html(obj.caef+'x');
$(".minesPayoutSum").html(obj.win);

toastr.success('Вы выиграли ' + obj.win + ' ' + obj.site_vault, 'Поздраялвяем!');

        $('.start-game-btn').show();
                                                $('.finish-game-btn').hide();
                                                $('.start-game-btn').removeAttr('disabled', 'disabled');
                                                $('.finish-game-btn').attr('disabled', 'disabled');
$('#userBalance').text(obj.money);
$('#userBalance').attr('myBalance', obj.money);

                $("#startmines").removeAttr("disabled","disabled");
                $("#finishmines").attr("disabled","disabled");

                
                for(i=0;i<26;i++){
        
                if(!$("#b"+i).hasClass("mmnSuccess")) {
                    $("#b"+i).css('opacity','0.5').removeClass('btn-theme').addClass('mmnSuccess').html('<img src="/media/mines/diamond.png" class="insertmined">');
                }
                }
        
        
                for(i = 0; i < obj.tamines.length; i++){
        
            
                if(!$("#b"+obj.tamines[i]).hasClass("mmnError")) {
                $("#b"+obj.tamines[i]).css('opacity','0.5').removeClass('btn-theme').addClass('mmnError').html('<img src="/media/mines/bomb.png" class="insertmined">');
                }
            }
        
        
            }
        }
        
        },
        })
        };
        
        
        
        function openMines(id){
            $.ajax({
            url: path,
            type: "POST",
            dataType: "HTML",
            data: {
                openMines: 'openMines',
                idMines: id,
            },
            success: function(response){
                obj = $.parseJSON(response);
                obj.minesopen = $.parseJSON(obj.minesopen);
        
        
                $('#open-mines-modal').modal();
                $(".openMines").html(obj.minesopen);
                $("#idbetMines").text(obj.idbetMines);
                $("#coefMinesOpen").text(obj.coefMinesOpen);
        
                if(obj.loseBomb != null){
                $(".openMines[data-number="+obj.loseBomb+"]").addClass("lose-mine fas fa-bomb");
                }
        $("#openMinesLogin").text(obj.loginMinesOpen);
        $("#winminesOpen").text(obj.winminesOpen);
        
        }
        }
        ) 
        
        }
        function renderMines() {
    $.post("/actions/mines_action.php", {getRate: "true"}).then((e) => {
        e = $.parseJSON(e);
        if (e.error) return;
        if (e.status == 1) {
            $("#mines_start").hide();
            $(".finish-game-btn").show();
            $("#finishmines").removeAttr("disabled","disabled");
            $('#automines').css("visibility","visible");
            $("#win").html(e.coef);
            for (i = 0; i <= 25; i++) {
                $("#b"+ i).attr("disabled", false).css("opacity", 1);
            }
            setTimeout(() => {
                e.click.forEach((i) => {
                    $("#b"+i)
                        .hide()
                        .attr("disabled", true)
                        .addClass("mmnSuccess")
                        .html('<img src="/media/mines/diamond.png" class="insertmined">')
                        .fadeIn(500);
                        
                });
            }, 150);
        }
    });
}
renderMines();    
</script>  
  
    
</body>
</html>    