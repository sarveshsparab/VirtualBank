<?php
include("connect_db.php");
include("core.php");
if(isset($_POST["cat"])&&isset($_POST["transid"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$cat=$_POST['cat'];
	$bank_transid=$_POST['transid'];
	//update the approval in bank
	$bank_approval_update_query_run=mysql_query("UPDATE `bank` SET `approval`='$cat' WHERE `bank_transid`='$bank_transid'");
	//update transaction table
	$temp_bank_data=mysql_fetch_assoc(mysql_query("SELECT * FROM `bank` WHERE `bank_transid`='$bank_transid'"));
	$temp_userid=$temp_bank_data['id'];
	$bank_approval_update_query_run=mysql_query("UPDATE `transaction` SET `approval`='$cat' WHERE `ref_transid`='$bank_transid' AND `id`='$temp_userid'");
	echo '<font color="#FFFFFF" size="-4">cat-- '.$cat.' -- transid-- '.$bank_transid.'</font>';
}
?>