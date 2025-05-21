<?php
session_start();
$sid = $_SESSION['hash'];
require ("system/config.php");
$type = $_POST['type'];
$error = 0;
$fa = "";

////////////////////////////////////////////////////
if($type == "minesnew") {
    //  $id = $_POST['id'];
    $arr = [];
    $sql_select = "SELECT * FROM `users` WHERE hash='$sid'";
    $result = mysql_query($sql_select);
    $row = mysql_fetch_array($result);
    $id = $row['id'];
    $sql_select = "SELECT * FROM `mines` WHERE id_users='$id' and onOff = '1'";
    $result = mysql_query($sql_select);
    $row = mysql_fetch_array($result);
    $bet = $row['bet'];
    $win = $row['win'];
    $mines = unserialize($mines);
    $click = $row['click'];
    $click = unserialize($click);
    $click = array_map('intval', $click);
    $caef = $win / $bet;
    $mines = json_encode($mines);
    $click = json_encode($click);              
    $result = array(
	'success' => "success",
    'mines_id' => "$id",
    'bet' => "$bet",
    'win' => "$win",
    'click' => $click,
    );
}

/////////////GAMES-END/////////////////////
if($type == "autoselect_mines"){
	$sql_select = "SELECT * FROM `users` WHERE hash='$sid'";
    $result = mysql_query($sql_select);
    $row = mysql_fetch_array($result);
    $id = $row['id'];
    $query = ("SELECT * FROM `mines` WHERE id_users = '$id' AND onOff = '1'");
    $result = mysql_query($query);
    $games = mysql_fetch_array($result);

if($games) {
    $click = $games['click'];
    $click = unserialize($click);
    $select = mt_rand(1,25);

if(in_array($select,$click)) {
      
while(in_array($select,$click)) {
    $select = mt_rand(1,25);
   }
}
$fa = "true";
    }else{
$fa = "false";
$error = "Игра не существует";
    }

  $result = array(
  'success'=>"$fa",
  'mess'=>"$error",
  'select'=>"$select"
  );
    
}
/////////////////////////////////////////////
if ($type == "withdrawuser")
{
    $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
    $result2 = mysql_query($sql_select2);
    $row = mysql_fetch_array($result2);
    if ($row)
    {
        $user_id = $row['id'];
        $login = $row['login'];
        $ban = $row['ban'];
        $balance = $row['balance'];
        
    }
    $sql_select23 = "SELECT SUM(suma) FROM deposits WHERE user_id='$user_id'";
    $result23 = mysql_query($sql_select23);
    $row = mysql_fetch_array($result23);
    if ($row)
    {
        $sumdep = $row['SUM(suma)'];
    }
    if ($sumdep == '')
    {
        $sumdep = 0;
    }
    $wallet = $_POST['wallet'];
    $sum = $_POST['sum'];
    $systemw = $_POST['system'];
    $sbpnaming = $_POST['sbpbank'];
    $dwallet = strlen($wallet);

if($systemw == 'fkwallet'){
   if($sum < $min_withdraw_sum){
        $error = 77;
        $mess = "Минимальная сумма выплаты на FKWallet - $min_withdraw_sum";
        $fa = "error";       
   }
}
if($systemw == 'sbp'){
   if($sum < 1000){
        $error = 77;
        $mess = "Минимальная сумма выплаты на СБП - 1000";
        $fa = "error";       
   }
}
if($systemw == 'bank_ru'){
   if($sum < 1500){
        $error = 77;
        $mess = "Минимальная сумма выплаты на Банк. карты - 1500";
        $fa = "error";       
   }
}

    if ($wallet == '' || $sum == '')
    {
        $error = 2;
        $mess = "Необходимо заполнить все поля!";
        $fa = "error";
    }
    if ($sum > $balance)
    {
        $error = 3;
        $mess = "У Вас недостаточно средств!";
        $fa = "error";
    }
    if ($ban == 1)
    {
        $error = 4;
        $mess = "Ваш аккаунт заблокирован";
        $fa = "error";
    }
    if ($sum != '' && $wallet != '')
    {
        if (!is_numeric($sum))
        {
            $error = 5;
            $mess = "Введите корректную сумму";
            $fa = "error";
        }
        if ($dwallet < 8)
        {
            $error = 6;
            $mess = "Длинна кошелька не может быть меньше 8 символов";
            $fa = "error";
        }

     /*   if ($sum < $min_sum)
        {
            $error = 6;
            $mess = "Минимальная сумма на данный способ $min_sum монет";
            $fa = "error";
        }*/
        if (!preg_match("#^[aA-zZ0-9\-_.]+$#", $sum))
        {
            $mess = "Недопустимые символы в сумме";
            $fa = "error";
            $error = 7;
        }
        if (!preg_match("#^[+0-9Ff]+$#", $wallet))
        {
            $mess = "Недопустимые символы в кошельке";
            $fa = "error";
            $error = 8;
        }
        if ($sumdep < $dep_withdraw)
        {
            $mess = "Для вывода средств у вас должно быть пополнений на сумму $dep_withdraw";
            $error = 9;
            $fa = "error";

        }
        if ($wagers > 0)
        {
            $mess = "Вам нужно отыграть $wagers что бы создавать выплаты.";
            $error = 10;
            $fa = "error";

        }
      
        if ($systemw == NULL)
        {
            $mess = "Выберите систему вывода";
            $error = 11;
            $fa = "error";
        }
    }
    if (!$sid)
    {
        $error = 12;
        $mess = "Необходима авторизация!";
        $fa = "error";
    }  


    if ($error == 0)
    {
        $summ = round($sum, 2);
        $summnew = ($summ / 100) * 97;
        $newbalance = $balance - $sum;
        $datas = date("d.m.Y");
        $datass = date("H:i:s");
        $data = "$datas $datass";
        $insert_sql11 = "INSERT INTO `withdraws` (`id`, `user_id`, `ps`, `wallet`, `sum`, `date`, `status`, `banksbp`) VALUES (NULL, '$user_id', '$systemw', '$wallet', '$summnew', '$data', '0', '$sbpnaming');";
        mysql_query($insert_sql11);
        $update_sql1 = "UPDATE users SET balance = '$newbalance' WHERE hash = '$sid'";
        mysql_query($update_sql1);
        
$sql_select5 = "SELECT * FROM withdraws WHERE user_id = '$user_id' ORDER BY id + 0 DESC LIMIT 1";
$result5 = mysql_query($sql_select5);
while($row = mysql_fetch_array($result5)) {
$id_with = $row['id'];
}
        
        $fa = "success";
    }

    $result = array(
        'success' => "$fa",
        'error' => "$mess",
        'balance' => "$balance",
        'id_with' => "$id_with",
        'new_balance' => "$newbalance"
    );
}
/////////////////////////////////////////////
if ($type == "deletewithdraw")
{
    $id_delete = $_POST['del'];
    $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
    $result2 = mysql_query($sql_select2);
    $row = mysql_fetch_array($result2);
    if ($row)
    {
        $user_id = $row['id'];
        $login = $row['login'];
        $ban = $row['ban'];
        $balance = $row['balance'];
    }
    $sql_select3 = "SELECT * FROM withdraws WHERE id='$id_delete'";
    $result3 = mysql_query($sql_select3);
    $row = mysql_fetch_array($result3);
    if ($row)
    {
        $user_id_w = $row['user_id'];
        $sum = $row['sum'];
        $status = $row['status'];
    }
    if ($status != 0)
    {
        $error = 1;
        $mess = "Выплата в процессе";
        $fa = "error";
    }
    if ($user_id != $user_id_w)
    {
        $error = 2;
        $mess = "Ошибка соединения с сервером!";
        $fa = "error";
    }
    if (!$sid)
    {
        $error = 3;
        $mess = "Необходима авторизация!";
        $fa = "error";
    }      
    if ($error == 0)
    {
        $delete = "DELETE FROM `withdraws` WHERE id = '$id_delete'";
        mysql_query($delete);
        $summsa = ($sum * 100) / 97;
        $newbalance = $balance + $summsa;
        $update_sql1 = "UPDATE users SET balance = '$newbalance' WHERE hash = '$sid'";
        mysql_query($update_sql1);
        $fa = "success";
    }
    $result = array(
        'success' => "$fa",
        'error' => "$mess",
        'balance' => "$balance",
        'new_balance' => "$newbalance"
    );
}
/////////////////////////////////////////////
if ($type == "vkRepost")
{
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
    $result = mysql_query($sql_select);
    $row = mysql_fetch_array($result);
    if ($row)
    {
        $balance = $row['balance'];
        $vbonus1 = $row['vkrep'];
    }
    if ($vbonus1 == 1)
    {
        $error = 1;
        $fa = "error";
        $mess = "Вы уже получали данный вид бонуса";
    }
    if (!$sid)
    {
        $error = 2;
        $mess = "Необходима авторизация!";
        $fa = "error";
    }
    if ($error == 0)
    {
        $randomb = $vkrepostsize;
        $balancenew = $balance + $randomb;
        $summavkre = $randomb * $coefbonus;
        $vkbonusrep = $wager + $summavkre;
        $update_sql = "Update users set balance='$balancenew', wager='$vkbonusrep' WHERE hash='$sid'";
        mysql_query($update_sql) or die("Ошибка вставки" . mysql_error());
        $update_sql12 = "Update users set vkrep='1' WHERE hash='$sid'";
        mysql_query($update_sql12) or die("Ошибка вставки" . mysql_error());
        $fa = "success";
    }
    $result = array(
        'success' => "$fa",
        'error' => "$mess",
        'balance' => "$balance",
        'new_balance' => "$balancenew",
        'repost_url' => "$repostUrl",
        'bonussize' => "$randomb",
    );
}
/////////////////////////////////////////////
if ($type == "vkBonus")
{
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
    $result = mysql_query($sql_select);
    $row = mysql_fetch_array($result);
    if ($row)
    {
        $balance = $row['balance'];
        $vk = $row['social'];
        $vbonus = $row['vkb'];
    }
    if ($vbonus == 1)
    {
        $error = 1;
        $fa = "error";
        $mess = "Вы уже получали данный вид бонуса";
    }
    $vk_id = substr($vk, -9);

    $vk1 = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=$vk_id&access_token=$vkgrouptoken&v=5.81"));
    $vk1 = $vk1->response[0]->id;
    $resp = file_get_contents("https://api.vk.com/method/groups.isMember?group_id=$vkgoupid&user_id={$vk1}&access_token=$vkgrouptoken&v=5.81");
    $data = json_decode($resp, true);
    $data = json_decode($resp, true);
    if ($data['response'] == '0')
    {
        $error = 3;
        $fa = "error";
        $mess = "Вы не подписаны на группу $sitename";
    }
    if (!$sid)
    {
        $error = 5;
        $mess = "Необходима авторизация!";
        $fa = "error";
    }    
    if ($error == 0)
    {
        $randomb = $vkgroupsize;
        $balancenew = $balance + $randomb;
        $summavksub = $randomb * $coefbonus;
        $vkbonussubs = $wager + $summavksub;
        $update_sql = "Update users set balance='$balancenew', wager='$vkbonussubs' WHERE hash='$sid'";
        mysql_query($update_sql) or die("Ошибка вставки" . mysql_error());
        $update_sql1 = "Update users set vkb='1' WHERE hash='$sid'";
        mysql_query($update_sql1) or die("Ошибка вставки" . mysql_error());
        $fa = "success";
    }
    $result = array(
        'success' => "$fa",
        'error' => "$mess",
        'balance' => "$balance",
        'new_balance' => "$balancenew",
        'bonussize' => "$randomb"
    );
}
/////////////////////////////////////////////
if ($type == "deposit")
{
    $system = $_POST['system'];
    $summa = $_POST['sum'];
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
    $result = mysql_query($sql_select);
    $row = mysql_fetch_array($result);
    if ($row)
    {
        $bala = $row['balance'];
        $user_id = $row['id'];
    }
  
    if (!$system)
    {
        $error = 1;
        $mess = "Выбери систему оплаты";
        $fa = "error";
    }
    if ($summa == NULL)
    {
        $error = 2;
        $mess = "Введите сумму";
        $fa = "error";
    }
    if ($summa < $min_sum_dep)
    {
        $error = 3;
        $mess = "Минимальная сумма пополнения $min_sum_dep";
        $fa = "error";
    }
    if (!$sid)
    {
        $error = 25;
        $mess = "Необходима авторизация!";
        $fa = "error";
    }  

if($system == 1){
    
if ($error == 0)
{


    $merchant_id = $fkid;
    $secret_word = $fks1;
$order_id = rand(100000000000, 900000000000); 
    $order_amount = $summa;
    $currency = 'RUB';
    $sign5 = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$currency.':'.$order_id);

$link = "https://pay.freekassa.com/?m=".$merchant_id."&oa=".$order_amount."&i=&currency=RUB&em=&phone=&o=".$order_id."&pay=PAY&us_id=".$user_id."&s=".$sign5."";
$fa = "success";
}

} 

