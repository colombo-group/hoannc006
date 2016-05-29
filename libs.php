<?php 
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

function paging($total_value, $value_number_limit, $url, $page_current){
    $html ='';
    if($total_value > 0){
        $value_start = ($page_current - 1) * $value_number_limit;
        $value_end = $page_current * $value_number_limit;
        if($value_end > $total_value){
            $value_end = $total_value;
        }
        $number_page = ceil($total_value / $value_number_limit);
        if($number_page > 1){
            if($page_current > 1){ 
                $page = $page_current - 1;
                $html .= '<div class="inline page-button" style = "width:70px;"><a href = "'.$url.'?page='.$page.'"><button class = "button">Prev</button></a></div>';
            }
            if($number_page > 8){
                if($page_current <= 4){
                    $page_start = 1;
                    $page_finish = $number_page > 5 ? 5 : $number_page; 
                }elseif($page_current > 4 && $page_current < $number_page - 3){
                    $page_start = $page_current - 2;
                    $page_finish = $page_current + 2;
                }else {
                    $page_start = $page_current > 4 ? $number_page - 4 : 1;
                    $page_finish = $number_page;
                }
                if($page_current > 4){
                    $html .= '<div class="inline page-button"><a href = "'.$url.'?page=1"><button class = "button">1</button></a></div>';
                    $html .= "<b>...</b>";
                }   
            }else {
                $page_start = 1;
                $page_finish = $number_page;
            }
            for($i = $page_start; $i <= $page_finish; $i++){
                if($i == $page_current){
                    $html .= '<div class="inline page-button"><button class = "button" style = "background-color: red">'.$i.'</button></div>';
                }else{
                    $html .= '<div class="inline page-button"><a href = "'.$url.'?page='.$i.'"><button class = "button">'.$i.'</button></a></div>';
                }
            }
            if($number_page > 8){
                if($page_current < $number_page - 3){
                    $html .= "<b>...</b>";
                    $html .= '<div class="inline page-button"><a href = "'.$url.'?page='.$number_page.'"><button class = "button">'.$number_page.'</button></a></div>';
                }
            }
            if($page_current < $number_page){
                $page = $page_current + 1;
                $html .= '<div class = "inline page-button" style = "width:70px;"><a href = "'.$url.'?page='.$page.'"><button class = "button">Next</button></a></div>';
            }
        }
        return array(
            'start' => $value_start,
            'end' => $value_end,
            'html' => $html
            );   
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
    $error = array();
    foreach ($data as $key => $value) {
            if(check_regex($value , $pattern[$key]) == false){
                        $error[$key] = $message[$key];
                        $status = false;
            }       
    }
    return array(
        "status" => $status,
        "error" => $error
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
                            $fullname = vi_to_en($value2);
                            $name = explode(" ", $fullname);
                            $index = sizeof($name) - 1;
                            $sorttable_data[$key] = strtolower($name[$index]);
                        }else{
                            $sorttable_data[$key] = vi_to_en($value2);    
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

?>