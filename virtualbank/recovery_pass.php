<?php
include("connect_db.php");
include("core.php");
$username=sanitize($_POST["username"]);
$pass = substr(str_shuffle(md5(time())),0,10);
$pass_md5=md5($pass);
$userid=mysql_query("UPDATE `user_info` SET `password`='$pass_md5' WHERE `username`='$username'");

$to_query= mysql_query("SELECT `email_id` FROM `user_info` WHERE `username`='$username'");
$to_data=mysql_fetch_assoc($to_query);
$to=$to_data['email_id'];
$subject = 'CodeCrypt : Password Recovery';
$message = 'Hello '.$to_data['firstname']."\r\n"."\r\n".'Your new password is : '.$pass."\r\n"."\r\n".'It is recommended that you change this password ASAP.'."\r\n"."\r\n".'This is a automatically machine generated E-Mail, Please Do Not Reply back at this address';
$headers = 'From: noreply@codecrypt.co' . "\r\n" .
    'Reply-To: noreply@codecrypt.co' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
	
$message1="\r\n"."CodeCrypt Webmaster.";

mail($to, $subject, $message.$message1, $headers);

?>