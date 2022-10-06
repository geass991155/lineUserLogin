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
					<li class="active"><a href="login.php">首頁</a></li>
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

	<div class="wrapper">
    <form class="form-signin">       
      <h2 class="form-signin-heading">登入</h2>
			<div>
				<input type="checkbox" id="agree" name="agree">
				<label for="agree">同意取得line 的 email使用，作為登入認證，不會在其他用途。</label>
			</div>
			<p>
				<a href="<?php echo $url; ?>"><img src="img/icon.png" style="display:block; margin:auto;" border="0"></a>
			</p>
    </form>
  </div>

	
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

