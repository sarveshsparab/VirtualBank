<?php
include("connect_db.php");
include("core.php");
if(isset($_POST["transid"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$transid=$_POST['transid'];
	$retarray = array();
	$counter=0;
	$srnr=1;
	$query_run_data=mysql_fetch_assoc(mysql_query("SELECT * FROM `transaction` WHERE `transid`='$transid'"));
	$ref_transid=$query_run_data['ref_transid'];
	$initiator_query_run_data=mysql_fetch_assoc(mysql_query("SELECT * FROM `transaction` WHERE `transid`='$ref_transid'"));
	$initiator_type=$initiator_query_run_data['type'];
	$initiator_amount=$initiator_query_run_data['amount'];
	$initiator_status="Initiator";
	$initiator_id=$initiator_query_run_data['id'];
	$temp_data=mysql_fetch_assoc(mysql_query("SELECT * FROM `user_info` WHERE `id`='$initiator_id'"));
	$initiator_name=$temp_data['firstname'];
	
	$retarray[0][0]=$srnr;
	$retarray[0][1]=$initiator_name;
	$retarray[0][2]=$initiator_amount;
	$retarray[0][3]=$initiator_type;
	$retarray[0][4]=$initiator_status;
	
	$srnr++;
	$counter++;
	
	$new_query_run=mysql_query("SELECT * FROM `transaction` WHERE `ref_transid`='$ref_transid'");
	
	while($new_query_data=mysql_fetch_assoc($new_query_run)){
		$retarray[$counter][0]=$srnr;
		$new_temp_id=$new_query_data['id'];
		$new_temp_data=mysql_fetch_assoc(mysql_query("SELECT * FROM `user_info` WHERE `id`='$new_temp_id'"));
		$retarray[$counter][1]=$new_temp_data['firstname'];
		$retarray[$counter][2]=$new_query_data['amount'];
		$retarray[$counter][3]=$new_query_data['type'];
		$retarray[$counter][4]=$new_query_data['approval'];
		$srnr++;
		$counter++;
	}
	echo json_encode($retarray);
}
?>