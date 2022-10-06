<?php
session_start();
include_once('include/LineProfiles.php'); //取得用戶端 Profile
include_once('include/config.php'); //設定值

$url = goLineLgoin($config);

if (! isset($_SESSION['displayName'])) {
	header('Location: '.$url);
	// echo "<script> location.href='".$url."';</script>";
}

if(isset($_POST['sendmess'])) {
	sendMessage($_SESSION['userId'], $config);
}

?>


<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0, user-scalable=yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LineLogin | 商品</title>
</head>
<body>

	<script type="text/javascript">
		// function sendMess(){
		// 	var result ="<?php sendMessage($_SESSION['userId'], $config);; ?>"
		// 	document.write(result);
		// }
	</script>
	<a href="logout.php"><img src="img/logout.png" style="height: 50px; width: 50px;" alt=""> 登出</a>
	<p>
  <h1><a href="./index.php">回首頁</a></h1>
  </p>
  登入完後到的地方
	<?php
	if($_SESSION['displayName']) {
		echo "<pre>";
		echo "姓名：";
		print_r($_SESSION['displayName']);
		echo "</pre>";
		
		echo "<pre>";
		echo "userId：";
		print_r($_SESSION["userId"]);
		echo "</pre>";

		echo "<pre>";
		echo "email：";
		print_r($_SESSION["email"]);
		echo "</pre>";
	} else {
		echo "沒有東西";
	}
		
	?>

		<form method="post">
        <input type="submit" name="sendmess" value="sendmess"/>
    </form>

</body>

</html>

