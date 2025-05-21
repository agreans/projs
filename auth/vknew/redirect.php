<?
session_start();
require("../../system/config.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Авторизуемся..</title>
  </head>
  <body>
<script language="JavaScript"> 
  window.location.href = "https://oauth.vk.com/authorize?client_id=<?=$client_id?>&redirect_uri=<?=$redirect_uri?>&response_type=code"
</script>

  </body>
</html>