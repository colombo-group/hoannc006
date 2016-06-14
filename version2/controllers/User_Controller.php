<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 05/06/2016
 * Time: 22:19
 */
class User_Controller {
    protected $_user;
    protected $_lib;
    public function __construct()
    {
        $this->_user = new User();
        $this->_lib = new Lib();
    }

    function index(){
        $total_records = $this->_user->getCountUser();
        if(isset($_POST['select'])){
            $_SESSION['limit'] = $_POST['limit'];
        }
        if(isset($_SESSION['limit'])){
            $limit = $_SESSION['limit'];
        }else{
            $_SESSION['limit'] = 10;
            $limit = 10;
        }
        $page_current = isset ( $_GET["page"] ) ? intval ( $_GET["page"] ) : 1;
        $pagination = Pagination::paging($total_records, $limit,'index.php',$page_current);
        $users = $this->_user->getUserLimit($pagination['start'], $limit);
        if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
            if($sort == 1){
                $users = $this->_lib->sort_array($users, 'fullname', SORT_ASC, 1);
            }elseif ($sort == 2) {
                $users = $this->_lib->sort_array($users, 'fullname', SORT_DESC, 1);
            }elseif($sort == 3){
                $users = $this->_lib->sort_array($users, 'create_at', SORT_ASC);
            }elseif ($sort == 4) {
                $users = $this->_lib->sort_array($users, 'create_at', SORT_DESC);
            }
        }
        include 'views/home.php';
    }
    
    function edit($id){
        $validator = new Validator();
        $status = true;
        $users = $this->_user->getListUser();
        $user = $this->_user->getUser($id);
        $day = date("d", strtotime($user['birthday']));
        $error = array();
        if(isset($_POST['edit'])){
            $username = Input::get('username');
            $email = Input::get('email');
            $gender = Input::get('gender');
            $fullname = Input::get('fullname');
            $phone = Input::get('phone');
            $description = Input::get('description');
            $level = Input::get('level');
            $birthday = Input::get('year').'-'.Input::get('month').'-'.Input::get('day');
            if(!empty($username) && !empty($email) && !empty($gender) && !empty($fullname) && !empty($phone)
                && !empty($description)){
                $user_check = array(
                    "username" => $username,
                    "email" => $email,
                    "fullname" => $fullname,
                    "phone" => $phone
                );
                $check_input = $validator->validate($user_check);
                if($check_input['status'] == true){

                    $user_check_exist = array();
                    if($username != $user['username']){
                        $user_check_exist['username'] = $username;
                    }
                    if($username != $user['email']){
                        $user_check_exist['email'] = $username;
                    }
                    if($username != $user['phone']){
                        $user_check_exist['phone'] = $username;
                    }
                    $check_exist = $validator->check_exist($users, $user_check_exist);
                    if($check_exist['status'] == true){
                        if(isset($_FILES['avatar'])){
                            $file = $_FILES['avatar'];
                            if(!empty($file['name'] )){
                                $path = 'public/avatar/';
                                $result_upload = $this->_lib->upload($file, $path);
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
                            "description" => $description,
                            'update_at' => date('Y-m-d h:i:s')
                        );
                        $this->_user->update($id, $user_edit);
                        header('location:index.php?action=detail&id='.$id);
                    }else{
                        $error = $check_exist['error'];
                    }
                }else{
                    $error = $check_input['error'];
                }
            }else{
                $error['common'] = "Không được để trống ! Vui lòng nhập lại";
            }
        }
        include 'views/edit.php';
        

    }
    
    function detail($id){
        $user = $this->_user->getUser($id);
        $user_introduced = $this->_user->getListUserIntroduce($id);
        include 'views/detail.php';
    }
    
    function delete($id){
        $user = $this->_user->getUser($id);
        if($_SESSION['user']['level'] > $user['level']){
            if($this->_user->delete($id)){
                header('location:index.php');
            }else{
                echo 'xoa khong thanh cong';
            }
        }else{
            header('location:index.php');
        }
    }
}