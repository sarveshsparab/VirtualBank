<?php
include("connect_db.php");
include("core.php");
if(isset($_POST["transid"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$ref_transid=$_POST['transid'];
	$retarray = array();
	$counter=0;
	$srnr=1;
	$query_run=mysql_query("SELECT * FROM `transaction` WHERE `ref_transid`='$ref_transid'");
	while($query_data=mysql_fetch_assoc($query_run)){
		$retarray[$counter][0]=$srnr;
		$temp_id=$query_data['id'];
		$temp_data=mysql_fetch_assoc(mysql_query("SELECT * FROM `user_info` WHERE `id`='$temp_id'"));
		$retarray[$counter][1]=$temp_data['firstname'];
		$retarray[$counter][2]=$query_data['amount'];
		$retarray[$counter][3]=$query_data['approval'];
		$srnr++;
		$counter++;
	}
	echo json_encode($retarray);
}
?>