
<br>

<div class="_nuxt_card">
<span class="_nuxt_card_title">Последние ставки</span>
<div class="_nuxt_games_history">
<header class="_nuxt_games_history_header"><span>#</span><span>Ставка</span><span>Режим</span></header>
<div class="_nuxt_games_history_list">
<?php 
$sql_select5 = "SELECT * FROM dice ORDER BY id + 0 DESC LIMIT 10";
$result5 = mysql_query($sql_select5);
while($row = mysql_fetch_array($result5)) {
$id_game = $row['id'];
$game_live = $row['game'];
$user_id_live = $row['user_id'];
$bet_live = $row['bet'];

$bet_live = round($bet_live, 2);
$bet_live = number_format($bet_live, 2, '.', ' ');

if($game_live == 'Dice'){
$game_live = 'Дайс';    
}
if($game_live == 'Mines'){
$game_live = 'Мины';    
}
if($game_live == 'Bubbles'){
$game_live = 'Баблс';    
}

echo 
'
<div class="_nuxt_games_history_content">
<div class="_nuxt_games_history_insert">'.$id_game.'</div>  
<div class="_nuxt_games_history_insert"><b>'.$bet_live.' L</b></div>  
<div class="_nuxt_games_history_insert"><b>'.$game_live.'</b></div>   
</div>
';
}
?>
</div>
</div>
</div>