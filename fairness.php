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



<div class="_nuxt_card_body" style="height: fit-content;overflow: hidden;overflow-wrap: break-word;">
                <div class="card-head">
                    <h4 class="card-title card-title-lg">Абсолютно честно</h4>
                </div>
                <div class="card-text">
                    <p>Перед каждой игрой генерирутеся строка <a href="https://ru.wikipedia.org/wiki/SHA-2" target="_blank">алгоритмом SHA-512 </a> в которой содержится <a href="https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D0%BB%D1%8C_(%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D0%BE%D0%B3%D1%80%D0%B0%D1%84%D0%B8%D1%8F)" target="_blank">соль</a> и победное число (от 0 до 999999). Можно сказать, что перед Вами зашифрованный исход данной игры. Метод гарантирует <b>100% честность</b>, так как результат игры Вы видите заранее, а при изменении победного числа приведет к изменению Hash.</p>

                                                    Проверяйте самостоятельно:
                                                    <ul>
                                                        <li>Скоприруйте Hash до начала игры</li>
                                                        <li>После окончания нажмите <code class="highlighter-rouge">"Проверить игру"</code></li>
                                                        <li>Откроется окно с результатом</li>
                                                        <li>Скопируйте вручную поля Salt1, Number (Победное число), Salt2 или нажмите кнопку <code class="highlighter-rouge">"Скопировать"</code></li>
                                                        <li>Вставьте в любой независимый SHA-512 генератор (Например: <a href="https://emn178.github.io/online-tools/sha512.html" target="_blank">Ссылка 1</a> <a href="https://www.md5calc.com/sha512" target="_blank">Ссылка 2</a> <a href="https://passwordsgenerator.net/sha512-hash-generator/" target="_blank">Ссылка 3</a>)</li>
                                                        <li>Hash должен совпадать c Hash до начала игры</li>
                                                    </ul>
                </div>
            </div>



<?
require ("include/footer.php");
?> 
  
</div> 
    
    
    
</body>
</html>    