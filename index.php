<?php
$state=sha1(time());

$parameter = [
	'response_type' => 'code',
	'client_id' => '1657522596',
	'redirect_uri' => 'https://lineuserlogin.herokuapp.com/callback.php',
	'state' => $state,
	'scope' =>'profile%20openid%20email',
];

$host = "https://access.line.me/oauth2/v2.1/authorize" ;

$url = $host . "?" . http_build_query($parameter);

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
  嗨這是要來做line登入
	<p>
		<a href="<?php echo $url; ?>"><img src="img/icon.png" border="0"></a>
	</p>

	<h3><a href="./product.php">分頁</a></h3>
</body>
</html>

