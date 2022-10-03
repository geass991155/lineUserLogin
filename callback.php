<?php
require_once('_inc/ConfigManager.php'); //Line 設定檔 管理器
require_once('_inc/LineAuthorization.php'); //產生登入網址
require_once('_inc/LineProfiles.php'); //取得用戶端 Profile
require_once('_inc/LineController.php'); //LINE控制
require_once('./config.php'); //設定值

// 用code取得access_token，access_token取得用戶資料
$code = $_GET['code'];
$state = $_GET['state'];

$access_token = $Line->getAccessToken($code);//取得使用者資料

setcookie("access_token",$access_token, time()+3600*24*20);//把他記憶20天
$user = $Line->getLineProfile_access_token($access_token);//取得使用者資料

?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0, user-scalable=yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LineLogin</title>
</head>
<body>
  使用者資料
  <?php echo $user?>
</body>
</html>

