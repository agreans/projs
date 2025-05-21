<?php

session_start();
$sid = $_SESSION['hash'];
require ("../system/config.php");
$komissia = 0.1;
// данные игрока
$sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if ($row){
    $wager = $row['wager'];
    $login = $row['login'];
    $money = $row['balance'];
    $id = $row['id'];
    $id_user = $row['id'];
    $ref = $row['ref_id'];
    $wager = $row['wager'];
}




//игровой массив
$query = ("SELECT * FROM `mines` WHERE `id_users` = '$id' AND `onOff` = '1' ORDER BY `id` DESC LIMIT 1");
$result = mysql_query($query);
$minesgame = mysql_fetch_array($result);

if ($minesgame){
    $mines = $minesgame['mines'];
    $click = $minesgame['click'];
    $step = $minesgame['step'];
    $num_mines = $minesgame['num_mines'];
    $bet = $minesgame['bet'];
    $win = $minesgame['win'];
    $resultgame = $minesgame['result'];
    $onOff = $minesgame['onOff'];
    $click = unserialize($click);
}else{
    $click = unserialize($click);
    $click = [];
}

if (!$sid) {
    $obj = array("info" => "warning", "warning" => "Необходима авторизация!");  
} else {
    

    
if (isset($_POST['type'])){
    $query = mysql_query("UPDATE `mines` SET onOff = 2 WHERE onOff=1 AND id_users = '$id'");
    $type = $_POST['type'];
    $bet = $_POST['bet'];

    if (is_numeric($bet)){
        $suc = 1;
    }
    if (!is_numeric($bet)){
        $suc = 0;
    }
    $mines = $_POST['mines']; //кол-во мин
    if ($mines == 1 || $mines == 2 || $mines == 3 || $mines == 4 || $mines == 5 || $mines == 6 || $mines == 7 || $mines == 8 || $mines == 9 || $mines == 10 || $mines == 11 || $mines == 12 || $mines == 13 || $mines == 14 || $mines == 15 || $mines == 16 || $mines == 17 || $mines == 18 || $mines == 19 || $mines == 20 || $mines == 21 || $mines == 22 || $mines == 23 || $mines == 24){
        if ($money >= $bet){
            
        if ($bet < $maxbet){
            if ($bet >= "1" && $suc == 1){
                if ($type == "mine"){
                    if ($_SESSION['hash']){
                        $query = ("SELECT * FROM `mines` WHERE `id_users` = '$id' AND `onOff` = '1' ORDER BY `id` DESC LIMIT 1");
                        $minesgame = mysql_query($query);

                        if (mysql_num_rows($minesgame) != 0){
                            $result = array(
                                "info" => "false"
                            );
                        }else{
                            //вычитаем монету
                            $newbalance = round(($money - $bet) , 2);
                            
                            $betWAG = $bet * $wager_for_bets;
                            $querym = ("UPDATE `users` SET `balance` = '$newbalance', wager = wager - '$betWAG' WHERE `id` = '$id'");
           
           
                            $money = $money - $bet;
                            $resultmines = range(1,25);
                            shuffle($resultmines);
                            $resultmines = array_slice($resultmines, 0, $mines);
                             $r = serialize($resultmines);
                             $hash = hash('sha512', $r);
                            
                            if ($mines == $mines){
                                mysql_query($querym);

                                $resultmines = serialize($resultmines);
                                $sss = []; // для заполнения столбца (click)
                                $sss = serialize($sss); // часть функции
                                $query = ("INSERT INTO `mines` (`id_users`, `bet`, `onOff`, `step`, `result`, `win`, `mines`, `click`, `num_mines`, `login`) VALUES ('$id', '$bet', '1', '0', '1', '0', '$resultmines', '$sss', '$mines', '$login')");
                                mysql_query($query);

                                $obj = array(
                                "info" => "true",
                                "hash" => $hash,
                                "money" => $money
);
                            }else{
                                $obj = array(
                                    "info" => "warning",
                                    "warning" => "Ошибка, обратитесь в поддержку! "
                                );
                            }
                        }
                    }else{
                        $obj = array(
                            "info" => "warning",
                            "warning" => "Авторизуйтесь!"
                        );
                    }
                }
            }else{
                $obj = array(
                    "info" => "warning",
                    "warning" => "Сумма ставки от - 1!"
                );
            }
        }
        else
        {
            $obj = array(
                "info" => "warning",
                "warning" => "Максимальная ставка - $maxbet!"
            );
        }
    }

        else
        {
            $obj = array(
                "info" => "warning",
                "warning" => "У Вас недостаточно средств!"
            );
        }    
    }   
    else
    {
        $obj = array(
            "info" => "warning",
            "warning" => "Количество бомб от 2-х до 24-х!"
        );
    }
}
}

