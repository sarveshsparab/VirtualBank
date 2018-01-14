<!DOCTYPE html>
<html>
<head>
<?php
include("connect_db.php");
include("core.php");
session_start();
if(isset($_SESSION['user_id'])){
$user_id=$_SESSION['user_id'];
$query = "SELECT * FROM `user_info` WHERE `id`='$user_id'";
$userdata = mysql_fetch_assoc(mysql_query($query));
$password=$userdata["password"];
$firstname=$userdata["firstname"];
$lastname=$userdata["lastname"];
$username=$userdata["username"];
$email=$userdata["email_id"];
$contact=$userdata["contact"];
$gender=$userdata["gender"];
$visit_count=$userdata["visit_count"];
} else { 
header('Location: alreadylogout.php');
}
?>
	<title>Welcome... Admin</title>
	<link rel="stylesheet" href="css/googlecss.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/templatemo_misc.css">
	<link rel="stylesheet" href="css/templatemo_style.css">
    <link rel="stylesheet" href="css/first.css" />
	<link rel="stylesheet" href="css/forms.css" />
	<link rel="stylesheet" href="css/newforms.css" />
    <style type="text/css">
	.mynew-table tr:hover{
		background-color:#DADADA;
		font-weight:bold;
	}
	</style>
        <script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/jquery.modal.js"></script>
        <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/moment.min.js"></script>
		<script src="js/jquery.form.min.js"></script>
        <script src="js/jquery.flexslider.js"></script>
        <script src="js/jquery.singlePageNav.js"></script>
        <script src="js/jquery.print.js"></script>
</head>
<body id="mainbody">
<div class="responsive-navigation visible-sm visible-xs">
        <a href="#" class="menu-toggle-btn">
            <i class="fa fa-bars fa-2x"></i>
        </a>
        <div class="navigation responsive-menu">
            <ul>
                <li class="home"><a href="#templatemo">PROFILE</a></li>
	            <li class="about"><a href="#about">PENDING APPROVALS</a></li>
	            <li class="services"><a href="#services">DISTRIBUTE MONEY</a></li>
	            <li class="portfolio"><a href="#portfolio" >ADMIN SUMMARY</a></li>
	            <li class="contact"><a href="#contact">OVERALL SUMMARY</a></li>
                <li class="signout"><a href="#signout">SIGN OUT</a></li>
            </ul> <!-- /.main_menu -->
        </div> <!-- /.responsive_menu -->
</div> <!-- /responsive_navigation -->

<div id="main-sidebar" class="hidden-xs hidden-sm">
		<div class="logopic">
		<img src="imgs/site_logo.jpg" height="150" width="300"/>
        </div>
        <div class="logo">
			<h2>Admin Control</h2>
			<span>Your Complete Financial Portfolio</span>
		</div>
		<div class="navigation">
	        <ul class="main-menu">
	            <li class="home"><a href="#templatemo">PROFILE</a></li>
	            <li class="about"><a href="#about">PENDING APPROVALS</a></li>
	            <li class="services"><a href="#services">DISTRIBUTE MONEY</a></li>
	            <li class="portfolio"><a href="#portfolio" >ADMIN SUMMARY</a></li>
	            <li class="contact"><a href="#contact">OVERALL SUMMARY</a></li>
                <li class="signout"><a href="#signout">SIGN OUT</a></li>
	        </ul>
		</div>
</div> 

<div id="main-content">
	<div id="templatemo">
		<div class="main-slider">
           <div class="container-fluid">
           		<div id="profile" class="section-content" style="height:575px">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<h2>Profile</h2>
							</div>
                       		 <b><u><font size="+1" >Your Profile Details:</font></u></b>
                        <hr>
                        <b>First Name:   </b><?php echo $firstname;?><br>
                        <b>Last Name:   </b><?php echo $lastname;?><br>
                        <b>Username:   </b><?php echo $username;?><br>
                        <b>Email ID:   </b><?php echo $email;?><br>
                        <b>Contact:   </b><?php echo $contact;?><br>
                        <b>Gender:   </b><?php echo $gender;?><br>
                        <br>
                        <div align="right">
                        <hr>
                        <b><u><font size="+1" >Update your Profile</font></u></b><br>
                        
        				 <button type="submit" class="button"><a href="#passwordupdateform" class="modal-opener" style="color:black; text-decoration:none">Password</a></button>
                         
               <script type="text/javascript">
			$(document).ready(function() {
				$("#oldpassword").keyup(function (e) {;
					var password = $(this).val();
					var user_id = <?php echo $user_id;?>;
					if(password.length < 4){$("#check-status-password").html('');return;}
					if(password.length >= 4){
						$("#check-status-password").html('<img src="imgs/ajax-loader.gif" />');
						var retflag='<font color="#FF0000" size="-1"> Invalid Password &nbsp; &nbsp; <img src="imgs/not-available.png" /></font>';
						$.post('passmatch.php', {'password':password , 'user_id':user_id}, function(data) {
						  	$("#check-status-password").html(data);
						  	if(data == retflag) {
								   $("#updatepassconfirm").prop('disabled' , true);
						  	} else {
								   $("#updatepassconfirm").prop('disabled' , false);
						  	}
						});
					}
				});	
			});
			</script>
                         
               <form method="post" action="" id="passwordupdateform" class="sky-form sky-form-modal" />
						<header>Password Update</header>				
				<fieldset>	
                	<section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input autocomplete="off" type="password" name="oldpassword" placeholder="Old Password" id="oldpassword" />
							<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                            <div class="status-message" align="right" id="check-status-password"></div>
						</label>
					</section>				
					<section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input autocomplete="off" type="password" name="newpassword" placeholder="New Password" id="password" />
							<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
						</label>
					</section>
					<section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input autocomplete="off" type="password" name="newpasswordConfirm" placeholder="Confirm new password" />
							<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
						</label>
					</section>
                        </fieldset>
                        <footer>
					<input type="submit" class="button" name="updatepassconfirm" id="updatepassconfirm" value="Update"/>
				</footer>
                        </form>
                        
               <script type="text/javascript">
			$(function()
			{
				$("#passwordupdateform").validate(
				{					
					rules:
					{
						oldpassword:
						{
							required: true,
							minlength: 3,
							maxlength: 20
						},
						newpassword:
						{
							required: true,
							minlength: 3,
							maxlength: 20
						},
						newpasswordConfirm:
						{
							required: true,
							minlength: 3,
							maxlength: 20,
							equalTo: '#password'
						},
					},
					messages:
					{
						oldpassword:
						{
							required: 'Please enter your password'
						},
						newpassword:
						{
							required: 'Please enter your password'
						},
						newpasswordConfirm:
						{
							required: 'Please enter your password one more time',
							equalTo: 'Please enter the same password as above'
						},
					},	
					errorPlacement: function(error, element)
					{
						error.insertAfter(element.parent());
					}
				});
			});			
		</script>
        
                <?php
                            if(isset($_POST['updatepassconfirm']) && $_POST['updatepassconfirm'] != '') {
								$newpassword=md5(sanitize($_POST['newpassword']));
								$oldpassword=md5(sanitize($_POST['oldpassword']));
								if($oldpassword!=$password) {
									echo '<script type="text/javascript">alert("Incorrect old password!");</script>';
								} else {
									$updateuser= mysql_query("UPDATE user_info SET password='$newpassword',reg_time=now() WHERE id='$user_id'"); 
									echo '<script type="text/javascript">parent.window.location.reload(true);</script>';
								}
							}
						?>
                    	</div>
					</div>
				</div>
    	    </div>
		</div>
    </div>

