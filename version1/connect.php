<?php 
define("DB_HOST", 'localhost');
define("DB_USERNAME", 'root');
define("DB_PASSWORD", 'mysql@adminhoan');
define("DB_DATABASE", 'hoannc006');
$connect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die('Not connect DB');
$db = mysql_select_db(DB_DATABASE,$connect) or die('Not select DB');
//Luu tru UTF 8
mysql_query('SET NAMES UTF8',$connect);
?>