if($system == 2){
    
if ($error == 0)
{
$m_id = $lpid;
$m_secret_1 = $lps1;
$amount = $summa; 
$order_id = rand(100000000000, 900000000000); 
$us_id = $user_id;
$sign = md5($m_id.'|'.$m_secret_1.'|'.$amount.'|'.$order_id);
$link = "https://linepay.fun/pay?order_id=".$order_id."&m_id=".$m_id."&amount=".$amount."&us_key=".$us_id."&sign=".$sign;
$fa = "success";
}

}    
    $result = array(
        'success' => "$fa",
        'locations' => "$link",
        'error' => "$mess"
    );
}
/////////////////////////////////////////////
if ($type == "bonus")
{
    $selecter1 = "SELECT * FROM users WHERE hash = '$sid'";
    $result4 = mysql_query($selecter1);
    $row = mysql_fetch_array($result4);
    if ($row)
    {
        $id = $row['id'];
    }
    $time = time();
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
    $result = mysql_query($sql_select);
    $row = mysql_fetch_array($result);
    if ($row)
    {
        $bonus = $row['bdate'];
        $balance = $row['balance'];
        $vk = $row['social'];
    }
    $vk_id = substr($vk, -9);
    $seconds = $time - $bonus;
    $seconds = 86400 - $seconds;
    $minutes1 = floor($seconds / 60); // Считаем минуты
    $hours = floor($minutes / 60); // Считаем количество полных часов
    $minutes2 = $minutes1 - ($hours * 60); // Считаем количество оставшихся минут
    $vk1 = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=$vk_id&access_token=$vkgrouptoken&v=5.81"));
    $vk1 = $vk1->response[0]->id;
    $resp = file_get_contents("https://api.vk.com/method/groups.isMember?group_id=$vkgoupid&user_id={$vk1}&access_token=$vkgrouptoken&v=5.81");
    $data = json_decode($resp, true);
    $data = json_decode($resp, true);
    if ($data['response'] == '0')
    {
        $error = 3;
        $fa = "error";
        $mess = "Вы не подписаны на группу $sitename";
    }
    if (!$sid)
    {
        $error = 5;
        $mess = "Необходима авторизация!";
        $fa = "error";
    }    
    if ($time - $bonus > 86400)
    {
        if ($error == 0)
        {
            $randomb = rand($min_daily_size, $max_daily_size);
            $balancenew = $balance + $randomb;
            $summadailywag = $randomb * $coefbonus;
            $wagerdaily = $wager + $summadailywag;
            $update_sql = "Update users set balance='$balancenew', wager='$wagerdaily'  WHERE hash='$sid'";
            mysql_query($update_sql) or die("Ошибка вставки" . mysql_error());
            $update_sql1 = "Update users set bdate='$time' WHERE hash='$sid'";
            mysql_query($update_sql1) or die("Ошибка вставки" . mysql_error());
            $fa = "success";
        }
    }
    else
    {
        $error = 1;
        $fa = "error";
        $mess = "Данный бонус вы можете получить через $minutes1 минут";
    }
    $result = array(
        'success' => "$fa",
        'error' => "$mess",
        'balance' => "$balance",
        'new_balance' => "$balancenew",
        'bonussize' => "$randomb"
    );

}
//////////////////////////////////////////////////////////

