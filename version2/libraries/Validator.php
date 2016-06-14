<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 06/06/2016
 * Time: 16:39
 */

class Validator{
//    protected $_passed = false,
//                $_errors = array(),
//                $_db = null;
//    function check($source, $items = array()){
//        foreach ($items as $item => $rules){
//            
//        }
//    }
    function check_regex($string, $pattern){
        if(preg_match($pattern, $string, $match)){
            return true;
        }else{
            return false;
        }
    }
    function check_exist($list,$input){
        $error = array();
        $status = true;
        $message = array(
            "username" => "Tên đăng nhập đã tồn tại !",
            "fullname" => "Họ và tên đã tồn tại !",
            "phone" => "Số điện thoại đã tồn tại !",
            "email" => "Email đã tồn tại !",
        );
        foreach ($list as $row) {
            foreach ($input as $key => $value) {
                if($value == $row[$key]){
                    $error[$key] = $message[$key];
                    $status = false;
                }
            }
        }
        return array(
            "status" => $status,
            "error" => $error
        );
    }
    

    function validate($data = array()){
        $vietnamese = "ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúủăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼẾỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềểễỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ";
        $pattern = array(
            "username" => "/^[A-Za-z0-9_]{4,32}$/",
            "fullname" => '/^[A-Z a-z0-9_'.$vietnamese.']{6,32}$/',
            "phone" => "/^[0-9_]{9,14}$/",
            "password" => "/^[A-Za-z0-9_@!#&]{8,32}$/",
            "email" => "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",
            "date" =>"/[0-9]{2}/[0-9]{2}/[0-9]{4}/"
        );
        $message = array(
            "username" => "Tên đăng nhập không đúng !",
            "fullname" => "Họ và tên không đúng !",
            "phone" => "Số điện thoại không đúng !",
            'password' => "Mật khẩu không đúng !",
            "email" => "Email không đúng !",
        );
        $status = true;
        $error = array();
        foreach ($data as $key => $value) {
            if($this->check_regex($value , $pattern[$key]) == false){
                $error[$key] = $message[$key];
                $status = false;
            }
        }
        return array(
            "status" => $status,
            "error" => $error
        );
    }
}