if (isset($_POST['finish']))
{
    $mines = unserialize($mines);

    if ($step != "0")
    {
        if ($minesgame != null)
        {

            $newbalance = round(($money + $win) , 2);

            $k = $win / $bet;

            $winz = $win;

            $time = date('d.m Y');
            $coefic = $win / $bet;
            $coefic = round($coefic, 2);
            mysql_query("INSERT INTO `dice` (`user_id`, `bet`, `chance`, `win`, `create_at`, `game`, `coef`) VALUES ('$id', '$bet', '$caef', '$win', '$time', 'Mines', '$coefic')");

            $betWAG = $sum * $wager_for_bets;

            $query = ("UPDATE `users` SET `balance` = '$newbalance', wager = wager - '$betWAG' WHERE `id` = '$id'"); //выдаем баланс игроку за победу.
            mysql_query($query);

            $q = ("SELECT * FROM `mines` WHERE `id_users` = '$id' AND `onOff` = '1' ");
            $mi = mysql_query($q);
            $m = mysql_fetch_array($mi);
            $game_id = $m['id'];

            $query = ("UPDATE `mines` SET `onOff` = '2' WHERE `id_users` = '$id'"); //отключаем игру.
            mysql_query($query);

            $tamines = json_encode($mines);

            // для работы с антиминусом
            $query = ("SELECT * FROM `admin_mines`");
            $row_admin = mysql_query($query);
            $admin = mysql_fetch_array($row_admin);

            $bank = $admin['bank'];
            $profit = $admin['zarabotok'];
            $win = $win - $bet;
            $query = mysql_query("UPDATE `admin_mines` SET `bank`= '$bank'-'$win'");

            $win = $win + $bet;
            $caef = $win / $bet;
            $caef = round($caef, 2);
            
            $money = $money + $win; //для правильного отображения баланса
            $ssa = "<span class='number result-win result'><span class='myBetsBox'>" . $win . "</span> <i class='fas fa-coins'></i></span>";
            $obj = array(
                "info" => "true",
                "caef" => "$caef",
                "game_id" => "$game_id",
                "win" => "$win",
                "money" => "$money",
                "site_vault" => "$site_vault",
                "tamines" => "$tamines",
                "resultHistoryContentBomb" => "$ssa"
            );
        }
        else
        {
            $obj = array(
                "info" => "warning",
                "warning" => "Данная игра не существует или еще не создана!"
            );
        }
    }
    else
    {
        $obj = array(
            "info" => "warning",
            "warning" => "Откройте хотя бы 1 ячейку!"
        );
    }
}

