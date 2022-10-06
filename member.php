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
	<title>LineLogin | 登入</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	
	<!-- <link rel="stylesheet" href="./css/styles.css"> -->
	<link rel="stylesheet" href="./css/layout.css">
	
</head>
<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">line登入測試</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">首頁</a></li>
					<li><a href="member.php">會員</a></li>
					<li><a href="logout.php">登出</a></li>
					<li>
						<a href="#">
						<i class="bi-cart2" role="img" aria-label="cart"></i>
						Cart
						<span class="badge  text-white ms-1 rounded-pill">0</span></a>
					</li>
				</ul>
			</div>
		</nav>
		
	 	<div class="container">
		  <ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">會員資料</a></li>
		    <li><a data-toggle="tab" href="#menu1">發送訊息</a></li>
		  </ul>
		  <div class="tab-content">
		    <div id="home" class="tab-pane fade in active">
		      <h3>名字：</h3>
		      <p><?php print_r($_SESSION['displayName']); ?></p>
					<h3>Userid：</h3>
		      <p><?php print_r($_SESSION['userId']); ?></p>
					<h3>Email：</h3>
		      <p><?php print_r($_SESSION['email']); ?></p>
		    </div>
		    <div id="menu1" class="tab-pane fade">
					<form action="sendMessage.php" method="post">
						<div class="form-group">
							<label for="message">訊息：</label>
							<input type="text" name="message" id="message" class="form-control" placeholder="Message">
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>	
		    </div>
		  </div>
		</div>


		<script src="https://code.jquery.com/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</body>
</html>

