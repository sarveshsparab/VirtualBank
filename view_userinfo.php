<?php
include("connect_db.php");
include("core.php");
if(isset($_REQUEST["userid"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$userid=$_POST["userid"];
	$userrow_query=mysql_query("SELECT * FROM `user_info` WHERE `id`= '$userid'");
	$retarray = array();
	$counter=0;
	while($userrow = mysql_fetch_array($userrow_query)) {
		$retarray[$counter][0]=$userrow['id'];
		$retarray[$counter][1]=$userrow['username'];
		$retarray[$counter][2]=$userrow['email_id'];
		$retarray[$counter][3]=$userrow['firstname'];
		$retarray[$counter][4]=$userrow['lastname'];
		$retarray[$counter][5]=$userrow['contact'];
		$retarray[$counter][6]=$userrow['gender'];
		$retarray[$counter][7]=$userrow['visit_count'];
		$retarray[$counter][8]=$userrow['reg_time'];
		$counter++;
	}
	echo json_encode($retarray);
}
?>