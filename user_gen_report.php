<link rel="stylesheet" href="css/googlecss.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/templatemo_misc.css">
<link rel="stylesheet" href="css/templatemo_style.css">
<link rel="stylesheet" href="css/first.css" />
<link rel="stylesheet" href="css/forms.css" />
<link rel="stylesheet" href="css/newforms.css" /> 
<?php
include("connect_db.php");
include("core.php");
$userid=$_GET['userid'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$report_query=mysql_query("SELECT * FROM `transaction` WHERE `id`='$userid' AND `date`>='$start_date' AND `date`<='$end_date'");
$report_numrows=mysql_num_rows($report_query);
if($report_numrows==0){
	?>
	<br><b>You have no transactions in the provided interval!!</b>
	<?php
}else{
	?>
    <br>
    <table border="0" cellspacing="2" cellpadding="5" class="sky-form">
        <thead style="border-bottom:thin #999999 solid; color:#363636">
            <tr style="font-weight:bold" align="center" valign="middle" height="30">
                <td width="75"> &nbsp; Sr. No. &nbsp;</td>
                <td width="85"> &nbsp; Trans. ID.  &nbsp;</td>
                <td width="85"> &nbsp; Date &nbsp; </td>
                <td width="180"> &nbsp; Trans. Details &nbsp; </td>
                <td width="100"> &nbsp; Amount &nbsp; </td>
                <td width="100"> &nbsp; Appr. Amt. &nbsp; </td>
                <td width="90"> &nbsp; Type &nbsp; </td>
            </tr>
        </thead>
        <tbody class="mynew-table">	    
	<?php
	$hist_srnr=1;
	$p=0;
	$r=0;
	$r_all=0;
	$p_all=0;
	while($reportrow = mysql_fetch_array($report_query)) {
		?>
        <tr height="25" align="center" valign="middle">
            <td width="75"><abbr title="Sr. No." style="border-bottom:none"><?php echo $hist_srnr;?></abbr></td>
            <td width="85"><font color="#2da5da"><abbr title="Trans. ID." style="border-bottom:none"><?php echo $reportrow['transid'];?></abbr></font></td>
            <td width="85"><abbr title="Date" style="border-bottom:none"><?php echo $reportrow['date'];?></abbr></td>
            <td width="180"><abbr title="Description" style="border-bottom:none"><?php echo $reportrow['descrip'];?></abbr></td>
            <td width="100"><abbr title="Amount" style="border-bottom:none"><?php echo $reportrow['amount'];?></abbr></td>	
            <?php
				if($reportrow['approval']==0){  // all pending
					if($reportrow['ref_transid']>=100000){ //bank trans
						$temp_appr_amt=0;
					} else if($reportrow['ref_transid']==0) { //self initiated trans
						$temp_appr_amt=0;
						$temp_transid=$reportrow['transid'];
					   $temp_query_run=(mysql_query("SELECT * FROM `transaction` WHERE `ref_transid`='$temp_transid' AND `approval`=1"));
						while($temp_query_data=(mysql_fetch_assoc($temp_query_run))){
							$temp_appr_amt=$temp_appr_amt+$temp_query_data['amount'];
							
							/*if($temp_appr_amt==$hist_data['amount']){
								$transid_reset=$hist_data['transid'];
								$reset_appr_of_init_query_run=mysql_query("UPDATE `transaction` SET `approval`=1 WHERE `transid`='$transid_reset'");
							}*/
							
						}
					} else if($reportrow['ref_transid']!=0) { //my payable not approved
						$temp_appr_amt=0;
					}
				} else if($reportrow['approval']==1){ // all approved
					$temp_appr_amt=$reportrow['amount'];
				} else if($reportrow['approval']==2){ // all rejected
					$temp_appr_amt=0;
				}
				$final_appr_amts[$reportrow['transid']]=$temp_appr_amt;
			?>
			<td width="100"><abbr title="Approved Amount" style="border-bottom:none"><?php echo $temp_appr_amt;?></abbr></td>
            <td width="90"><abbr title="Type" style="border-bottom:none"><?php echo $reportrow['type'];?></abbr></td>
        </tr>
        <?php
		if($reportrow['type']=="receivable"){
			$r_all=$r_all+$reportrow['amount'];
			$r=$r+$final_appr_amts[$reportrow['transid']];
		} else if($reportrow['type']=="payable"){
			$p_all=$p_all+$reportrow['amount'];
			$p=$p+$final_appr_amts[$reportrow['transid']];
		}
		$hist_srnr++;
	}
	?>
    </tbody>
    </table>
    <hr>
    <hr>
    <b><u>NOTE:</u></b> Without <font color="#FF0000">APPROVAL FROM OTHERS</font> the "Final Result" <font color="#FF0000">WONT</font> be ACCURATE
    <br>
    <br>
    <b><u>Final Result (based on current approvals):</u></b><br>
    <?php
	if($r>$p){
		?>
			<font color="#2D2DFF" size="+2">Net Receivable:&nbsp;&nbsp;&nbsp;</font><b><font color="red" size="+1"><?php echo $r-$p;?></font></b>
		<?php
	} else if($r<$p) {
		?>
			<font color="#2D2DFF" size="+2">Net Payable:&nbsp;&nbsp;&nbsp;</font><b><font color="red" size="+1"><?php echo $p-$r;?></font></b>
		<?php
	} else {
		?>
			<font color="#2D2DFF" size="+2">Your account is <b>SETTLED</b></font>
		<?php	
	}
	?>
	<br>
    <br>
    <b><u>Final Result (If all approved):</u></b><br>
	<?php
	if($r_all>$p_all){
		?>
			<font color="#2D2DFF" size="+2">Net Receivable:&nbsp;&nbsp;&nbsp;</font><b><font color="red" size="+1"><?php echo $r_all-$p_all;?></font></b>
		<?php
	} else if($r_all<$p_all) {
		?>
			<font color="#2D2DFF" size="+2">Net Payable:&nbsp;&nbsp;&nbsp;</font><b><font color="red" size="+1"><?php echo $p_all-$r_all;?></font></b>
		<?php
	} else {
		?>
			<font color="#2D2DFF" size="+2">Your account is <b>SETTLED</b></font>
		<?php	
	}
	?>
    <hr>
    <?php
}
?>