if($type == "activePromo") {
  
$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$bonus = $row['bonus'];
$user_id = $row['id'];
$ban = $row['ban'];
$balance = $row['balance'];
$tp = $row['tp'];
        $vk = $row['social'];
    $vk_id = substr($vk, -9);
}
// инфу о пользователе мы получили, получаем промо
$promo = $_POST['promoactive']; // получаем введенное промо
$sql_select = sprintf("SELECT COUNT(*) FROM promo WHERE name='%s'", mysql_real_escape_string($promo));
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$count = $row['COUNT(*)'];
$timep = 600 - (time() - $tp);
}
    $vk1 = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=$vk_id&access_token=$vkgrouptoken&v=5.81"));
    $vk1 = $vk1->response[0]->id;
    $resp = file_get_contents("https://api.vk.com/method/groups.isMember?group_id=$vkgoupid&user_id={$vk1}&access_token=$vkgrouptoken&v=5.81");
    $data = json_decode($resp, true);
    $data = json_decode($resp, true);
    if ($data['response'] == '0')
    {
        $error = 3;
        $fa = "error";
        $mess = "Вы не подписаны на группу $sitename";
    }

  if($promo == '') {
    $error = 2;
    $mess = "Введите промокод!";
    $fa = "error";
  }
  if($count == 0) {
    $error = 1;
    $mess = "Введенный вами промокод не найден";
    $fa = "error";
  }
 if($count != 0) {
    $sql_select1 = "SELECT * FROM promo WHERE name='$promo'";
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{	
$sum = $row['sum'];
$limit = $row['active'];
$actived = $row['actived'];
$idactive = $row['id_active'];
}
  }
