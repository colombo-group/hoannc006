<?php 
function checkLogin($account, $password){
	$sql = "SELECT id, username, fullname, email, level FROM users WHERE email = '$account' OR username = '$account' AND password = '$password'";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	if($count == 1){
		$user = mysql_fetch_assoc($query);
		return array(
			'status' => true,
			'user' => $user
			);
	}else{
		return false;
	}
	
}

function get_list($sql){
	$query = mysql_query($sql);
	$data = array();
	while ($row = mysql_fetch_assoc($query)) {
		$data[] = $row;
	}
	return $data;
}
function insert($table, $data = array()){
	$fields = '';
	$values = '';
	foreach ($data as $field => $value) {
			$fields .= $field. ',';
			$values .= "'".addslashes($value)."',";
		}	
	$fields = trim($fields, ',');
    	$values = trim($values, ',');
    	$sql = "INSERT INTO {$table}($fields) VALUES ({$values})";
    	return mysql_query($sql);
}

function update($table, $id, $data = array()){
	$set = '';
	foreach ($data as $field => $value) {
			$set .=  $field."= "."'".addslashes($value)."',";
		}	
	$set = trim($set, ',');
    	$sql = "UPDATE $table SET $set WHERE id = '$id'";
    	return mysql_query($sql);
}
function getInfo($email){
	$sql = "SELECT username,level, fullname FROM users WHERE email = '$email'";
	$query = mysql_query($sql);
	$data = mysql_fetch_assoc($query);
	return $data;
}
function getUser($id){
	$sql = "SELECT * FROM users WHERE id = '$id'";
	$query = mysql_query($sql);
	$data = mysql_fetch_assoc($query);
	return $data;
}
function getListUser(){
	$sql = "SELECT * FROM users";
	$query = mysql_query($sql);
	$data = array();
	while ($row = mysql_fetch_assoc($query)) {
		$data[] = $row;
	}
	return $data;
}

function getCountUser(){
	$sql = "SELECT * FROM users";
	$query = mysql_query($sql);
	return mysql_num_rows($query);
}

function getUserLimit($start, $limit){
	$sql = "SELECT * FROM users LIMIT $start, $limit";	
	$query = mysql_query($sql);
	$data = array();
	while ($row = mysql_fetch_assoc($query)) {
		$data[] = $row;
	}
	return $data;
}
function add($data){

}
function delete($id){
	$sql = "DELETE FROM users WHERE id = '$id'";
	return mysql_query($sql);
}



function getListUserIntroduce($id){
	$sql = "SELECT username FROM users WHERE presenter = '$id'";
	$query = mysql_query($sql);
	$data = array();
	while ($row = mysql_fetch_assoc($query)) {
		$data[] = $row;
	}
	return $data;
}
 // function sort_create_up(){
 // 	$sql = "SELECT * FROM users ORDER BY create_at DESC";
 // 	return get_list($sql);
 // }
// Sort
?>