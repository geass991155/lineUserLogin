<?php
session_start();
include_once('include/LineProfiles.php'); //取得用戶端 Profile
include_once('include/config.php'); //設定值

$url = goLineLgoin($config);
if (! isset($_SESSION['displayName'])) {
	header('Location: '.$url);
}
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
					<li class="active"><a href="member.php">會員</a></li>
					<li><a href="logout.php">登出</a></li>
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
		  <ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">會員資料</a></li>
		    <li><a data-toggle="tab" href="#menu1">發送訊息</a></li>
		  </ul>
		  <div class="tab-content">
		    <div id="home" class="tab-pane fade in active">
					<div class="member">
						<div class="form-group">
							<label for="username">名字：</label>
							<input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="<?php print_r($_SESSION['displayName']); ?>" readonly>
						</div>
						<div class="form-group">
							<label for="userid">Userid：</label>
							<input type="text" class="form-control" id="userid" placeholder="<?php print_r($_SESSION['userId']); ?>" readonly>
						</div>
						<div class="form-group">
							<label for="userid">Email：</label>
							<input type="text" class="form-control" id="userid" placeholder="<?php print_r($_SESSION['email']); ?>" readonly>
						</div>
					</div>
		    </div>
		    <div id="menu1" class="tab-pane fade">
					<div class="member">
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
		</div>


		<script src="https://code.jquery.com/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</body>
</html>

