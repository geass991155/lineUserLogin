<?php
session_start(); //啟用Session功能

include_once('include/LineProfiles.php'); //取得用戶端 Profile
include_once('include/config.php'); //設定值

// 用code取得access_token，access_token取得用戶資料
$code = $_GET["code"];
$state = $_GET["state"];

// 沒有code
if (!$code) {
	echo "<script> window.alert('code錯誤'); ";
	echo "location.href='login.php';</script>";
}

$result = getAccessToken($code, $config); //取得使用者資料

// 有error返回login.php
if (isset($result["0"]->error) || isset($result["0"]->error)) {
	echo "<script> window.alert('請重新登入'); ";
	echo "location.href='login.php';</script>";
}

setcookie("access_token", $result["0"], time() + 3600 * 24 * 20); //把他記憶20天
$user = getLineProfile_access_token($result["0"]); //取得使用者資料

$friendship = getFriendship($result["0"]); //取得使用者資料// 加好友狀態

$_SESSION['displayName'] = $user["displayName"];
$_SESSION['userId'] = $user["userId"];
$_SESSION['email'] = $result["1"]->email;
$_SESSION['access_token'] = $result["0"];
$_SESSION['friendship'] = $friendship["friendFlag"];

if ($_SESSION['userId'] && $_SESSION['displayName'] && $_SESSION['email'] && $_SESSION['access_token']) {
	echo "<script> location.href = 'member.php';</script>";
}

?>
