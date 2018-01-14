<?php
include("connect_db.php");
include("core.php");
$t=array();
if(isset($_POST['rest_user'])){
	$t=$_POST['rest_user'];
}
array_push($t,$_POST['first_user']);

if(count($t)!=count(array_unique($t))){
	echo '<font color="white">0</font>';
} else {
	echo '<font color="white">1</font>';

	session_start();
	$initiator_id= $_SESSION['user_id'];
	$initiator_type="receivable";
	$initiator_ref_trans_id=0;
	$initiator_approval=0;

	$descrip=$_POST['descrip'];
	$transdate=$_POST['transactiondate'];

	$first_user=$_POST['first_user'];
	$first_amt=$_POST['first_amt'];

	$others_type="payable";
	$others_approval=0;

	$sum=$first_amt;
	if(!empty($_POST['rest_amt'])) {
		foreach($_POST['rest_amt'] as $cnt => $temp) {
			$sum=$sum+$_POST['rest_amt'][$cnt];
		}
	}
	$initiator_query="INSERT INTO `transaction`(`id`, `ref_transid`, `date`, `descrip`, `type`, `amount`, `approval`) VALUES ('$initiator_id','$initiator_ref_trans_id','$transdate','$descrip','$initiator_type','$sum','$initiator_approval')";	
	$initiator_query_run=mysql_query($initiator_query);

	$others_ref_trans_id= mysql_insert_id();

	$first_query="INSERT INTO `transaction`(`id`, `ref_transid`, `date`, `descrip`, `type`, `amount`, `approval`) VALUES ('$first_user','$others_ref_trans_id','$transdate','$descrip','$others_type','$first_amt','$others_approval')";
	$first_query_run=mysql_query($first_query);

	if(!empty($_POST['rest_amt']) && !empty($_POST['rest_user'])) {
			foreach($_POST['rest_user'] as $cnt => $temp) {
				$rest_user=$_POST['rest_user'][$cnt];
				$rest_amt=$_POST['rest_amt'][$cnt];
			
				$rest_query="INSERT INTO `transaction`(`id`, `ref_transid`, `date`, `descrip`, `type`, `amount`, `approval`) VALUES ('$rest_user','$others_ref_trans_id','$transdate','$descrip','$others_type','$rest_amt','$others_approval')";
				$rest_query_run=mysql_query($rest_query);
			}
	}
}
?>