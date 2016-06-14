<?php 
include 'connect.php';
include 'User.php';
include 'libs.php';
session_start();
// var_dump($_SERVER['REQUEST_URI']) ;
$total_records = getCountUser();
if(isset($_POST['select'])){
	$_SESSION['limit'] = $_POST['limit'];
}
if(isset($_SESSION['limit'])){
	$limit = $_SESSION['limit'];	
}else{
	$limit = 10;
}



$page_current = isset ( $_GET["page"] ) ? intval ( $_GET["page"] ) : 1;
$pagination = paging($total_records, $limit,'index.php',$page_current); 


$users = getUserLimit($pagination['start'], $limit);
if(isset($_GET['sort'])){
	$sort = $_GET['sort'];
	if($sort == 1){
		$users = sort_array($users, 'fullname', SORT_ASC, 1);	
	}elseif ($sort == 2) {
		$users = sort_array($users, 'fullname', SORT_DESC, 1);	
	}elseif($sort == 3){
		$users = sort_array($users, 'create_at', SORT_ASC);	
	}elseif ($sort == 4) {
		$users = sort_array($users, 'create_at', SORT_DESC);
	}
}


include 'views/home.php';
?>