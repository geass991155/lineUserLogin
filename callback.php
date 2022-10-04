<?php
// 用code取得access_token，access_token取得用戶資料
$code = $_GET["code"];
$state = $_GET["state"];

include_once('include/LineProfiles.php'); //取得用戶端 Profile
include_once('include/config.php'); //設定值

$result = getAccessToken($code,$config); //取得使用者資料

setcookie("access_token", $result["0"], time() + 3600 * 24 * 20); //把他記憶20天
$user = getLineProfile_access_token($result["0"]); //取得使用者資料
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
		
		echo "<pre>";
		print_r($user);
		echo "</pre>";
		print_r($user["userId"]);
		
	}
	else {
		echo "沒有";
	}

	if ($result["1"]) {
		echo "<pre>";
		print_r($result["1"]);
		echo "</pre>";
		echo "array";
		print_r($result["1"]["email"]);
		echo "<pre>";
		echo "object";
		print_r($result["1"]->email);
		echo "</pre>";
	}
	?>

</body>

</html>