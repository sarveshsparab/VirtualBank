<?php
include("connect_db.php");
include("core.php");

if(isset($_POST["password"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$user_id=sanitize($_POST["user_id"]);
	$upass=md5(sanitize($_POST["password"]));
	$query = "SELECT * FROM `user_info` WHERE `id`='$user_id'";
	$userdata = mysql_fetch_assoc(mysql_query($query));
	$savedpass=$userdata["password"];
	
	if($savedpass!=$upass) {
		die('<font color="#FF0000" size="-1"> Invalid Password &nbsp; &nbsp; <img src="imgs/not-available.png" /></font>');
	}else{
		die('<font color="#339900" size="-1">Accepted &nbsp; &nbsp; <img src="imgs/available.png" /></font>');
	}
	//mysqli_close($connecDB);
}
?>

			