//игрок нажал на клетку...
if (isset($_POST['mmine']))
{
    $mmines = $_POST['mmine'];
    if ($mmines == "1" || $mmines == "2" || $mmines == "3" || $mmines == "4" || $mmines == "5" || $mmines == "6" || $mmines == "7" || $mmines == "8" || $mmines == "9" || $mmines == "10" || $mmines == "11" || $mmines == "12" || $mmines == "13" || $mmines == "14" || $mmines == "15" || $mmines == "16" || $mmines == "17" || $mmines == "18" || $mmines == "19" || $mmines == "20" || $mmines == "21" || $mmines == "22" || $mmines == "23" || $mmines == "24" || $mmines == "25"){
        $mines = unserialize($mines);
        if ($minesgame != null){
            $bombs1 = [1.04, 1.09, 1.14, 1.19, 1.25, 1.32, 1.39, 1.47, 1.56, 1.67, 1.79, 1.92, 2.08, 2.27, 2.50, 2.78, 3.12, 3.57, 4.17, 5.00, 6.25, 8.33, 12.50, 25.00];
            $bombs2 = [1.09, 1.19, 1.3, 1.43, 1.58, 1.75, 1.96, 2.21, 2.5, 2.86, 3.3, 3.85, 4.55, 5.45, 6.67, 8.33, 10.71, 14.29, 20, 30, 50, 100, 300];
            $bombs3 = [1.14, 1.3, 1.49, 1.73, 2.02, 2.37, 2.82, 3.38, 4.11, 5.05, 6.32, 8.04, 10.45, 13.94, 19.17, 27.38, 41.07, 65.71, 115, 230, 575, 2300];
            $bombs4 = [1.19, 1.43, 1.73, 2.11, 2.61, 3.26, 4.13, 5.32, 6.95, 9.27, 12.64, 17.69, 25.56, 38.33, 60.24, 100.4, 180.71, 361.43, 843.33, 2530, 12650];
            $bombs5 = [1.25, 1.58, 2.02, 2.61, 3.43, 4.57, 6.2, 8.59, 12.16, 17.69, 26.54, 41.28, 67.08, 115, 210.83, 421.67, 948.75, 2530, 8855, 53130];
            $bombs6 = [1.32, 1.75, 2.37, 3.26, 4.57, 6.53, 9.54, 14.31, 22.12, 35.38, 58.97, 103.21, 191.67, 383.33, 843.33, 2108.33];
            $bombs7 = [1.39, 1.96, 2.82, 4.13, 6.2, 9.54, 15.1, 24.72, 42.02, 74.7, 140.06, 280.13, 606.94, 1456.67, 4005.83, 13352.78];
            $bombs8 = [1.47, 2.21, 3.38, 5.32, 8.59, 14.31, 24.72, 44.49, 84.04, 168.08, 360.16, 840.38, 2185, 6555, 24035, 120175, 1081575];
            $bombs9 = [1.56, 2.5, 4.11, 6.95, 12.16, 22.12, 42.02, 84.04, 178.58, 408.19, 1020.47, 2857.31, 9286.25, 37145, 204297.5, 2042975];
            $bombs10 = [1.67, 2.86, 5.05, 9.27, 17.69, 35.38, 74.7, 168.08, 408.19, 1088.5, 3265.49, 11429.23, 49526.67, 297160, 3268760];
            $bombs11 = [1.79, 3.3, 6.32, 12.64, 26.54, 58.97, 140.06, 360.16, 1020.47, 3265.49, 12245.6, 57146.15, 371450, 4457400];
            $bombs12 = [1.92, 3.85, 8.04, 17.69, 41.28, 103.21, 280.13, 840.38, 2857.31, 11429.23, 57146.15, 400023.08, 5200300];
            $bombs13 = [2.08, 4.55, 10.45, 25.56, 67.08, 191.67, 606.94, 2185, 9286.25, 49526.67, 371450, 5200300];
            $bombs14 = [2.27, 5.45, 13.94, 38.33, 115, 383.33, 1456.67, 6555, 37145, 297160, 4457400];
            $bombs15 = [2.5, 6.67, 19.17, 60.24, 210.83, 843.33, 4005.83, 24035, 204297.5, 3268760];
            $bombs16 = [2.78, 8.33, 27.38, 100.4, 421.67, 2108.33, 13352.78, 120175, 2042975];
            $bombs17 = [3.13, 10.71, 41.07, 180.71, 948.75, 6325, 60087.5, 1081575];
            $bombs18 = [3.57, 14.29, 65.71, 361.43, 2530, 25300, 480700];
            $bombs19 = [4.17, 20, 115, 843.33, 8855, 177100];
            $bombs20 = [5, 30, 230, 2530, 53130];
            $bombs21 = [6.25, 50, 575, 12650];
            $bombs22 = [8.33, 100, 2300];
            $bombs23 = [12.5, 300];
            $bombs24 = [25];

            // для работы с антиминусом
            $query = ("SELECT * FROM `admin_mines`");
            $row_admin = mysql_query($query);
            $admin = mysql_fetch_array($row_admin);

            $bank = $admin['bank'];

            $query = ("SELECT * FROM `mines` WHERE `id_users` = '$id' AND `onOff` = '1'");
            $ro = mysql_query($query);
            $adm = mysql_fetch_array($ro);

            $game_id = $adm['id'];

            if (in_array($mmines, $click) == false){
                if (in_array($mmines, $mines)){
                    //тут есть бомба, игра проиграна
                    $click[] = $mmines;
                    $click = serialize($click);

                    $query = ("UPDATE `mines` SET `click` = '$click' WHERE `id_users` = '$id' AND `onOff` = '1'");
                    mysql_query($query);

                    $time = date('d.m Y');
                    mysql_query("INSERT INTO `dice` (`user_id`, `bet`, `chance`, `win`, `create_at`, `game`, `coef`) VALUES ('$id', '$bet', '$caef', '0', '$time', 'Mines', '0')");

                    $query = ("UPDATE `mines` SET `onOff` = '2' WHERE `id_users` = '$id'"); //отключаем игру.
                    mysql_query($query);

                    // для работы с антиминусом
                    $query = ("SELECT * FROM `admin_mines`");
                    $row_admin = mysql_query($query);
                    $admin = mysql_fetch_array($row_admin);

                    $bank = $admin['bank'];
                    $profit = $admin['zarabotok'];
                    $profit1 = $bet * $komissia;
                    $bank1 = $bet * (1 - $komissia);
                    $query = mysql_query("UPDATE `admin_mines` SET `bank`= '$bank'+'$bank1',`zarabotok`='$profit'+'$profit1'");

                    $tamines = json_encode($mines);

                    $saad = "<span class='number result-lose result'><span class='myBetsBox'>" . $bet . "</span> <i class='fas fa-coins'></i></span>";
                    $obj = array(
                        "info" => "click",
                        "game_id" => "$game_id",
                        "bombs" => "true",
                        "pressmine" => "$mmines",
                        "tamines" => "$tamines",
                        "bet" => "$bet",
                        "site_vault" => "$site_vault",
                        "resultHistoryContentBomb" => "$saad"
                    );
                }else{
                    $query = ("SELECT * FROM `admin_mines`");
                    $row_admin = mysql_query($query);
                    $admin = mysql_fetch_array($row_admin);

                    $bank = $admin['bank'];
                    $win = $win - $bet;
                  //  if ($win < $bank){
                    
                    $bet11 = $minesgame['bet'];
                    $win11 = $minesgame['win'];
                    $cc = $win11 / $bet11;
                    if ($cc < $max_mines){
                        //тут нет бомбы, все четко...
                        $query = ("UPDATE `mines` SET `step` = '$step' + 1 WHERE `id_users` = '$id' AND `onOff` = '1'");
                        mysql_query($query);
                        if ($num_mines == "1"){
                            $win = $bet * $bombs1[$step];
                        }
                        if ($num_mines == "2"){
                            $win = $bet * $bombs2[$step];
                        }
                        if ($num_mines == "3"){
                            $win = $bet * $bombs3[$step];
                        }
                        if ($num_mines == "4"){
                            $win = $bet * $bombs4[$step];
                        }
                        if ($num_mines == "5"){
                            $win = $bet * $bombs5[$step];
                        }
                        if ($num_mines == "6"){
                            $win = $bet * $bombs6[$step];
                        }
                        if ($num_mines == "7"){
                            $win = $bet * $bombs7[$step];
                        }
                        if ($num_mines == "8"){
                            $win = $bet * $bombs8[$step];
                        }
                        if ($num_mines == "9"){
                            $win = $bet * $bombs9[$step];
                        }
                        if ($num_mines == "10"){
                            $win = $bet * $bombs10[$step];
                        }
                        if ($num_mines == "11"){
                            $win = $bet * $bombs11[$step];
                        }
                        if ($num_mines == "12"){
                            $win = $bet * $bombs12[$step];
                        }
                        if ($num_mines == "13"){
                            $win = $bet * $bombs13[$step];
                        }
                        if ($num_mines == "14"){
                            $win = $bet * $bombs14[$step];
                        }
                        if ($num_mines == "15"){
                            $win = $bet * $bombs15[$step];
                        }
                        if ($num_mines == "16"){
                            $win = $bet * $bombs16[$step];
                        }
                        if ($num_mines == "17"){
                            $win = $bet * $bombs17[$step];
                        }
                        if ($num_mines == "18"){
                            $win = $bet * $bombs18[$step];
                        }
                        if ($num_mines == "19"){
                            $win = $bet * $bombs19[$step];
                        }
                        if ($num_mines == "20"){
                            $win = $bet * $bombs20[$step];
                        }
                        if ($num_mines == "21"){
                            $win = $bet * $bombs21[$step];
                        }
                        if ($num_mines == "22"){
                            $win = $bet * $bombs22[$step];
                        }
                        if ($num_mines == "23"){
                            $win = $bet * $bombs23[$step];
                        }
                        if ($num_mines == "24"){
                            $win = $bet * $bombs24[$step];
                        }

                        //кол-во криссталов
                        $gem_number = 24 - $num_mines - $step;

                        $query = ("UPDATE `mines` SET `win` = '$win' WHERE `id_users` = '$id' AND `onOff` = '1'");
                        mysql_query($query);

                        $click[] = $mmines;
                        $click = serialize($click);

                        $query = ("UPDATE `mines` SET `click` = '$click' WHERE `id_users` = '$id' AND `onOff` = '1'");
                        mysql_query($query);
                        if ($num_mines == 1){
                            $nextCoef = $bombs1[$step + 1];
                        }
                        if ($num_mines == 2){
                            $nextCoef = $bombs2[$step + 1];
                        }
                        if ($num_mines == 3){
                            $nextCoef = $bombs3[$step + 1];
                        }
                        if ($num_mines == 4){
                            $nextCoef = $bombs4[$step + 1];
                        }
                        if ($num_mines == 5){
                            $nextCoef = $bombs5[$step + 1];
                        }
                        if ($num_mines == 6){
                            $nextCoef = $bombs6[$step + 1];
                        }
                        if ($num_mines == 7){
                            $nextCoef = $bombs7[$step + 1];
                        }
                        if ($num_mines == 8){
                            $nextCoef = $bombs8[$step + 1];
                        }
                        if ($num_mines == 9){
                            $nextCoef = $bombs9[$step + 1];
                        }
                        if ($num_mines == 10){
                            $nextCoef = $bombs10[$step + 1];
                        }
                        if ($num_mines == 11){
                            $nextCoef = $bombs11[$step + 1];
                        }
                        if ($num_mines == 12){
                            $nextCoef = $bombs12[$step + 1];
                        }
                        if ($num_mines == 13){
                            $nextCoef = $bombs13[$step + 1];
                        }
                        if ($num_mines == 14){
                            $nextCoef = $bombs14[$step + 1];
                        }
                        if ($num_mines == 15){
                            $nextCoef = $bombs15[$step + 1];
                        }
                        if ($num_mines == 16){
                            $nextCoef = $bombs16[$step + 1];
                        }
                        if ($num_mines == 17){
                            $nextCoef = $bombs17[$step + 1];
                        }
                        if ($num_mines == 18){
                            $nextCoef = $bombs18[$step + 1];
                        }
                        if ($num_mines == 19){
                            $nextCoef = $bombs19[$step + 1];
                        }
                        if ($num_mines == 20){
                            $nextCoef = $bombs20[$step + 1];
                        }
                        if ($num_mines == 21){
                            $nextCoef = $bombs21[$step + 1];
                        }
                        if ($num_mines == 22){
                            $nextCoef = $bombs22[$step + 1];
                        }
                        if ($num_mines == 23){
                            $nextCoef = $bombs23[$step + 1];
                        }
                        if ($num_mines == 24){
                            $nextCoef = $bombs24[$step + 1];
                        }
                        $rdr = "<span class='number result-win result'><span class='myBetsBox'>" . $win . "</span> <i class='fas fa-coins'></i></span>";
                        $obj = array(
                            "info" => "click",
                            "bombs" => "false",
                            "step" => $step + 1,
                            "pressmine" => "$mmines",
                            "win" => "$win",
                            "gem" => "$gem_number",
                            "nextX" => "$nextCoef",
                            "bet" => "$bet",
                            "site_vault" => "$site_vault",                            
                            "resultHistoryContentBomb" => "$rdr"
                        );
                    }else{
                        //создаем проигрышный вариант игры
                        $query = ("SELECT * FROM `mines` WHERE `id_users` = '$id' AND `onOff` = '1'");
                        $result55 = mysql_query($query);
                        $minesgame1 = mysql_fetch_array($result55);
                        $game_id = $minesgame1['id'];
                        $click = $minesgame1['click'];
                        $step = $minesgame1['step'];
                        $num_mines = $minesgame1['num_mines'];
                        $resultgame = $minesgame1['result'];
                        $onOff = $minesgame1['onOff'];
                        $click = unserialize($click);

                        //создаем новый массив, нужно учесть значения click
                        $query = ("SELECT * FROM `admin_mines`");
                        $row_admin = mysql_query($query);
                        $admin = mysql_fetch_array($row_admin);

                        $bank = $admin['bank'];
                        $profit = $admin['zarabotok'];
                        $bet = $bet * (1 - $komissia);
                        $profit1 = $bet * $komissia;
                        $query = mysql_query("UPDATE `admin_mines` SET `bank`='$bank'+'$bet',`zarabotok`='$profit'+'$profit1'");

                        $mines = [];
                        $mines[] = $mmines;
                        while (count($mines) < $num_mines){
                            $rand = mt_rand(1, 25);
                            if (in_array($rand, $click)){
                            }else{
                                if (in_array($rand, $mines) == false){
                                    $mines[] = $rand;
                                }
                            }
                        }

                        $mines = serialize($mines);
                        $query = mysql_query("UPDATE `mines` SET `mines` = '$mines',`onOff`= '2',`loseBombs`='$mmines' WHERE `id_users` = '$id' AND `onOff` = '1'");
                        $mines = unserialize($mines);
                        $tamines = json_encode($mines);

                        $query = ("UPDATE `mines` SET `onOff` = '2' WHERE `id_users` = '$id'"); //отключаем игру.
                        mysql_query($query);

                        $saad = "<span class='number result-lose result'><span class='myBetsBox'>" . $bet . "</span> <i class='fas fa-coins'></i></span>";
                        $obj = array(
                            "info" => "click",
                            "game_id" => "$game_id",
                            "bombs" => "true",
                            "pressmine" => "$mmines",
                            "tamines" => "$tamines",
                            "bet" => "$bet",
                            "site_vault" => "$site_vault",                            
                            "resultHistoryContentBomb" => "$saad"
                        );
                    } 
                }
} else {
    $obj = array("info" => "warning", "warning" => "Вы уже выбрали это поле!");
}
} else {
    $obj = array("info" => "warning", "warning" => "Чтобы выбрать ячейки, создайте игру!");
}
} else {
    $obj = array("info" => "warning", "warning" => "Произошла ошибка $mmines !");
}
}

