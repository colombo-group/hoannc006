<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 06/06/2016
 * Time: 12:02
 */

class Input{
    function get($item){
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }
    
    function all(){
        if(isset($_POST)){
            return $_POST;
        }
        return '';

    }
    
    public function file($name){
        if(isset($_FILES[$name])){
            $file = $_FILES[$name];
            return $file;
        }else{
            return '';
        }
    }

}