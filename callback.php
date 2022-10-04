<?php
// 用code取得access_token，access_token取得用戶資料
$code = $_GET["code"];
$state = $_GET["state"];

include_once('include/LineProfiles.php'); //取得用戶端 Profile
include_once('include/config.php'); //設定值

$access_token = getAccessToken($code,$config); //取得使用者資料

setcookie("access_token", $access_token, time() + 3600 * 24 * 20); //把他記憶20天
$user = getLineProfile_access_token($access_token); //取得使用者資料
$userId="";
foreach($user as $key => $value) {
	if ($key == "userId") {
		$userId = $value;
	}
}
$send = sendMessage($userId,$config);
print_r($send);
if (!$code) {
	echo "<script> window.alert('code錯誤');";
	echo "location.href='index';</script>";
}
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
	<?php
	if ($user) {
		foreach ($user as $key => $value) {
			echo "<pre>";
			print_r($key.":");
			echo "</pre>";
			print_r($user);
			echo "</pre>";
		}
		echo "<pre>";
		print_r($user);
		echo "</pre>";
		
	}
	else {
		echo "沒有";
	}
	?>

</body>

</html>