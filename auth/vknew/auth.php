<?
session_start();
require("../../system/config.php");

$client_id = $client_id; // ID приложения
$client_secret = $client_secret; // Защищённый ключ
$redirect_uri = $redirect_uri; // Адрес сайта

$refid = $_SESSION['ref']; //referal id

if (isset($_GET['code'])) {
    $params = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    ];

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = [
            'uids' => $token['user_id'],
            'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,photo_130',
            'access_token' => $token['access_token'],
            'v' => '5.101'
        ];

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
        }

        // информация о пользователе VK
        $vk_id = $userInfo['id'];
        $first_name = $userInfo['first_name'];
        $last_name = $userInfo['last_name'];
        $name = "$first_name $last_name";
        $photo = $userInfo['photo_big'];
        $social_url = "http://vk.com/id$vk_id";

        $user_exists_query = "SELECT * FROM users WHERE social = '$social_url'";
        $user_result = mysql_query($user_exists_query);
        $user_data = mysql_fetch_assoc($user_result);

			if ($user_data) {
				
				// Пользователь существует, выполнить авторизацию
				$_SESSION['hash'] = $user_data['hash'];
				$_SESSION['login'] = 1;

				// Обновить IP пользователя и другую информацию, а также установить vk_ok = 1 при необходимости
				$ip = $_SERVER['REMOTE_ADDR'];
				$user_hash = $user_data['hash']; // Получаем hash текущего пользователя для обновления записи
				mysql_query("UPDATE users SET ip = '$ip', vk_id = '$vk_id', img = '$photo', vk_ok = 1 WHERE hash = '$user_hash'");
				
			} else {
			
				// Получаем IP пользователя
				$ip = $_SERVER['REMOTE_ADDR'];

				// Генерируем данные по умолчанию для date_reg в нужном формате
				$date_reg = date("d.m.Y H:i:s");
                // Генерируем Баланс по умолчанию
                $balance = 0;
                //процент рефки по умолчанию
                $referal_per = 20;
				
				// Создаем нового пользователя
				$new_user_hash = md5($social_url . microtime()); // Генерация уникального хэша
				$new_user_query = "INSERT INTO users 
				(login, social, vk_id, img, hash, ip, data_reg, balance, ref_per, ref_id) 
				VALUES 
				('$name', '$social_url', '$vk_id', '$photo', '$new_user_hash', '$ip', '$date_reg', '$balance', '$referal_per', '$refid')";
				mysql_query($new_user_query);

$selectea = "SELECT * FROM users WHERE id = '$refid'";
$resulta = mysql_query($selectea);
$row44 = mysql_fetch_array($resulta);
if(count($row44)>0){
mysql_query("UPDATE users SET balance = balance + $refrandprize, refearn = refearn + $refrandprize, refs = refs + 1 WHERE id = '$refid'");
}

				// Устанавливаем сессии для нового пользователя
				$_SESSION['hash'] = $new_user_hash;
				$_SESSION['login'] = 1;
			}
			
        // Перенаправляем на главную страницу
          $home_url = 'http://'.$_SERVER['HTTP_HOST'] .'/';
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$home_url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$home_url.'" />';
        echo '</noscript>'; exit;
    }
}
?>