/*if (isset($_POST['live'])){
    $query = ("SELECT * FROM `mines` WHERE `onOff`= '2' ORDER BY `id` DESC LIMIT 10");
    $result = mysql_query($query);
    while (($minesHistory = mysql_fetch_array($result))){

        $idgameHistory = $minesHistory['id'];
        $idusersHistory = $minesHistory['id_users'];
        $nameHistory = $minesHistory['login'];
        $betHistory = $minesHistory['bet'];
        $bombsHistory = $minesHistory['num_mines'];
        $resultHistory = $minesHistory['result'];
        if ($minesHistory['win'] != "0"){
            $resultHistory = $minesHistory['win'];
        }
        if ($minesHistory['win'] != 0){
            $color = "win";
        }else{
            $color = "lose";
        }

        $h .= "
                        <tr onclick='openMines($idgameHistory)' style='cursor: pointer'>
                        <td ><i class='fas fa-user-circle'  onclick ='openProfile($idusersHistory)' style='cursor: pointer'></i> <span>" . $nameHistory . "</span></td>
                        <td><span>" . $betHistory . "</span> <i class='fa fa-coins'></i></td>
                        <td><span>" . $bombsHistory . "</span> <i class='fa fa-bomb'></i></td>
                        <td class='result-" . $color . "'><span>" . $resultHistory . "</span> <i class='fa fa-coins'></i></td>
                        </tr>";
    }
    $obj = array(
        "live" => "$h"
    );
}*/
if (isset($_POST['openMines'])){
    $idMines = $_POST['idMines'];

    $query = ("SELECT * FROM `mines` WHERE `id`='$idMines' AND `onOff`='2'");
    $result4445 = mysql_query($query);
    $row5554 = mysql_fetch_array($result4445);

    if ($row5554){
        $clickOpen = $row5554['click'];
        $clickOpen = unserialize($clickOpen);
        $idbetMines = $row5554['bet'];
        $winminesOpen = $row5554['win'];
        $loseBomb = $row5554['loseBombs'];
        $loginMinesOpen = $row5554['login'];
        $coefMinesOpen = $winminesOpen / $idbetMines;
        $idUsersOpenMines = $row5554["id_users"];
        $minesclickopen = [];

        for ($i = 1;$i < 26;$i++){
            if (in_array($i, $clickOpen)){
                array_push($minesclickopen, '<button class="mine win-mine openMines" data-number="' . $i . '" disabled="disabled"><i class="fas fa-gem" style="font-size: 25px;"></i></button>');
            }else{
                array_push($minesclickopen, '<button class="mine openMines" data-number="' . $i . '"></button>');
            }
        }
    }
    $minesclickopen = json_encode($minesclickopen);
    $obj = array(
        "result" => "true",
        "minesopen" => "$minesclickopen",
        "idbetMines" => "$idbetMines",
        "winminesOpen" => "$winminesOpen",
        "coefMinesOpen" => "х$coefMinesOpen",
        "loseBomb" => "$loseBomb",
        "loginMinesOpen" => "$loginMinesOpen",
        "idUsersOpen" => "$idUsersOpenMines"
    );
}

