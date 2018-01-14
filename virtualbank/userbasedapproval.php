<?php
include("connect_db.php");
include("core.php");
if(isset($_POST["cat"])&&isset($_POST["transid"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$cat=$_POST['cat'];
	$transid=$_POST['transid'];
	//update the approval
	$approval_update_query_run=mysql_query("UPDATE `transaction` SET `approval`='$cat' WHERE `transid`='$transid'");
	
	if($cat==1){
		$temp_trans_query=mysql_query("SELECT * FROM `transaction` WHERE `transid`='$transid'");
		$temp_trans_data=mysql_fetch_assoc($temp_trans_query);
		$temp_ref_transid=$temp_trans_data['ref_transid'];
		$init_trans_query=mysql_query("SELECT * FROM `transaction` WHERE `transid`='$temp_ref_transid'");
		$init_trans_data=mysql_fetch_assoc($init_trans_query);
		$init_amt=$init_trans_data['amount'];
		$others_amt=0;
		$others_trans_query=mysql_query("SELECT * FROM `transaction` WHERE `ref_transid`='$temp_ref_transid' && `approval`=1");
		while($others_trans_data=mysql_fetch_assoc($others_trans_query)){
			$others_amt=$others_amt+$others_trans_data['amount'];
		}
		if($others_amt==$init_amt){
			$approval_init_update_query_run=mysql_query("UPDATE `transaction` SET `approval`='$cat' WHERE `transid`='$temp_ref_transid'");
		}
	}
	
	
	
	
	echo '<font color="#FFFFFF" size="-4">cat-- '.$cat.' -- transid-- '.$transid.'</font>';
}

?>