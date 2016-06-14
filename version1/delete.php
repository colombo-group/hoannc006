<?php 
session_start();
if(isset($_GET['id'])){
	include 'connect.php';
	include 'User.php';
	$id = $_GET['id'];
	$user = getUser($id);
	if($_SESSION['user']['level'] > $user['level']){
		if(delete($id)){
			header('location:index.php');
		}else{
			echo 'xoa khong thanh cong';
		}	
	}else{
		header('location:index.php');
	}
	
}
?>