<div class="container-fluid">
	<div id="about" class="section-content">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Pending Approvals</h2>
				</div>
                <div id="pend_appr_div"></div>
                <p><u><b>Information:</b></u></p>
                This following list shows all money <strong>ACCEPTED by YOU</strong> .... Please approve or deny them ASAP!!<br><br>
                <?php
                $approve_query="SELECT * FROM `bank` WHERE  `approval`=0";
				$approve_query_run=mysql_query($approve_query);
				$approve_numrows=mysql_num_rows($approve_query_run);
				if($approve_numrows == 0){
				?><br><b>You have no approvals pending!!</b>
				<?php
				} else {
				?>
                <table border="0" cellspacing="2" cellpadding="5" class="sky-form" id="printtable">
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="120"> &nbsp; Bank Trans. ID. &nbsp;</td>
                			<td width="80"> &nbsp; Date  &nbsp;</td>
                            <td width="150"> &nbsp; Trans. Details &nbsp; </td>
                            <td width="100"> &nbsp; Paid By &nbsp; </td>
                            <td width="100"> &nbsp; Amount &nbsp; </td>
                            <td width="90"> &nbsp; Mode &nbsp; </td>
                            <td width="200" colspan="2"> &nbsp; Status &nbsp; </td>
            			</tr>
        			</thead>
                    <tbody class="mynew-table">	
                    <?php
						while($approve_data=mysql_fetch_assoc($approve_query_run)){
						?>
                        	<tr height="25" align="center" valign="middle" id="rownum<?php echo $approve_data['bank_transid'];?>">
                            	<td width="120"><font color="#2da5da"><abbr title="Bank Trans. ID." style="border-bottom:none"><?php echo $approve_data['bank_transid'];?></abbr></font></td>
                                <td width="80"><abbr title="Date" style="border-bottom:none"><?php echo $approve_data['date'];?></abbr></td>
                                <td width="150"><abbr title="Description" style="border-bottom:none"><?php echo $approve_data['descrip'];?></abbr></td>
                                <?php
									$ref_userid=$approve_data['id'];
									$ref_userdata=mysql_fetch_assoc(mysql_query("SELECT * FROM `user_info` WHERE `id`='$ref_userid'"));
									$ref_username=$ref_userdata['firstname'];
								?>
                                <td width="100"><font color="#CC00FF"><abbr title="Paid By" style="border-bottom:none"><?php echo $ref_username;?></abbr></font></td>
                                <td width="100"><abbr title="Amount" style="border-bottom:none"><?php echo $approve_data['amount'];?></abbr></td>
                                <td width="90"><abbr title="Mode" style="border-bottom:none"><?php echo $approve_data['type'];?></abbr></td>
                                <td width="100" id="a<?php echo $approve_data['bank_transid'];?>"><a style="text-decoration:none; color:#27C600" href="javascript&#58;statusupdate(1,'<?php echo $approve_data['bank_transid'];?>')">Approve</a></td>
                            <td width="100" id="r<?php echo $approve_data['bank_transid'];?>"><a style="text-decoration:none; color:#da2d4f" href="javascript&#58;statusupdate(2,'<?php echo $approve_data['bank_transid'];?>')">Reject</a></td>
                            </tr>
                        <?php	
						}
					?>
                    </tbody>
                 </table>
                 <?php	
				}
				?>
                <div align="right">
                <br><br>
                <button type="button" style="background-color:#2A2A2A;" onClick="window.location.reload(true);" ><font color="#FFFFFF">Refresh Table</font></button>
                </div>
                <script type="text/javascript">
				function statusupdate(cat,transid) {
					if(cat==2){
						var str1='Reject';
					} else if(cat==1) {
						var str1='Approve';
					}
					if(confirm("You confirm to "+str1+" with Bank Trans. id : "+transid)){
						jQuery('#r'+transid).empty();
						jQuery('#a'+transid).empty();
						if(cat==2){
							jQuery('#a'+transid).html('<font color="#da2d4f">REJECTED</font>');
							jQuery('#r'+transid).append('<img src="imgs/not-available.png" />');
						} else if(cat==1) {
							jQuery('#a'+transid).html('<font color="#27C600">APPROVED</font>');
							jQuery('#r'+transid).append('<img src="imgs/available.png" />');
						}
						$.post('adminbasedapproval.php', {'cat':cat , 'transid':transid}, function(data) {
							$("#pend_appr_div").html(data);
						});
					}
				}
				</script>
            </div> 
		</div>		
    </div>
                	
	<div id="services" class="section-content">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Distribute Money</h2>
				</div> 
                <p><u><b>Information:</b></u></p>
                Distribute the money <strong>IMMEDIATELY</strong> after you get it... ... ... These are <strong>PAYMENTS FROM ADMIN</strong> to others...<br><br>
                
                <div id="distributestatus"> </div>
                <div id="distributediv" class="body-trans body">
                <form method="post" action="distributetrans.php" id="distributeform" name="distributeform" class="sky-form" >
                	<header>Payment from Admin</header>
						<fieldset>					
                            <section>
								<label class="input">
                                	<i class="icon-append icon-shopping-cart"></i>
                                	<input autocomplete="off" type="text" name="distributemode" id="distributemode" placeholder="Mode of payment..... (Cash / Internet Transfer / Cheque)"/>
                                    <b class="tooltip tooltip-bottom-right">Specify Mode of Payment</b>
								</label>
							</section>
                             <section>
								<label class="input">
                                	<i class="icon-append icon-calendar"></i>
                                	<input autocomplete="off" type="text" name="distributedate" id="distributedate" placeholder="Transaction Date"/>
                                    <b class="tooltip tooltip-bottom-right">Specify Date of Payment</b>
								</label>
							</section>
                		</fieldset>
                        <fieldset id="itemRows">
                        List people who you are paying...
                        <div class="row">
                            <section class="col col-6">
                            	<label class="select">
                                	<select name="first_user" id="first_user">
                                    	<?php 
											$userquery=mysql_query("SELECT * FROM `user_info` ORDER BY firstname");
											$num_users=mysql_num_rows($userquery);
											if($num_users>0) {
												while($retuserinfo=mysql_fetch_assoc($userquery)) {
													if($retuserinfo['username']!="admin") {
														?>
														<option value="<?=$retuserinfo['id'];?>"><?php echo $retuserinfo['firstname'];?>
														<?php
													}
												}
											}
										?>
                                    </select>
                                    <i></i>
								</label>
                            </section>
                            <section class="col col-4">
                            	<label class="input">
                                	<i class="icon-append icon-money"></i>
                                	<input autocomplete="off" type="text" name="first_amt" id="first_amt" placeholder="Amount"/>
                                    <b class="tooltip tooltip-bottom-right">Specify Amount</b>
								</label>
                            </section>
                            <section class="col col-2">
                            	<font color="#2da5da" size="+1"> <a href="javascript&#58;addRow(distributeform,'<?php echo $num_users; ?>')" style="text-decoration:none">ADD</a></font>
                            </section>
                        </div>
                        </fieldset>
                        <footer>
		                    <input type="submit" class="button" name="distributesubmit" id="distributesubmit" value="Done"/>
                            <button type="button" class="button button-secondary" onClick="cantran();" >Cancel</button>
						</footer>
				</form>                
                </div>
                <?php
				if(isset($_POST['distributesubmit'])&&$_POST['distributesubmit'] != ''){
                	session_start();
					$_SESSION['user_id']=$user_id;
				}
				?>
                <script type="text/javascript">
				var rowNum = 0;
				var rowCnt =0;
				function addRow(frm,numofuser) {
					rowNum++;
					
					var row='<div id="rowNum'+rowNum+'"><section class="col col-6"><label class="select"><select name="rest_user[]" id="rest_user[]"><code><?php $userquery=mysql_query("SELECT * FROM `user_info` ORDER BY firstname");$num_users=mysql_num_rows($userquery);if($num_users>0) { while($retuserinfo=mysql_fetch_assoc($userquery)) { if($retuserinfo['username']!="admin") { $retuserid=$retuserinfo['id'];$retfirstname=$retuserinfo['firstname']; ?></code> <option value="'+"<?php echo $retuserid;?>"+'"><code><?php echo $retfirstname;?></code> <code><?php } } } ?></code> </select><i></i></label></section><section class="col col-4"><label class="input"><i class="icon-append icon-money"></i><input autocomplete="off" type="text" name="rest_amt[]" id="rest_amt[]" placeholder="Amount"/><b class="tooltip tooltip-bottom-right">Specify Amount</b></label> </section><section class="col col-2"><font color="#da2d4f" size="+1"> <a href="javascript&#58;removeRow('+rowNum+')" style="text-decoration:none">REM</a></font></section></div>';
					
					if((rowCnt+1)<(numofuser-1)) {
						jQuery('#itemRows').append(row);
						rowCnt ++;
					}
				}
				function removeRow(rnum) {
					rowCnt --;
					jQuery('#rowNum'+rnum).remove();
				}
				</script>
                <script type="text/javascript">
				$(function(){
					$('#distributeform').validate(
						{					
							rules:
							{
								first_amt:
								{
									required: true,
									number: true
								},
								first_user:
								{
									required: true
								},
								distributemode:
								{
									required: true
								},
								distributedate:
								{
									required: true,
									date: true
								},
								"rest_amt[]":
								{
									required: true,
									number: true
								}
							},
							messages:
							{
								first_amt:
								{
									required: 'Enter Amount',
									number: 'Invalid!'
								},
								first_user:
								{
									required: 'Select a User'
								},
								distributemode:
								{
									required: 'Please specify mode of payment'
								},
								distributedate:
								{
									required: 'Select a date!',
									date: 'Invalid date!'
								},
								"rest_amt[]":
								{
									required: 'Enter Amount',
									number: 'Invalid!'
								}
							},
							submitHandler: function(form)
							{
								$(form).ajaxSubmit(
								{
									target: '#distributestatus',
									success: function(resp)
									{	
										var case1='<font color="white">1</font>';
										var case0='<font color="white">0</font>';
										var case2='<font color="white">2</font>';
										if(resp==case1){
											var newform='<form id="newlyformed1" name="newlyformed1" class="sky-form sky-form-modal-new"><div class="message"><i class="icon-ok"></i><p>Transaction Successfully ADDED!!</p><p>Page will Automatically refresh in 5 seconds</p></div></form>';
											jQuery("#distributestatus").append(newform);
											$("#newlyformed1").addClass('submited');
											jQuery("#mainbody").append('<div id="user_repeat" class="sky-form-modal-overlay"></div>');
											form = $('#newlyformed1');
											$('#user_repeat').fadeIn();
											form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
											setTimeout(function(){
												window.location.reload(true);
											},4000)
										} else if(resp==case0) {
											var newform='<form id="newlyformed2" name="newlyformed2" class="sky-form sky-form-modal-new"><div class="messagefailed"><i class="icon-remove"></i><p>Transaction Failed!!</p><p>Some people are selected more than once!!</p><p>Please make changes accordingly!</p></div></form>';
											jQuery("#distributestatus").append(newform);
											$("#newlyformed2").addClass('submited');
											jQuery("#mainbody").append('<div id="user_repeat" class="sky-form-modal-overlay"></div>');
											$('#user_repeat').on('click', function()
											{
												$('#user_repeat').fadeOut();
												$('.sky-form-modal-new').fadeOut();
											});
											form = $('#newlyformed2');
											$('#user_repeat').fadeIn();
											form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
										} else if(resp==case2) {
											var newform='<form id="newlyformed3" name="newlyformed3" class="sky-form sky-form-modal-new"><div class="messagefailed"><i class="icon-remove"></i><p>Transaction Failed!!</p><p>ADMIN has Insufficient Funds!!!</p><p>Please make changes accordingly!</p></div></form>';
											jQuery("#distributestatus").append(newform);
											$("#newlyformed3").addClass('submited');
											jQuery("#mainbody").append('<div id="user_repeat" class="sky-form-modal-overlay"></div>');
											$('#user_repeat').on('click', function()
											{
												$('#user_repeat').fadeOut();
												$('.sky-form-modal-new').fadeOut();
											});
											form = $('#newlyformed3');
											$('#user_repeat').fadeIn();
											form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
										}
									}
									});
								},
								errorPlacement: function(error, element)
								{
									error.insertAfter(element.parent());
								}
							});
						});			
				</script>
                <script type="text/javascript">
				$(function() {
					$('#distributedate').datepicker({
						dateFormat: 'yy.mm.dd',
						prevText: '<i class="icon-chevron-left"></i>',
						nextText: '<i class="icon-chevron-right"></i>'
					});
				});	
				</script>
                <script type="text/javascript">
				function cantran() {
					if(confirm("Sure you want to cancel transaction?")) {
						$("#distributeform").hide();
						var newform='<form id="canceltrans" name="canceltrans" class="new-form"><div class="messagefailed"><i class="icon-remove"></i><p>Transaction Cancelled!!</p><p>Page will Automatically refresh in 5 seconds</p></div></form>';
						jQuery("#distributediv").append(newform);
						$("#canceltrans").addClass('submited');
						setTimeout(function(){
							window.location.reload(true);
						},4000)
					}
				}
				</script>
                
                
    		</div> 
    	</div> 
    </div>
				

	<div id="portfolio" class="section-content">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Admin Summary</h2>
				</div> 
                <div style="float:right">
                <img src="imgs/print_button.png" id="printbutton" onClick="printData();"/>&nbsp;&nbsp;&nbsp;&nbsp;<img src="imgs/report_green_button2.png" id="gen_report_img" onClick="gen_report();" height="35" width="125"/>
                </div>
                <p><u><b>Information:</b></u></p>
                The following list denotes transactions done by admin in <strong>ACCEPTING</strong> and <strong>DISTRIBUTING</strong> money: <br><br>
                <?php
                $adm_query="SELECT * FROM `bank`";
				$adm_query_run=mysql_query($adm_query);
				$adm_numrows=mysql_num_rows($adm_query_run);
				if($adm_numrows == 0){
					$to=0;
					$from=0;
				?>
                	<br><b>You have no Records!!!!</b>
				<?php
				} else {
				?>
                <div id="printdiv">
				<table border="0" cellspacing="2" cellpadding="5" class="sky-form" id="printtable">
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="130"> &nbsp; Bank Trans. ID. &nbsp;</td>
                			<td width="80"> &nbsp; Date  &nbsp;</td>
                            <td width="150"> &nbsp; Trans. Details &nbsp; </td>
                            <td width="100"> &nbsp; User &nbsp; </td>
                            <td width="100"> &nbsp; Amount &nbsp; </td>
                            <td width="90"> &nbsp; Mode &nbsp; </td>
                            <td width="150"> &nbsp; Approval &nbsp; </td>
                            <td width="150"> &nbsp; Generated on &nbsp; </td>
            			</tr>
        			</thead>
                    <tbody class="mynew-table">
                    <?php
						$to=0;
						$from=0;
						while($adm_data=mysql_fetch_assoc($adm_query_run)){
						?>
                        	<tr height="25" align="center" valign="middle" id="rownumadm<?php echo $adm_data['bank_transid'];?>">
                            	<td width="130"><font color="#2da5da"><abbr title="Bank Trans. ID." style="border-bottom:none"><?php echo $adm_data['bank_transid'];?></abbr></font></td>
                                <td width="80"><abbr title="Date" style="border-bottom:none"><?php echo $adm_data['date'];?></abbr></td>
                                <td width="150"><abbr title="Description" style="border-bottom:none"><?php echo $adm_data['descrip'];?></abbr></td>
                                <?php
									$temp_userid=$adm_data['id'];
                                	$temp_userdata=mysql_fetch_assoc(mysql_query("SELECT * FROM `user_info` WHERE `id`='$temp_userid'"));
									$temp_name=$temp_userdata['firstname'];
								?>
                                <td width="100"><font color="#CC00FF"><abbr title="User" style="border-bottom:none"><?php echo $temp_name;?></abbr></font></td>
                                <td width="100"><abbr title="Amount" style="border-bottom:none"><?php echo $adm_data['amount'];?></abbr></td>
                                <td width="90"><abbr title="Mode" style="border-bottom:none"><?php echo $adm_data['type'];?></abbr></td>
                                <?php
									if($adm_data['approval']==0){//pending
									?>
                                    	<td width="150"><a style="color:#609" href="#about">Pending</a></td>
                                    <?php
									} else if($adm_data['approval']==1){//approved
									?>
                                    	<td width="150"><font color="#00B700">Accepted</font></td>
                                    <?php
									} else if($adm_data['approval']==2){//rejected
									?>
                                    	<td width="150"><font color="#FF0000">Rejected</font></td>
                                    <?php
									}
                                ?>
                                <td width="150"><abbr title="Entry Updated" style="border-bottom:none"><?php echo $adm_data['bank_transtime'];?></abbr></td>
                        	</tr>
                        <?php
							if($adm_data['descrip']=="Payment to Admin" && $adm_data['approval']==1){
								$to=$to+$adm_data['amount'];
							} else if($adm_data['descrip']=="Payment From Admin" && $adm_data['approval']==1){
								$from=$from+$adm_data['amount'];
							}
						}
					?>
                    </tbody>
                </table>
                <br>
                <b><u>NOTE:</u></b> Without <font color="#FF0000">APPROVING</font> the "Final Result" <font color="#FF0000">WONT</font> be ACCURATE
                <br>
                <hr>
                <b><u>Final Result:</u></b><br>
                <?php
				if($to>$from){
				?>
                	<font color="#2D2DFF" size="+2">Yet to DISTRIBUTE : &nbsp;&nbsp;&nbsp;</font><b><font color="red" size="+1"><?php echo $to-$from;?></font></b>
                <?php
				} else if($to<$from) {
				?>
                	<font color="#2D2DFF" size="+2">Yet to ACCEPT :&nbsp;&nbsp;&nbsp;</font><b><font color="red" size="+1"><?php echo $from-$to;?></font></b>
                <?php
				} else {
				?>
                	<font color="#2D2DFF" size="+2">Your account is <b>SETTLED</b></font>
                <?php	
				}
                ?>
                <?php
				}
				?>
                </div>
                <button type="button" style="background-color:#2A2A2A; float:right" onClick="window.location.reload(true);" ><font color="#FFFFFF">Refresh Table</font></button>
                <script type="text/javascript">
				function printData(){
					$("#printdiv").print();
				}
				</script>
                <script type="text/javascript">
				function gen_report(){
					jQuery("#mainbody").append('<div id="gen_report_div" class="sky-form-modal-overlay"></div>');
					form = $('#gen_report_form');
					$('#gen_report_div').fadeIn();
					form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
				}
				</script>
                <form id="gen_report_form" class="sky-form-modal sky-form" method="post">
                	<header>Report</header>				
					<fieldset>	
                		<section>
							<label class="input">
								<i class="icon-append icon-calendar"></i>
                                <input autocomplete="off" type="text" name="startdate" id="startdate" placeholder="Start Date"/>
                                <b class="tooltip tooltip-bottom-right">Specify Start Date</b>
                                <div class="status-message" align="left" id="start_date_status"></div>
							</label>
						</section>				
						<section>
							<label class="input">
								<i class="icon-append icon-calendar"></i>
                                <input autocomplete="off" type="text" name="enddate" id="enddate" placeholder="End Date"/>
                                <b class="tooltip tooltip-bottom-right">Specify End Date</b>
                                <div class="status-message" align="left" id="end_date_status"></div>
							</label>
						</section>
                    </fieldset>
                    <footer>
                        <input class="button" name="gen_report_button" id="gen_report_button" value="          Create report" onClick="gen_report_submit('<?php echo $user_id;?>');">
                        <button class="button button-secondary" onClick="gen_report_cancel();">Back</button>
					</footer>
                </form>
                <script type="text/javascript">
				function gen_report_submit(userid){
					var start_date=document.getElementById('startdate').value;
					var end_date=document.getElementById('enddate').value;
					if(end_date!='' && start_date!=''){
						if(end_date>=start_date){
							$('#gen_report_div').fadeOut();
							$('.sky-form-modal').fadeOut();
							alert("Feature only available in PRO version!");
							/*jQuery("#mainbody").append('<div id="gen_report_div2" class="sky-form-modal-overlay"></div>');
							$('#gen_report_div2').on('click', function()
							{
								$('#gen_report_div2').fadeOut();
								$('.sky-form-modal-new').fadeOut();
							});
							form = $('#gen_report_table');
							$('#gen_report_div2').fadeIn();
							form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
							$('#gen_report_body').empty();
							$('#gen_report_body').html('<tr align="center" height="100"><td colspan=7><img src="imgs/ajax-loader.gif" /></td></tr>');
							$.post('user_gen_report.php', {'userid' : userid , 'start_date' : start_date , 'end_date' : end_data}, function(data) {
								var x=data;
								alert(x);
								$('#gen_report_body').empty();
								
								var newrow_record='';
								jQuery('#gen_report_body').append(newrow_record);
							}, "json");*/
						} else {
							alert("Invalid Date range");
						}
					} else {
						if(start_date==''){
							$("#end_date_status").html('');
							$("#start_date_status").html('<font color="red" size="-2">Enter Start Date</font>');
						} else if(end_date==''){
							$("#start_date_status").html('');
							$("#end_date_status").html('<font color="red" size="-2">Enter End Date</font>');
						}
					}
				}
				</script>
                <table border="0" cellspacing="2" cellpadding="5" background="img/white.jpg" class="sky-form sky-form-modal-new" id="gen_report_table" >
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="75"> &nbsp; Trans. ID. &nbsp; </td>
                			<td width="100"> &nbsp; Date  &nbsp;</td>
                            <td width="150"> &nbsp; Descrip  &nbsp;</td>
                            <td width="100"> &nbsp; Amount  &nbsp;</td>
                            <td width="100"> &nbsp; Type &nbsp;</td>
                            <td width="100"> &nbsp; Approval &nbsp;</td>
                            <td width="100"> &nbsp; Misc &nbsp;</td>
            			</tr>
        			</thead>
                    <tbody id="gen_report_body" class="mynew-table">
                                    	
                    </tbody>
                 </table>
                <script type="text/javascript">
				function gen_report_cancel() {
					$('#gen_report_div').fadeOut();
					$('.sky-form-modal').fadeOut();
				}
				</script>
                <script type="text/javascript">
				$(function() {
					$('#startdate').datepicker({
						dateFormat: 'yy.mm.dd',
						prevText: '<i class="icon-chevron-left"></i>',
						nextText: '<i class="icon-chevron-right"></i>'
					});
				});	
				$(function() {
					$('#enddate').datepicker({
						dateFormat: 'yy.mm.dd',
						prevText: '<i class="icon-chevron-left"></i>',
						nextText: '<i class="icon-chevron-right"></i>'
					});
				});	
				</script>
    		</div> 
		</div>
	</div>
    
    <div id="contact" class="section-content">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Overall Summary</h2>
				</div> 
                <p><u><b>Information:</b></u></p>
                Here you get to know evrything about everyone..... <br><br>
                <?php
                $user_query="SELECT * FROM `user_info` ORDER BY firstname";
				$user_run=mysql_query($user_query);
				$user_numofrows=mysql_num_rows($user_run);
				if($user_numofrows==0){
				?>
                	<br><b>No registered users!!!!</b>
                <?php
				} else { 
				?>
                	<table border="0" cellspacing="2" cellpadding="5" class="sky-form">
        				<thead style="border-bottom:thin #999999 solid; color:#363636">
           					<tr style="font-weight:bold" align="center" valign="middle" height="30">
                				<td width="65"> &nbsp; User Id &nbsp;</td>
                				<td width="90"> &nbsp; Name  &nbsp;</td>
                                <td width="110"> &nbsp; Trans. History &nbsp; </td>
                           		<td width="100"> &nbsp; Mode &nbsp; </td>
                           		<td width="100"> &nbsp; Amount &nbsp; </td>
                                <td width="100"> &nbsp; Statistics &nbsp; </td>
            				</tr>
        				</thead>
                        <tbody class="mynew-table">
                        <?php
						$serialnum=1;
                        while($userrow = mysql_fetch_array($user_run)) {
						?>
                        	<tr height="25" align="center" valign="middle" id="rownumuser<?php echo $userrow['id'];?>">
                            	<td width="65"><font color="#2da5da"><abbr title="User ID." style="border-bottom:none"><?php echo $userrow['id'];?></abbr></font></td>
                                <td width="90"><abbr title="Name" style="border-bottom:none"><a style="text-decoration:none; color:#C0F" href="javascript&#58;viewuser('<?php echo $userrow['id'];?>');"><?php echo $userrow['firstname'];?></a></abbr></td>
                                <td width="110"><a style="text-decoration:none; color:#0C3" href="javascript&#58;userhist('<?php echo $userrow['id'];?>');">History</a></td>
                                <?php
								$overall_temp_userid=$userrow['id'];
                                $overall_query_run=mysql_query("SELECT * FROM `transaction` WHERE `id`='$overall_temp_userid'");
								$r=0;
								$p=0;
								$net_initiated=0;
								$net_accept_mine=0;
								$net_reject_mine=0;
								$net_I_approved=0;
								$net_I_rejected=0;
								$net_I_pending=0;
								$net_I_paid_admin_a=0;
								$net_I_paid_admin_r=0;
								$net_I_recd_admin=0;
								while($overall_trans_data=mysql_fetch_assoc($overall_query_run)){
									if($overall_trans_data['approval']==1){
										if($overall_trans_data['ref_transid']==0){ // I initiated and all approved
											$r=$r+$overall_trans_data['amount'];
											$net_initiated++;
											$net_accept_mine++;
										} else if($overall_trans_data['ref_transid']<100000) { // I accepted someone else's request
											$p=$p+$overall_trans_data['amount'];
											$net_I_approved++;
										} else { // bank transaction
											if($overall_trans_data['type']=="receivable"){
												$r=$r+$overall_trans_data['amount'];
												$net_I_paid_admin_a++;
											} else if($overall_trans_data['type']=="payable"){
												$p=$p+$overall_trans_data['amount'];
												$net_I_recd_admin++;
											}
										}
									} else if($overall_trans_data['approval']==0){
										if($overall_trans_data['ref_transid']==0){
											$net_initiated++;
											$ref_count_appr=0;
											$ref_count_pend=0;
											$overall_temp_transid=$overall_trans_data['transid'];
											$overall_temp_ref_run=mysql_query("SELECT * FROM `transaction` WHERE `ref_transid`='$overall_temp_transid'");
											while($overall_temp_ref_userdata=mysql_fetch_assoc($overall_temp_ref_run)){
												if($overall_temp_ref_userdata['approval']==1){
													$r=$r+$overall_temp_ref_userdata['amount'];
													$ref_count_appr++;
												} else if($overall_temp_ref_userdata['approval']==0){
													$ref_count_pend++;
												}
											}
											if($ref_count_pend==0 && $ref_count_appr==0){
												$net_reject_mine++;
											}
										} else if($overall_trans_data['ref_transid']<100000) {
											$net_I_pending++;
										}
									} else if($overall_trans_data['approval']==2){
										if($overall_trans_data['ref_transid']<100000) {
											$net_I_rejected++;
										} else {
											$net_I_paid_admin_r++;
										}
									}
								}
								if($r>$p){
									$overall_balance_amt=$r-$p;
									$overall_balance_mode="Receivable";
								} else if($r<$p){
									$overall_balance_amt=$p-$r;
									$overall_balance_mode="Payable";
								} else {
									$overall_balance_amt=$r-$p;
									$overall_balance_mode="Settled";
								}
								?>
                                <td width="100"><abbr title="Mode" style="border-bottom:none"><?php echo $overall_balance_mode;?></abbr></td>
                                <td width="100"><abbr title="Amount" style="border-bottom:none"><?php echo $overall_balance_amt;?></abbr></td>
                                <td width="100"><abbr title="Stats" style="border-bottom:none"><a style="text-decoration:none; color:#2da5da" href="javascript&#58;viewstats('<?php echo $net_initiated;?>','<?php echo $net_accept_mine;?>','<?php echo $net_I_approved;?>','<?php echo $net_I_pending;?>','<?php echo $net_I_rejected;?>','<?php echo $net_I_paid_admin_a;?>','<?php echo $net_I_paid_admin_r;?>','<?php echo $net_I_recd_admin;?>','<?php echo $net_reject_mine;?>');">Stats</a></abbr></td>
                            </tr>
						<?php	
							$serialnum++;
						}
						?>
                        </tbody>
                     </table>
                <?php
				}
				?>
                <button type="button" id="admin_approve" style="background-color:#2A2A2A; float:right" onClick="javascript:admin_approve_all();" ><font color="#FFFFFF">Approve All</font></button><br><br>
                <button type="button" style="background-color:#2A2A2A; float:right" onClick="window.location.reload(true);" ><font color="#FFFFFF">Refresh Table</font></button>
                <script>
				  $(document).ready(function(){
					$('#admin_approve').click(function(){
						if(confirm("Do you want to confirm all pending requests?")){
						   $.ajax({
							  url: 'admin_manually_approve_all.php',
							  success: function(data) {
								//$('#result123').html(data);
								alert("approved all");
							  }
							});
					   	}
					});
				  });
				</script>
               
                <script type="text/javascript">
				function userhist(userid){
					jQuery("#mainbody").append('<div id="histinfo" class="sky-form-modal-overlay"></div>');
					$('#histinfo').on('click', function()
					{
						$('#histinfo').fadeOut();
						$('.sky-form-modal-new').fadeOut();
					});
					form = $('#histtable');
					$('#histinfo').fadeIn();
					form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
					$('#histtable_body').empty();
					$('#histtable_body').html('<tr align="center" height="100"><td colspan=7><img src="imgs/ajax-loader.gif" /></td></tr>');
					$.post('view_userhist.php', {'userid':userid}, function(data) {
						var x=data;
						$('#histtable_body').empty();
						for(var i=0;i<x.length;i++){
							var newrowhist='<tr align="center" valign="middle"><td width="110">'+x[i][0]+'</td><td width="150">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="100">'+x[i][3]+'</td><td width="100">'+x[i][4]+'</td><td width="150">'+x[i][5]+'</td><td width="150">'+x[i][6]+'</td></tr>';
							jQuery('#histtable_body').append(newrowhist);
						}
					}, "json");
				}
				</script>
                <table border="0" cellspacing="2" cellpadding="5" background="img/white.jpg" class="sky-form sky-form-modal-new" id="histtable">
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="110"> &nbsp; Trans.ID. &nbsp; </td>
                			<td width="150"> &nbsp; Descrip  &nbsp;</td>
                            <td width="100"> &nbsp; Date  &nbsp;</td>
                            <td width="100"> &nbsp; Type  &nbsp;</td>
                            <td width="100"> &nbsp; Amount  &nbsp;</td>
                            <td width="150"> &nbsp; Category  &nbsp;</td>
                            <td width="150"> &nbsp; Status  &nbsp;</td>
            			</tr>
        			</thead>
                    <tbody id="histtable_body" class="mynew-table">
                                    	
                    </tbody>
                </table>
                <script type="text/javascript">
				function viewstats(a,b,c,d,e,f,g,h,i){
					jQuery("#mainbody").append('<div id="statsinfo" class="sky-form-modal-overlay"></div>');
					$('#statsinfo').on('click', function()
					{
						$('#statsinfo').fadeOut();
						$('.sky-form-modal').fadeOut();
					});
					form = $('#statstable');
					$('#statsinfo').fadeIn();
					form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
					$('#statstable_body').empty();
					var p=a-b-i;
					var init_success=(b/a)*100;
					var adm_success=(f/(f+g))*100;
					var newrowstat='<tr align="center" valign="middle" height="20"><td width="150">Total User Initiated</td><td width="300">'+a+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Accepted completely</td><td width="300">'+b+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Rejected completely</td><td width="300">'+i+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Partially Pending</td><td width="300">'+p+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Initiation Success %</td><td width="300">'+init_success+'</td></tr><tr align="center" valign="middle" height="2" bgcolor="black"><td></td><td></td></tr><tr align="center" valign="middle" height="20"><td width="150">User Approved</td><td width="300">'+c+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">User Pending</td><td width="300">'+d+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">User Rejected</td><td width="300">'+e+'</td></tr><tr align="center" valign="middle" height="2" bgcolor="black"><td></td><td></td></tr><tr align="center" valign="middle" height="20"><td width="150">Paid to Admin Approved</td><td width="300">'+f+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Paid to Admin Rejected</td><td width="300">'+g+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Accepted from Admin</td><td width="300">'+h+'</td></tr><tr align="center" valign="middle" height="5" bgcolor="black"><td></td><td></td></tr><tr align="center" valign="middle" height="20"><td width="150">USER RELIABLITY %</td><td width="300">'+adm_success+'</td></tr>';
					jQuery('#statstable_body').append(newrowstat);
				}
				</script>
                <table border="0" cellspacing="2" cellpadding="5" background="img/white.jpg" class="sky-form sky-form-modal" id="statstable" >
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="150"> &nbsp; Field &nbsp; </td>
                			<td width="300"> &nbsp; Details  &nbsp;</td>
            			</tr>
        			</thead>
                    <tbody id="statstable_body" class="mynew-table">
                                    	
                    </tbody>
                </table>
                <script type="text/javascript">
				function viewuser(userid) {
					jQuery("#mainbody").append('<div id="userinfo" class="sky-form-modal-overlay"></div>');
					$('#userinfo').on('click', function()
					{
						$('#userinfo').fadeOut();
						$('.sky-form-modal').fadeOut();
					});
					form = $('#userinfotable');
					$('#userinfo').fadeIn();
					form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
					$('#user_tbl_body').empty();
					$('#user_tbl_body').html('<tr align="center" height="100"><td colspan=2><img src="imgs/ajax-loader.gif" /></td></tr>');
					$.post('view_userinfo.php', {'userid':userid}, function(data) {
						var x=data;
						$('#user_tbl_body').empty();
						var newrowuser='<tr align="center" valign="middle" height="20"><td width="150">User ID.</td><td width="300">'+x[0][0]+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Username</td><td width="300">'+x[0][1]+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Email ID.</td><td width="300">'+x[0][2]+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">First Name</td><td width="300">'+x[0][3]+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Last Name</td><td width="300">'+x[0][4]+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Contact</td><td width="300">'+x[0][5]+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Gender</td><td width="300">'+x[0][6]+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Visits</td><td width="300">'+x[0][7]+'</td></tr><tr align="center" valign="middle" height="20"><td width="150">Last Visit / Update</td><td width="300">'+x[0][8]+'</td></tr>';
						jQuery('#user_tbl_body').append(newrowuser);
					}, "json");
				}
				</script>
                <table border="0" cellspacing="2" cellpadding="5" background="img/white.jpg" class="sky-form sky-form-modal" id="userinfotable" >
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="150"> &nbsp; Field &nbsp; </td>
                			<td width="300"> &nbsp; Details  &nbsp;</td>
            			</tr>
        			</thead>
                    <tbody id="user_tbl_body" class="mynew-table">
                                    	
                    </tbody>
                </table>
    		</div> 
		</div>
	</div>

	<div id="signout" class="section-content" style="height:300px">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Sign Out</h2>
				</div> 
                <form class="sky-form">
                <button type="button" class="button button-secondary" onClick="signoutfunc();" ><font color="#FFFFFF">Sign Out</font></button>
                </form>
                <br>
                <div id="signoutdiv"> </div>
                <script type="text/javascript">
				function signoutfunc() {
					var check1=<?php echo $approve_numrows;?>;
					if(check1==0){
						var to=<?php echo $to;?>;
						var from=<?php echo $from;?>;
						if(to==from){
							var newform='<form id="newlyformed4" name="newlyformed4" class="sky-form sky-form-modal-new"><div class="message"><i class="icon-signout"></i><p>Signing Out!!</p><p>Thank You for using this app!!</p><p>Visit soon</p><p>Page will Automatically Redirect...</p></div></form>';
							jQuery("#signoutdiv").append(newform);
							$("#newlyformed4").addClass('submited');
							jQuery("#mainbody").append('<div id="signout_success" class="sky-form-modal-overlay"></div>');
							form = $('#newlyformed4');
							$('#signout_success').fadeIn();
							form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
							$.post( "logout.php" );
							setTimeout(function(){
								window.location.replace("index.php");
							},4000)
						} else {
							$('#signoutdiv').html('<br><br><font size="+1" color="orange">Account NOT Settled...</font><br><b><font color="red" size="+1">Sign Out - </font><font size="+2" color="red"><u>DISABLED!!!</u></font></b>');
						}
					} else {
						$('#signoutdiv').html('<br><br><font size="+1" color="orange">You still have pending approvals..</font><br><b><font color="red" size="+1">Sign Out - </font><font size="+2" color="red"><u>DISABLED!!!</u></font></b>');
					}
				}
				</script>
             </div>
		</div> 
	</div> 
</div>
 <!-- /.container-fluid -->



		
        <div class="site-footer">
			<div class="first-footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="social-footer">
								<ul>
									<li><a href="https://www.facebook.com/sarvesh.thunder" class="fa fa-facebook"></a></li>
									<li><a href="https://twitter.com/sarveshsparab" class="fa fa-twitter"></a></li>
									<li><a href="http://www.linkedin.com/profile/view?id=344545064&trk=nav_responsive_tab_profile" class="fa fa-linkedin"></a></li>
								</ul>
							</div> 
						</div> 
					</div> 
				</div> 
			</div> 
			<div class="bottom-footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<p class="copyright">Copyright &#169; 2014 <a href="https://www.facebook.com/sarvesh.thunder">Sarvesh Parab</a>
                            </p>
						</div>
						<div class="col-md-6 credits">
                        <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">VirtualBank</span> by <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Sarvesh Parab</span> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License</a>.
						</div> 
					</div> 
				</div> 
			</div> 
		</div> 
	</div> <!-- /#main-content -->
    
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51349302-1', 'orgfree.com');
  ga('send', 'pageview');

</script>
</body>
</html>