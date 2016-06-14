<?php 

class Lib{
    function upload($file, $path){
        $error = "";
        $status = false;
        if ($file['name'] != "") {
            $max_size = 5242880;//5Mb
            $name = $file['name'];
            if($file['size'] <= $max_size){
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                if(strcmp($extension, 'jpg') == 0 || strcmp($extension, 'JPG') == 0 ||strcmp($extension, 'png') == 0){
                    if(is_dir($path)){
                        if(move_uploaded_file($file['tmp_name'],$path.$name)){
                            $status = true;
                        }else{
                            $error = "Upload không thành công";
                        }
                    }
                    else {
                        $error =  'Không tồn tại thư mục';
                    }
                }else{
                    $error = "File không đúng định dạng";
                }
            }else{
                $error = "Kích thước file lớn";
            }
            return array(
                'status' => $status,
                'error' => $error,
            );
        }
    }

    function input($name){
        if(isset($_POST[$name])){
            return $_POST[$name];
        }else{
            return '';
        }

    }
    

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

    function find_presender($presenter, $users){
        foreach ($users as $user) {
            if($user['username'] == $presenter || $user['email'] == $presenter){
                return array(
                    'status' => true,
                    'id' => $user['id']
                );
            }
        }
        return array(
            'status' => false,
            'id' => ''
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
        $errors = array();
        foreach ($data as $key => $value) {
            if($this->check_regex($value , $pattern[$key]) == false){
                $error[$key] = $message[$key];
                $status = false;
            }
        }
        return array(
            "status" => $status,
            "error" => $errors
        );
    }

    function vi_to_en($str){
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/', 'A', $str);
        $str = preg_replace('/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/', 'E', $str);
        $str = preg_replace('/(Ì|Í|Ị|Ỉ|Ĩ)/', 'I', $str);
        $str = preg_replace('/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/', 'O', $str);
        $str = preg_replace('/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/', 'U', $str);
        $str = preg_replace('/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/', 'Y', $str);
        $str = preg_replace('/(Đ)/', 'D', $str);
        //$str = str_replace(” “, “-”, str_replace(“&*#39;”,”",$str));
        return $str;
    }
    function sort_array($data, $on, $order = SORT_ASC, $type){
        $new_data = array();
        $sorttable_data = array();
        if(count($data) > 0){
            foreach ($data as $key => $value) {
                if(is_array($value)){
                    foreach ($value as $key2 => $value2) {
                        $index = 0;
                        if($key2 == $on){
                            if($type == 1){
                                $fullname = $this->vi_to_en($value2);
                                $name = explode(" ", $fullname);
                                $index = sizeof($name) - 1;
                                $sorttable_data[$key] = strtolower($name[$index]);
                            }else{
                                $sorttable_data[$key] = $this->vi_to_en($value2);
                            }
                        }
                    }
                }else{
                    $sorttable_data[$key] = $value;
                }
            }
            switch ($order) {
                case SORT_ASC:
                    asort($sorttable_data);
                    break;
                case SORT_DESC:
                    arsort($sorttable_data);
                    break;
            }
            foreach ($sorttable_data as $key => $value) {
                $new_data[$key] = $data[$key];
            }
        }
        return $new_data;
    }
}


?>