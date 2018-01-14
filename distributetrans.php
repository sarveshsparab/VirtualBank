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
	
	$first_amt=$_POST['first_amt'];
	
	$sum=$first_amt;
	if(!empty($_POST['rest_amt'])) {
		foreach($_POST['rest_amt'] as $cnt => $temp) {
			$sum=$sum+$_POST['rest_amt'][$cnt];
		}
	}
	
	$to=0;
	$from=0;
	$bank_check_query=mysql_query("SELECT * FROM `bank` WHERE `approval`=1");
	while($bank_check_data=mysql_fetch_assoc($bank_check_query)){
		if($bank_check_data['descrip']=="Payment to Admin"){
			$to=$to+$bank_check_data['amount'];
		} else if($bank_check_data['descrip']=="Payment From Admin"){
			$from=$from+$bank_check_data['amount'];
		}
	}
	$bank_balance=$to-$from;
	
	if($sum>$bank_balance){
		echo '<font color="white">2</font>';
	} else {
		echo '<font color="white">1</font>';
	
		$first_user=$_POST['first_user'];
	
		$date=$_POST['distributedate'];
		$bank_type=$_POST['distributemode'];
		$descrip="Payment From Admin";
		$approval=1;
		$user_type="payable";
	
		$first_bank_query="INSERT INTO `bank`(`id`, `date`, `descrip`, `amount`, `type`, `approval`) VALUES ('$first_user','$date','$descrip','$first_amt','$bank_type','$approval')";
		$first_bank_query_run=mysql_query($first_bank_query);
	
		$first_ref_trans_id= mysql_insert_id();
	
		$first_trans_query="INSERT INTO `transaction`(`id`, `ref_transid`, `date`, `descrip`, `type`, `amount`, `approval`) VALUES ('$first_user','$first_ref_trans_id','$date','$descrip','$user_type','$first_amt','$approval')";
		$first_trans_query_run=mysql_query($first_trans_query);
	
		if(!empty($_POST['rest_amt']) && !empty($_POST['rest_user'])) {
				foreach($_POST['rest_user'] as $cnt => $temp) {
					$rest_user=$_POST['rest_user'][$cnt];
					$rest_amt=$_POST['rest_amt'][$cnt];
				
					$rest_bank_query="INSERT INTO `bank`(`id`, `date`, `descrip`, `amount`, `type`, `approval`) VALUES ('$rest_user','$date','$descrip','$rest_amt','$bank_type','$approval')";
					$rest_bank_query_run=mysql_query($rest_bank_query);
				
					$rest_ref_trans_id= mysql_insert_id();
				
					$rest_trans_query="INSERT INTO `transaction`(`id`, `ref_transid`, `date`, `descrip`, `type`, `amount`, `approval`) VALUES ('$rest_user','$rest_ref_trans_id','$date','$descrip','$user_type','$rest_amt','$approval')";
					$rest_trans_query_run=mysql_query($rest_trans_query);
				}
		}
	}
	
	
	
	
	
	
	
	
}


?>