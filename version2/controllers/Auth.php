<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 05/06/2016
 * Time: 22:57
 */

class Auth {
    protected $_user;
    protected $_lib;
    public function __construct()
    {
        $this->_user = new User();
        $this->_lib = new Lib();
    }
    
    function login(){
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

        if(isset($_POST['login'])) {
            $email_username = $_POST['email-username'];
            $password = $_POST['password'];
            if(!empty($email_username) && !empty($password)){
                $login = $this->_user->checkLogin($email_username, md5($password));
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
        require 'views/login.php';
    }
    
    
    function register(){
        $status = true;
        $error = array();
        $validator = new Validator();
        $users = $this->_user->getListUser();
        if(isset($_POST['register'])){
            $user_register = Input::all();
            $find_presender = $this->_lib->find_presender($user_register['presender'], $users);
            $user_register['presenter'] = $find_presender['id'];
            if(empty($user_register['username']) || empty($user_register['email']) || empty($user_register['phone'])
                || empty($user_register['fullname']) || empty($user_register['password']) || empty($user_register['repassword'])){
                $status =false;
                $error['common'] = "Vui lòng nhập đầy đủ các trường *";
            }
            if($status == true){
                $user_check = array(
                    "username" => $user_register['username'],
                    "email" => $user_register['email'],
                    "password" => $user_register['password'],
                    "fullname" => $user_register['fullname'],
                    "phone" => $user_register['phone']
                );
                $check = $validator->validate($user_check);
                if($check['status'] == false){
                    $status = false;
                    $error = $check['error'];
                }
            }
            if($status == true){
                $user_check_exist = array(
                    "username" => $user_register['username'],
                    "email" => $user_register['email'],
                    "phone" => $user_register['phone'],
                );
                $check_exist = $validator->check_exist($users, $user_check_exist);
                if($check_exist['status'] == false){
                    $status = false;
                    $error = $check_exist['error'];
                }
            }
            if($status == true ){
                if($user_register['password'] != $user_register['repassword']){
                    $status = false;
                    $error['repassword'] = "Mật khẩu không khớp !";
                }
            }
            if($status == true){
                $user_register['level'] = "1";
                $user_register['create_at'] = date('Y-m-d h:i:s');
                $user_register['password'] = md5($user_register['password']);
                unset($user_register['repassword']);
                unset($user_register['register']);
                var_dump($user_register);

                $file = Input::file('avatar');
                if(!empty($file['name'])){
                    $result_upload = $this->_lib->upload($file,'public/avatar/');
                    if($result_upload['status']){
                        $user_register["avatar"] = $file['name'];
                        if(insert('users', $user_register)){
                            header('location:index.php?action=login');
                        }else{
                            $error['common'] = 'Tạo tài khoản không thành công';
                        }
                    }else{
                        $error['file'] = $result_upload['error'];
                    }
                }else{
                    if($this->_user->create($user_register)){
                        header('location:index.php?action=login');
                    }else{
                        $error['common'] = 'Tạo tài khoản không thành công';
                    }
                }
                
            }
        }
        require 'views/register.php';
    }

    public function changePass($id){
        $error = array();
        $user = $this->_user->getUser($id);
        $status = false;
        if(isset($_POST['change'])){

            $oldPass =$this->_lib->input('oldPass');
            $newPass = $this->_lib->input('newPass');
            $rePass = $this->_lib->input('rePass');
            $user_check = array(
                "password" => $newPass
            );
            $check = $this->_lib->validate($user_check);
            if(!empty($oldPass) && !empty($newPass) && !empty($oldPass)){
                if($check['status'] == true){
                    if($user['password'] == md5($oldPass)){
                        if($newPass == $rePass){
                            $user_edit = array(
                                "password" => md5($newPass)
                            );
                            if($this->_user->update('users', $id, $user_edit)){
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
        
    }
    function logout(){
        session_destroy();
        header('location:index.php');
    }
}