<?php
include("connect_db.php");
include("core.php");

if(isset($_POST["username"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$uname=sanitize($_POST["username"]);
	$results = mysql_query("SELECT * FROM user_info WHERE username='$uname'");
	$username_exist = mysql_num_rows($results); 
	//$userdata = mysql_fetch_assoc($results);
	//$email=$userdata["email_id"];
	
	if($username_exist) {
		die('<font color="#339900">Username Found</font>');
		//session_start();
		//$_SESSION['email_id'] = $email;
	}else{
		die('<font color="#FF0000">Such user does not exist</font>');
	}
	//mysqli_close($connecDB);
}
?>