if($_POST['getRate']) {
    if(!$sid) return;
    $game = mysql_query("SELECT * FROM `mines` WHERE `id_users` = '$id' AND `onOff` = '1'");
    $row = mysql_fetch_array($game);
    if(!$row) return;
    if($row) {
        $click = unserialize($row['click']);
        $step = $row['step'];
        $bombs = $row['num_mines'];
        $bet = $row['bet'];
    }
    $bombs1 = [1.04, 1.09, 1.14, 1.19, 1.25, 1.32, 1.39, 1.47, 1.56, 1.67, 1.79, 1.92, 2.08, 2.27, 2.50, 2.78, 3.12, 3.57, 4.17, 5.00, 6.25, 8.33, 12.50, 25.00];    
    $bombs2 = [1.09, 1.19, 1.3, 1.43, 1.58, 1.75, 1.96, 2.21, 2.5, 2.86, 3.3, 3.85, 4.55, 5.45, 6.67, 8.33, 10.71, 14.29, 20, 30, 50, 100, 300];
    $bombs3 = [1.14, 1.3, 1.49, 1.73, 2.02, 2.37, 2.82, 3.38, 4.11, 5.05, 6.32, 8.04, 10.45, 13.94, 19.17, 27.38, 41.07, 65.71, 115, 230, 575, 2300];
    $bombs4 = [1.19, 1.43, 1.73, 2.11, 2.61, 3.26, 4.13, 5.32, 6.95, 9.27, 12.64, 17.69, 25.56, 38.33, 60.24, 100.4, 180.71, 361.43, 843.33, 2530, 12650];
    $bombs5 = [1.25, 1.58, 2.02, 2.61, 3.43, 4.57, 6.2, 8.59, 12.16, 17.69, 26.54, 41.28, 67.08, 115, 210.83, 421.67, 948.75, 2530, 8855, 53130];
    $bombs6 = [1.32, 1.75, 2.37, 3.26, 4.57, 6.53, 9.54, 14.31, 22.12, 35.38, 58.97, 103.21, 191.67, 383.33, 843.33, 2108.33];
    $bombs7 = [1.39, 1.96, 2.82, 4.13, 6.2, 9.54, 15.1, 24.72, 42.02, 74.7, 140.06, 280.13, 606.94, 1456.67, 4005.83, 13352.78];
    $bombs8 = [1.47, 2.21, 3.38, 5.32, 8.59, 14.31, 24.72, 44.49, 84.04, 168.08, 360.16, 840.38, 2185, 6555, 24035, 120175, 1081575];
    $bombs9 = [1.56, 2.5, 4.11, 6.95, 12.16, 22.12, 42.02, 84.04, 178.58, 408.19, 1020.47, 2857.31, 9286.25, 37145, 204297.5, 2042975];
    $bombs10 = [1.67, 2.86, 5.05, 9.27, 17.69, 35.38, 74.7, 168.08, 408.19, 1088.5, 3265.49, 11429.23, 49526.67, 297160, 3268760];
    $bombs11 = [1.79, 3.3, 6.32, 12.64, 26.54, 58.97, 140.06, 360.16, 1020.47, 3265.49, 12245.6, 57146.15, 371450, 4457400];
    $bombs12 = [1.92, 3.85, 8.04, 17.69, 41.28, 103.21, 280.13, 840.38, 2857.31, 11429.23, 57146.15, 400023.08, 5200300];
    $bombs13 = [2.08, 4.55, 10.45, 25.56, 67.08, 191.67, 606.94, 2185, 9286.25, 49526.67, 371450, 5200300];
    $bombs14 = [2.27, 5.45, 13.94, 38.33, 115, 383.33, 1456.67, 6555, 37145, 297160, 4457400];
    $bombs15 = [2.5, 6.67, 19.17, 60.24, 210.83, 843.33, 4005.83, 24035, 204297.5, 3268760];
    $bombs16 = [2.78, 8.33, 27.38, 100.4, 421.67, 2108.33, 13352.78, 120175, 2042975];
    $bombs17 = [3.13, 10.71, 41.07, 180.71, 948.75, 6325, 60087.5, 1081575];
    $bombs18 = [3.57, 14.29, 65.71, 361.43, 2530, 25300, 480700];
    $bombs19 = [4.17, 20, 115, 843.33, 8855, 177100];
    $bombs20 = [5, 30, 230, 2530, 53130];
    $bombs21 = [6.25, 50, 575, 12650];
    $bombs22 = [8.33, 100, 2300];
    $bombs23 = [12.5, 300];
    $bombs24 = [25];

                        if ($num_mines == "1"){
                            $win = $bet * $bombs1[$step-1];
                        }            
                        if ($num_mines == "2"){
                            $win = $bet * $bombs2[$step-1];
                        }
                        if ($num_mines == "3"){
                            $win = $bet * $bombs3[$step-1];
                        }
                        if ($num_mines == "4"){
                            $win = $bet * $bombs4[$step-1];
                        }
                        if ($num_mines == "5"){
                            $win = $bet * $bombs5[$step-1];
                        }
                        if ($num_mines == "6"){
                            $win = $bet * $bombs6[$step-1];
                        }
                        if ($num_mines == "7"){
                            $win = $bet * $bombs7[$step-1];
                        }
                        if ($num_mines == "8"){
                            $win = $bet * $bombs8[$step-1];
                        }
                        if ($num_mines == "9"){
                            $win = $bet * $bombs9[$step-1];
                        }
                        if ($num_mines == "10"){
                            $win = $bet * $bombs10[$step-1];
                        }
                        if ($num_mines == "11"){
                            $win = $bet * $bombs11[$step-1];
                        }
                        if ($num_mines == "12"){
                            $win = $bet * $bombs12[$step-1];
                        }
                        if ($num_mines == "13"){
                            $win = $bet * $bombs13[$step-1];
                        }
                        if ($num_mines == "14"){
                            $win = $bet * $bombs14[$step-1];
                        }
                        if ($num_mines == "15"){
                            $win = $bet * $bombs15[$step-1];
                        }
                        if ($num_mines == "16"){
                            $win = $bet * $bombs16[$step-1];
                        }
                        if ($num_mines == "17"){
                            $win = $bet * $bombs17[$step-1];
                        }
                        if ($num_mines == "18"){
                            $win = $bet * $bombs18[$step-1];
                        }
                        if ($num_mines == "19"){
                            $win = $bet * $bombs19[$step-1];
                        }
                        if ($num_mines == "20"){
                            $win = $bet * $bombs20[$step-1];
                        }
                        if ($num_mines == "21"){
                            $win = $bet * $bombs21[$step-1];
                        }
                        if ($num_mines == "22"){
                            $win = $bet * $bombs22[$step-1];
                        }
                        if ($num_mines == "23"){
                            $win = $bet * $bombs23[$step-1];
                        }
                        if ($num_mines == "24"){
                            $win = $bet * $bombs24[$step-1];
                        }        
    $obj = array(
        'status' => 1, 
        'click' => $click, 
        'coef' => $win
    );
}

echo json_encode($obj);
?>