if($sum > 10000) {
    $error = 2;
    $mess = "Сумма промокода больше чем должна быть";
    $fa = "error";
  }
  if($count == 1) {
  if($limit == $actived || $actived > $limit) {
    $error = 3;
    $mess = "Промокод исчерпан";
    $fa = "error";
  }
  if($ban == 1) {
    $error = 4;
    $mess = "Ваш аккаунт заблокирован";
    $fa = "error";
  }
  }
  if (preg_match("/$user_id /",$idactive))  {	
	$error = 5;
    $mess = "Вы уже активировали данный промокод";
    $fa = "error";
   }
    if (!$sid)
    {
        $error = 6;
        $mess = "Необходима авторизация!";
        $fa = "error";
    }   
  if($error == 0) {
    $time = time();
    $newbonus = $bonus +( $sum * 8);
    $newbalance = $balance + $sum;
    $newwager = $sum * $coefpromo;
    $newactive = $actived + 1;
    $newid = "$user_id $idactive";
    $update_sql1 = "UPDATE users SET balance = '$newbalance', wager = wager + $newwager WHERE hash = '$sid'";
    mysql_query($update_sql1);
    $update_sql1 = "UPDATE users SET bonus = '$newbonus' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    // обновляем бд (2)
    $update_sql2 = "UPDATE promo SET actived = '$newactive' WHERE name = '$promo'";
    mysql_query($update_sql2); 
    // обновляем бд (3)
    $update_sql3 = "UPDATE promo SET id_active = '$newid' WHERE name = '$promo'";
    mysql_query($update_sql3);
    $fa = "success";
  }
  $result = array(
	'success' => "$fa",
	'error' => "$mess",
	'balance' => "$balance",
	'new_balance' => "$newbalance"
    );
}

//////////////////////////////////////////////////////////////////////////


echo json_encode($result);
?>
