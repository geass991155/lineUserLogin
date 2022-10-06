<?php
session_start(); //啟用Session功能
// 用code取得access_token，access_token取得用戶資料
$code = $_GET["code"];
$state = $_GET["state"];

include_once('include/LineProfiles.php'); //取得用戶端 Profile
include_once('include/config.php'); //設定值

$result = getAccessToken($code, $config); //取得使用者資料

setcookie("access_token", $result["0"], time() + 3600 * 24 * 20); //把他記憶20天
$user = getLineProfile_access_token($result["0"]); //取得使用者資料
$userId = $user["userId"];

$_SESSION['displayName'] = $user["displayName"];
$_SESSION['userId'] = $user["userId"];
$_SESSION['email'] = $result["1"]->email;
$_SESSION['access_token'] = $result["0"];

if (!$code) {
	echo "<script> window.alert('code錯誤'); ";
	echo "location.href='login.php';</script>";
}

if ($_SESSION['userId'] && $_SESSION['displayName'] && $_SESSION['email'] && $_SESSION['access_token']) {
	echo "<script> location.href = 'member.php';</script>";
}

?>
