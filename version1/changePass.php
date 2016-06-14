<?php 
include 'connect.php';
include 'User.php';
include 'libs.php';
session_start();
if(isset($_GET['id'])){
	if($_SESSION['user']['is_logged'] == true){
		$error = array();
		$id = $_GET['id'];
		$user = getUser($id);
		$status = false;
		if($_SESSION['user']['level'] > $user['level'] || $_SESSION['user']['id'] == $user['id']){
			if(isset($_POST['change'])){
			
			$oldPass =input('oldPass');
			$newPass = input('newPass');
			$rePass = input('rePass');
			$user_check = array(
				"password" => $newPass
				);
			$check = validate($user_check);
			if(!empty($oldPass) && !empty($newPass) && !empty($oldPass)){
				if($check['status'] == true){
					if($user['password'] == md5($oldPass)){
						if($newPass == $rePass){
							$user_edit = array(
								"password" => md5($newPass)
								);
							if(update('users', $id, $user_edit)){
								$status = true;
								include 'views/changePass.php';
							}
						}else{
							$error['newPass'] = "Mật khẩu không khớp";
						}
					}else{
						$error['oldPass'] = "Mật khẩu cũ không đúng";
					}
				}else{
					$error['newPass'] = $check['error']['password'];
				}
				
			}else{
				$error['common'] = "Nhập đầy đủ các mục";
			}
			

		}
			include 'views/changePass.php';	
	}else{
		echo "Bạn không có quyền truy cập";
		}
	}else{
		echo "Bạn không có quyền truy cập";
	}

}else{
	echo "Bạn không có quyền truy cập";
}




?>