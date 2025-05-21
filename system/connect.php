<?php 


$server = "localhost"; 
$login = 'radugaoz_betlot';
$pass = 'a2QHg*%N';
$name = 'radugaoz_betlot';


mysql_connect($server, $login, $pass)
or die("Database connection error");
mysql_select_db($name);
mysql_query("SET NAMES utf8");