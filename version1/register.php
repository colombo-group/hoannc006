<?php 
session_start();
if(!isset($_SESSION['user'])){
	include 'connect.php';
	include 'User.php';
	include 'libs.php';
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$users = getListUser();
	if(isset($_POST['register'])){
		$error = array();
		$username = input('username');
		$email = input('email');
		$password = input('password');
		$repassword = input('repassword');
		$fullname = input('fullname');
		$phone = input('phone');
		$description = input('description');
		$presender = input('presenter');
		$find_presender = find_presender($presender, $users);

		if(!empty($username) && !empty($email) && !empty($phone) && !empty($fullname) 
			&& !empty($password) && !empty($repassword)){
			$user_check = array(
				"username" => $username,
				"email" => $email,
				"password" => $password,
				"fullname" => $fullname,
				"phone" => $phone
				);
			$check = validate($user_check);
			if($check['status'] == true){
				$user_check_exist = array(
					"username" => $username,
					"email" => $email,
					"phone" => $phone,
					);
				$check_exist = check_exist($users, $user_check_exist);
				if($check_exist['status'] == true){
					if($password == $repassword){
						$user_register = array(
							"username" => $username,
							"email" => $email,
							"password" => md5($password),
							"level" => "1",
							"fullname" => $fullname,
							"phone" => $phone,
							"presenter" => $find_presender['id'],
							'create_at' => date('Y-m-d h:i:s')
							);
						if(isset($_FILES['avatar'])){
							$file = $_FILES['avatar'];
						}
						if(!empty($file['name'] )){
							
							$path = 'public/avatar/';
							$result_upload = upload($file, $path);
							if($result_upload['status']){
								$user_register["avatar"] = $file['name'];
								if(insert('users', $user_register)){
									header('location:login.php');
								}else{
									$error['common'] = 'Tạo tài khoản không thành công';
								}	
							}else{
								$error['file'] = $result_upload['error'];
							}	
						}else{
							if(insert('users', $user_register)){
								header('location:login.php');
							}else{
								$error['common'] = 'Tạo tài khoản không thành công';
							}	
						}
						
					}else{
						$error['repassword'] = "Mật khẩu không khớp !";
					}
				}else{
					$error = $check_exist['error'];
				}
			}else{
				$error = $check['error'];
			}
				
		}else{
			$error['common'] = "Vui lòng nhập đầy đủ các trường *";
		}
	}
	include 'views/register.php';
}else{
	header('location:index.php');
}

?>