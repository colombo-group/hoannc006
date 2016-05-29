<?php 
session_start();
if($_SESSION['user']['is_logged'] == true){
	include 'connect.php';
	include 'User.php';
	include 'libs.php';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$user = getUser($id);
		$day = date("d", strtotime($user['birthday']));
	}	
	if($_SESSION['user']['level'] > $user['level'] || $_SESSION['user']['id'] == $user['id']){
		$error = array();
		if(isset($_POST['edit'])){
			$username = $_POST['username'];
			$email = $_POST['email'];
			$gender = $_POST['gender'];
			$fullname = $_POST['fullname'];
			$phone = $_POST['phone'];
			$description = $_POST['description'];
			$levle = input('level');
			$birthday = input('year').'-'.input('month').'-'.input('day');
			if(!empty($username) && !empty($email) && !empty($gender) && !empty($fullname) && !empty($phone) && !empty($description)){
				$user_check = array(
					"username" => $username,
					"email" => $email,
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
						if(isset($_FILES['avatar'])){
							$file = $_FILES['avatar'];
							if(!empty($file['name'] )){		
								$path = 'public/avatar/';
								$result_upload = upload($file, $path);
								if($result_upload['status']){
									$avatar= $file['name'];	
								}else{
									$error['file'] = $result_upload['error'];
								}	
							}else{
								$avatar = $user['avatar'];
							}
						}
						$user_edit = array(
							"username" => $username,
							"email" => $email,
							"avatar" => $avatar,
							"fullname" => $fullname,
							"level" => $level,
							"gender" => $gender,
							"phone" => $phone,
							"birthday" => $birthday,
							"avatar" => $avatar,
							"description" => $description,
							'update_at' => date('Y-m-d h:i:s')
							);
						update('users', $id, $user_edit);
						header('location:detail.php?id='.$id);
					}else{
						$error = $check_exist['error'];
					}
				}else{
					$error = $check['error'];
				}
			}else{
				$error['common'] = "Không được để trống ! Vui lòng nhập lại";
			}
		}

		include 'views/edit.php';
		
	}else{
		header('location:index.php');
	}
	
}else{
	header('location:index.php');
}

?>