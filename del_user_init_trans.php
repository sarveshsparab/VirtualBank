<?php
include("connect_db.php");
include("core.php");
if(isset($_POST["transid"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$transid=$_POST['transid'];
	$temp_data=mysql_fetch_assoc(mysql_query("SELECT * FROM `transaction` WHERE `transid`='$transid'"));
	if($temp_data['approval']==0){
		$del_intail_query="DELETE FROM `transaction` WHERE `transid`='$transid'";
		$del_intail_query_run=mysql_query($del_intail_query);
		$del_affected_others_query="DELETE FROM `transaction` WHERE `ref_transid`='$transid'";
		$del_affected_others_query_run=mysql_query($del_affected_others_query);
		echo '<font color="white" size="-4">success</font>';
	} else {
		echo '<font color="white" size="-4">failure</font>';
	}
}
?>