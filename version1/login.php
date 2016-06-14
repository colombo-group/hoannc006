<?php 
session_start();
$status_login = true;
if(isset($_SESSION['fail'])){
	$between_lock = time() - $_SESSION['fail']['time'] -  3*60;//60 * 60;
	$between_check = time() - $_SESSION['start'] - 60;
	if($between_check <= 0){
		if($_SESSION['fail']['count'] >=2){
			$status_login = false;
		}	
	}else{
		$_SESSION['fail']['count'] = 0;
	}
	if($between_lock > 0){
		$status_login = true;
		$_SESSION['fail']['count'] = 0;
	}
}
if(!isset($_SESSION['user'])){
	include 'connect.php';
	include 'User.php';
	if(isset($_POST['login'])){
		$email_username = $_POST['email-username'];
		$password = $_POST['password'];
		if(!empty($email_username) && !empty($password)){
			$login = checkLogin($email_username, md5($password));
			if($login['status']){
				unset($_SESSION['fail']);
				unset($_SESSION['start']);
				$_SESSION['user'] = $login['user'];
				$_SESSION['user']['is_logged'] = true;

				header('location:index.php');
			}else{
				$error = "Tên đăng nhập hoặc mật khẩu sai !";
				$_SESSION['fail']['count'] += 1;
				$_SESSION['fail']['time'] = time();
				if($_SESSION['fail']['count'] == 1){
					$_SESSION['start'] = time();
				}
			}	
		}else{
			$error = "Vui lòng điền đầy đủ thông tin đăng nhập !";
		}
}
include 'views/login.php';	

}else{
	header('location:index.php');
}


?>