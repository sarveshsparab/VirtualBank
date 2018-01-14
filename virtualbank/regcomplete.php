<?php
include("core.php");
include("connect_db.php");
$username=sanitize($_POST['username']);
$password=md5(sanitize($_POST['password']));
$email=sanitize($_POST['email']);
$firstname=sanitize($_POST['firstname']);
$lastname=sanitize($_POST['lastname']);
$gender=sanitize($_POST['gender']);
$contact=sanitize($_POST['contact']);
$visit_count=0;
switch($gender)
{
	case 1: $gender="Male";
	break;
	case 2: $gender="Female";
	break;
	case 3: $gender="Other";
	break;
}

$sql= "INSERT INTO `user_info`(`firstname`, `lastname`, `username`, `password`, `email_id` , `gender` , `contact` , `visit_count`) VALUES ('$firstname', '$lastname', '$username','$password', '$email', '$gender', '$contact', '$visit_count')"; 
$add_user=mysql_query($sql)or die(mysql_error());

?>
