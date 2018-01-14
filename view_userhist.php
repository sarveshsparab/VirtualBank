<?php
include("connect_db.php");
include("core.php");
if(isset($_REQUEST["userid"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	$userid=$_POST["userid"];
	$retarray = array();
	$counter=0;
	$hist_query=mysql_query("SELECT * FROM (SELECT * FROM `transaction` WHERE `id`='$userid' ORDER BY `transid` DESC LIMIT 20) sub ORDER BY `transid` ASC");
	while($hist_data=mysql_fetch_assoc($hist_query)){
		$retarray[$counter][0]=$hist_data['transid'];
		$retarray[$counter][1]=$hist_data['descrip'];
		$retarray[$counter][2]=$hist_data['date'];
		$retarray[$counter][3]=$hist_data['type'];
		$retarray[$counter][4]=$hist_data['amount'];
		if($hist_data['ref_transid']==0){
			$retarray[$counter][5]="Initiated";
			if($hist_data['approval']==1){
				$retarray[$counter][6]="All Approved";
			} else if($hist_data['approval']==0){
				$retarray[$counter][6]="Pending";
			} else if($hist_data['approval']==2){
				$retarray[$counter][6]="All Rejected";
			}
		} else if($hist_data['ref_transid']<100000){
			$retarray[$counter][5]="Others Initiated";
			if($hist_data['approval']==1){
				$retarray[$counter][6]="User Approved";
			} else if($hist_data['approval']==0){
				$retarray[$counter][6]="User Pending";
			} else if($hist_data['approval']==2){
				$retarray[$counter][6]="User Rejected";
			}
		} else {
			$retarray[$counter][5]="Admin trans";
			if($hist_data['approval']==1){
				$retarray[$counter][6]="Admin Approved";
			} else if($hist_data['approval']==0){
				$retarray[$counter][6]="Admin Pending";
			} else if($hist_data['approval']==2){
				$retarray[$counter][6]="Admin Rejected";
			}
		}
		$counter++;
	}
	echo json_encode($retarray);
}

?>