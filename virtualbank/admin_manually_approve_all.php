<?php 
include("connect_db.php");
include("core.php");
	$hist_query=mysql_query("SELECT * FROM `transaction`");
	$original_amt=0;
	$net_amt=0;
	$ref_transid=0;
	while($hist_data=mysql_fetch_assoc($hist_query)){
		if($hist_data['ref_transid']==0){
			$original_amt=$hist_data['amount'];
			$net_amt=0;
			$ref_transid=$hist_data['transid'];
		}else if($hist_data['ref_transid']==$ref_transid){
			if($hist_data['approval']==0){
				$tmp_transid=$hist_data['transid'];
				$appr_query=mysql_query("UPDATE `transaction` SET `approval`=1 WHERE `transid`='$tmp_transid'");
				$net_amt=$net_amt+$hist_data['amount'];
			}else if($hist_data['approval']==1){
				$net_amt=$net_amt+$hist_data['amount'];
			}
			if($original_amt==$net_amt){
				$appr_query=mysql_query("UPDATE `transaction` SET `approval`=1 WHERE `transid`='$ref_transid'");
			}
		}
	}
?>