<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 05/06/2016
 * Time: 22:31
 */
require 'Database.php';

class User {
    protected $_db;
    protected $_data;
    protected $_table = "users";
    function __construct()
    {
        $this->_db = Database::getInstance();
    }
    public function create($fields = array()){
        return $this->_db->insert($this->_table, $fields);
    }

    public function update($id, $fields = array()){
        return $this->_db->update($this->_table, $id, $fields);
    }
    
    function checkLogin($account, $password){
        $sql = "SELECT id, username, fullname, email, level FROM users 
                WHERE email = '$account' OR username = '$account' AND password = '$password'";
        $count = $this->_db->getCountByQuery($sql);
        if($count == 1){
            $user = $this->_db->getByQuery($sql);
            return array(
                'status' => true,
                'user' => $user
            );
        }else{
            return false;
        }

    }
    
    function getInfo($email){
        $sql = "SELECT username,level, fullname FROM users WHERE email = '$email'";
        $data = $this->_db->getByQuery($sql);
        return $data;
    }
    function getUser($id){
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $data = $this->_db->getByQuery($sql);
        return $data;

    }
    function getListUser(){
        $sql = "SELECT * FROM users";
        $data = $this->_db->getByQuery($sql);
        return $data;

    }
    
    function getCountUser(){
        $sql = "SELECT * FROM users";
        return $this->_db->getCountByQuery($sql);
    }

    function getUserLimit($start, $limit){
        $sql = "SELECT * FROM users LIMIT $start, $limit";
        $data = $this->_db->getByQuery($sql);

        return $data;
    }
  
    function delete($id){
        $sql = "DELETE FROM users WHERE id = '$id'";
        return $this->_db->delete($sql);
    }
    function getListUserIntroduce($id){
        $sql = "SELECT username FROM users WHERE presenter = '$id'";
        $data = $this->_db->getByQuery($this->_table, $sql);
        return $data;
    }
}


?>