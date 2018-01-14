<?php
include("connect_db.php");
include("core.php");
if(isset($_POST["email"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$email_id=sanitize($_POST["email"]);
	$results = mysql_query("SELECT * FROM user_info WHERE email_id='$email_id'");
	$email_exist = mysql_num_rows($results); 
	if($email_exist) {
		die('<font color="#FF0000">Email already regsitered</font> &nbsp; &nbsp; <img src="imgs/not-available.png" />');
	}else{
		die('<font color="#339900">OKAY</font> &nbsp; &nbsp; <img src="imgs/available.png" />');
	}
	//mysqli_close($connecDB);
}
if(isset($_POST["username"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$uname=sanitize($_POST["username"]);
	$results = mysql_query("SELECT * FROM user_info WHERE username='$uname'");
	$username_exist = mysql_num_rows($results); 
	if($username_exist) {
		die('<font color="#FF0000">Username already taken &nbsp; &nbsp; <img src="imgs/not-available.png" /></font>');
	}else{
		die('<font color="#339900">OKAY &nbsp; &nbsp; <img src="imgs/available.png" /></font>');
	}
	//mysqli_close($connecDB);
}
?>