<?php 
include 'connect.php';
include 'User.php';
session_start();
$id = $_GET['id'];
$user = getUser($id);
$user_introduced = getListUserIntroduce($id);
include 'views/detail.php';
?>