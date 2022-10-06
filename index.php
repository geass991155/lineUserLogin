<?php
include_once('include/LineProfiles.php'); //取得用戶端 Profile
include_once('include/config.php'); //設定值

$url = goLineLgoin($config);

?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0, user-scalable=yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LineLogin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid"> 
			<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
									data-target="#example-navbar-collapse">
							<span class="sr-only">漢堡選單</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">line登入測試</a>
			</div>
			<div class="collapse navbar-collapse" id="example-navbar-collapse">
				<ul class="nav navbar-nav mr-auto">
					<li class="active"><a href="login.php">登入</a></li>
					<li>
						<a href="#">
						<i class="bi-cart2" role="img" aria-label="cart"></i>
						Cart
						<span class="badge  text-white ms-1 rounded-pill">0</span></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container">
		<?php 
			if (! isset($_SESSION['displayName'])) {
				print_r("還沒登入");
			} else {
				print_r("已登入");
			}?>
	</div>
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

