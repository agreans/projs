<?php
session_start();
unset($_SESSION['hash']);
unset($_SESSION['login']);
header('Location: /');
?>