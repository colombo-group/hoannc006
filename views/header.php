<!DOCTYPE html>
<html>
	<head>
		<title>Trang chủ</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
		<meta name="author" content="hoannc" />
		<link rel = "stylesheet" type="text/css" href="public/css/home.css">
		<link rel = "stylesheet" type="text/css" href="public/css/layout.css">
		<link rel = "stylesheet" type="text/css" href="public/css/login.css">
	</head>
	<body>
	<div id = "layout">
		<div class="header">
			<div id = "top">
				<div class = "main">
					<div class = "tRight">
						<ul>
							<?php if(isset($_SESSION['user'])):?>
								<?php if($_SESSION['user']['is_logged'] == true):?>
									<li>Xin chào: 
										<a href="detail.php?id=<?php echo $_SESSION['user']['id']?>"><?php echo $_SESSION['user']["fullname"]; ?></a>
									</li>
									<li class="second">
										<img src="public/images/icon/logout.png" width="20px" height="20px">
										<a href="logout.php">Đăng xuất</a>
									</li>
								<?php endif; ?>
							<?php else: ?>
								<li>
								<img src="public/images/icon/register.png" width="20px" height="20px">
									<a href="register.php">Đăng ký</a>
								</li>
								<li class="second">
									<img src="public/images/icon/login.png" width="20px" height="20px">
									<a href="login.php">Đăng nhập</a>
								</li>
								
							<?php endif; ?>
						</ul>  
					</div>
				</div>
			</div>
			<div id = "menu">
				<div class = "main">
					<div class = "mLeft">
						<a href=""><img src="public/images/icon/logo2.png" width="80px" height="70px"></a>
					</div>
					<div class = "mRight"> 
						<ul>
							<li><img src="public/images/home.png">
								<a href="index.php">Trang chủ</a>
							</li>
							<?php if(isset($_SESSION['user'])):?>
								<?php if($_SESSION['user']['is_logged'] == true):?>
									<li><a href="detail.php?id=<?php echo $_SESSION['user']['id']?>">Trang cá nhân</a></li>
								<?php endif; ?>
							<?php endif;?>
							
						</ul>	
					</div>
				</div>
			</div>
		</div>
		<!-- Begin Body -->
		<div id = "body">
			<div class = "main">