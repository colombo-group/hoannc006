<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 05/06/2016
 * Time: 22:14
 */
require 'controllers/User_Controller.php';
require 'controllers/Auth.php';
require 'models/User.php';
require 'config/Config.php';
require 'libraries/libs.php';
require 'libraries/Input.php';
require 'libraries/Pagination.php';
require 'libraries/Validator.php';
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$Action = new User_Controller();
$Auth = new Auth();

$action = Input::get('action');

if($action == 'edit'){
    if(isset($_SESSION['user'])){
        if($_SESSION['user']['is_logged'] == true){
            if($_SESSION['user']['level'] > $user['level'] || $_SESSION['user']['id'] == $user['id']){
                $id = Input::get('id');
                $Action->edit($id);
            }else{
                echo "Bạn không có quyền truy cập";
            }
        }else{
            echo "Bạn không có quyền truy cập";
        }
    }

    
}else if($action == 'delete'){
    $id = Input::get('id');
    $Action->delete($id);
}else if($action == 'detail'){
    $id = Input::get('id');
    $Action->detail($id);
}else if($action == 'login'){
    $Auth->login();
}
else if($action == 'register'){
    $Auth->register();
}
else if($action == 'change'){
    if($_SESSION['user']['is_logged'] == true){
        $id = $_GET['id'];
        if($_SESSION['user']['level'] > $user['level'] || $_SESSION['user']['id'] == $user['id']){
            $Auth->changePass($id);
        }else{
            echo "Bạn không có quyền truy cập";
        }
    }else{
        echo "Bạn không có quyền truy cập";
    }

}
else if($action == 'logout'){
    $Auth->logout();
}else{
    $Action->index();
}
?>