<?php
/**
 * 登出處理
 *
 */
include_once('include/LineProfiles.php'); //取得用戶端 Profile
include_once('include/config.php'); //設定值
session_start();

// 若未登入時，跳轉至index
header("Cache-Control:private");
header("Content-Type:text/html;charset=utf-8");
$displayName = $_SESSION['displayName'];
if (!isset($displayName)) {
	echo "<script> window.alert('請重新登入');";
	echo "location.href='index.php';</script>";
}
getLogout($config, $_SESSION['access_token'] );
session_destroy();
header("location:index.php");
?>
