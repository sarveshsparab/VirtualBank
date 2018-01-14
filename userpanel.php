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
	<title>Welcome... <?php print $firstname;?></title>
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
	            <li class="about"><a href="#about">ADD NEW TRANSACTION</a></li>
	            <li class="services"><a href="#services">CLEAR DEBT</a></li>
	            <li class="portfolio"><a href="#portfolio" >PENDING APPROVALS</a></li>
	            <li class="contact"><a href="#contact">TRANSACTION HISTORY</a></li>
                <li class="signout"><a href="#signout">SIGN OUT</a></li>
            </ul> <!-- /.main_menu -->
        </div> <!-- /.responsive_menu -->
</div> <!-- /responsive_navigation -->

<div id="main-sidebar" class="hidden-xs hidden-sm">
		<div class="logopic">
		<img src="imgs/site_logo.jpg" height="150" width="300" />
        </div>
		<div class="logo">
			<h2><?php echo $firstname." ".$lastname; ?></h2>
			<span>Your Complete Financial Portfolio</span>
		</div>
		<div class="navigation">
	        <ul class="main-menu">
	            <li class="home"><a href="#templatemo">PROFILE</a></li>
	            <li class="about"><a href="#about">ADD NEW TRANSACTION</a></li>
	            <li class="services"><a href="#services">CLEAR DEBT</a></li>
	            <li class="portfolio"><a href="#portfolio" >PENDING APPROVALS</a></li>
	            <li class="contact"><a href="#contact">TRANSACTION HISTORY</a></li>
                <li class="signout"><a href="#signout">SIGN OUT</a></li>
	        </ul>
		</div>
</div> 

<div id="main-content">
	<div id="templatemo">
		<div class="main-slider">
           <div class="container-fluid">
           		<div id="profile" class="section-content">
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
                        <button type="submit" class="button"><a href="#profileform" class="modal-opener" style="color:black; text-decoration:none">Profile</a></button>
                        
               <form method="post" action="profilenew.php" id="profileform" class="sky-form sky-form-modal" />
						<header>Profile Update</header>				
				<fieldset>					
					<section>
						<label class="input">
							<i class="icon-append icon-envelope-alt"></i>
							<input autocomplete="off" type="email" name="newemail" value="<?php echo $email;?>"/>
							<b class="tooltip tooltip-bottom-right">Email Id</b>
						</label>
					</section>                    
                    <section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input autocomplete="off" type="text" name="newcontact" value="<?php echo $contact;?>" />
							<b class="tooltip tooltip-bottom-right">Contact</b>
						</label>
					</section>
				</fieldset>					
				<fieldset>
					<div class="row">
						<section class="col col-6">
							<label class="input">
								<input autocomplete="off" type="text" name="newfirstname" value="<?php echo $firstname;?>" />
                                <b class="tooltip tooltip-bottom-right">First Name</b>
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<input autocomplete="off" type="text" name="newlastname" value="<?php echo $lastname;?>" />
                                <b class="tooltip tooltip-bottom-right">Last Name</b>
							</label>
						</section>
					</div>
					<section>
						<label class="select">
                        	<select name="newgender">
                            	<?php
								if($gender=="Male") {?>
									<option value="0" />Gender
									<option value="1" selected/>Male
									<option value="2" />Female
									<option value="3" />Other 
									<?php
								} else if($gender=="Female") {?>
									<option value="0" />Gender
									<option value="1" />Male
									<option value="2" selected />Female
									<option value="3" />Other 
									<?php
								} else if($gender=="Other") {?>
									<option value="0" />Gender
									<option value="1" />Male
									<option value="2" />Female
									<option value="3" selected />Other 
									<?php
								}?>
                             </select>
							<i></i>
						</label>
					</section>
				</fieldset>
				<footer>
					<input type="submit" class="button" name="updateconfirm" id="updateconfirm" value="Update"/>
				</footer>
                </form>
               <script type="text/javascript">
			$(function()
			{
				$("#profileform").validate(
				{					
					rules:
					{
						username:
						{
							required: true
						},
						email:
						{
							required: true,
							email: true
						},
						contact:
						{
							number: true,
							required: true,
							minlength: 3,
							maxlength: 10
						},
						firstname:
						{
							required: true
						},
						lastname:
						{
							required: true
						},
						newgender:
						{
							required: true
						},
					},
					messages:
					{
						uesrname:
						{
							required: 'Please enter your login'
						},
						email:
						{
							required: 'Please enter your email address',
							email: 'Please enter a VALID email address'
						},
						contact:
						{
							required: 'Please enter your contact number',
							number: 'Please enter a VALID contact number'
						},
						firstname:
						{
							required: 'Please select your first name'
						},
						lastname:
						{
							required: 'Please select your last name'
						},
						newgender:
						{
							required: 'Please select your gender'
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
                            if(isset($_POST['updateconfirm']) && $_POST['updateconfirm'] != '') {
								$newemail=sanitize($_POST['newemail']);
								$newfirstname=sanitize($_POST['newfirstname']);
								$newlastname=sanitize($_POST['newlastname']);
								$newcontact=sanitize($_POST['newcontact']);
								$newgender=sanitize($_POST['newgender']);
								if($newgender==1) {$newgender="Male";}
								else if($newgender==2) {$newgender="Female";}
								else if($newgender==3) {$newgender="Other";}
								$updateuser= mysql_query("UPDATE user_info SET firstname='$newfirstname', lastname='$newlastname',contact='$newcontact',gender='$newgender' ,email_id='$newemail',reg_time=now() WHERE id='$user_id'"); 
								echo '<script type="text/javascript">parent.window.location.reload(true);</script>';
							}
						?>
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
					<h2>Add New Transaction</h2>
				</div>
                <p><u><b>Information:</b></u></p>
                This form will let you enter the details of the transaction in which you are liable to <strong>RECIEVE</strong> money from the people you enlist!!
                <div id="transactionstatus"> </div>
                <div id="transactiondiv" class="body-trans body">
                <form method="post" action="" id="transactionform" name="newtransactionform" class="sky-form" >
                <!-- <form method="post" action="createtrans.php" id="transactionform" name="newtransactionform" class="sky-form" > -->
                	<header>New transaction</header>
						<fieldset>					
                            <section>
								<label class="input">
                                	<i class="icon-append icon-shopping-cart"></i>
                                	<input autocomplete="off" type="text" name="descrip" id="descrip" placeholder="Transaction Description"/>
                                    <b class="tooltip tooltip-bottom-right">Specify Tranaction Details</b>
								</label>
							</section>
                            <section>
								<label class="input">
                                	<i class="icon-append icon-calendar"></i>
                                	<input autocomplete="off" type="text" name="transactiondate" id="transactiondate" placeholder="Transaction Date"/>
                                    <b class="tooltip tooltip-bottom-right">Specify Date of Transaction</b>
								</label>
							</section>
                		</fieldset>
                        <fieldset id="itemRows">
                        List people who OWE you...
                        <div class="row">
                            <section class="col col-6">
                            	<label class="select">
                                	<select name="first_user" id="first_user">
                                    	<?php 
											$userquery=mysql_query("SELECT * FROM `user_info` ORDER BY firstname");
											$num_users=mysql_num_rows($userquery);
											if($num_users>0) {
												while($retuserinfo=mysql_fetch_assoc($userquery)) {
													if($retuserinfo['username']!="admin" && $retuserinfo['username']!=$username) {
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
                            	<font color="#2da5da" size="+1"> <a href="javascript&#58;addRow(transactionform,'<?php echo $num_users; ?>')" style="text-decoration:none">ADD</a></font>
                            </section>
                        </div>
                        </fieldset>
                        <footer>
		                    <input type="submit" class="button" name="transactionsubmit" id="transactionsubmit" value="Done"/>
                            <button type="button" class="button button-secondary" onClick="cantran();" >Cancel</button>
						</footer>
				</form>                
                </div>
                <?php
				if(isset($_POST['transactionsubmit'])&&$_POST['transactionsubmit'] != ''){
                	session_start();
					$_SESSION['user_id']=$user_id;
				}
				?>
                <script type="text/javascript">
				var rowNum = 0;
				var rowCnt =0;
				function addRow(frm,numofuser) {
					rowNum++;
					
					var row='<div id="rowNum'+rowNum+'"><section class="col col-6"><label class="select"><select name="rest_user[]" id="rest_user[]"><code><?php $userquery=mysql_query("SELECT * FROM `user_info` ORDER BY firstname");$num_users=mysql_num_rows($userquery);if($num_users>0) { while($retuserinfo=mysql_fetch_assoc($userquery)) { if($retuserinfo['username']!="admin" && $retuserinfo['username']!=$username) { $retuserid=$retuserinfo['id'];$retfirstname=$retuserinfo['firstname']; ?></code> <option value="'+"<?php echo $retuserid;?>"+'"><code><?php echo $retfirstname;?></code> <code><?php } } } ?></code> </select><i></i></label></section><section class="col col-4"><label class="input"><i class="icon-append icon-money"></i><input autocomplete="off" type="text" name="rest_amt[]" id="rest_amt[]" placeholder="Amount"/><b class="tooltip tooltip-bottom-right">Specify Amount</b></label> </section><section class="col col-2"><font color="#da2d4f" size="+1"> <a href="javascript&#58;removeRow('+rowNum+')" style="text-decoration:none">REM</a></font></section></div>';
					
					if((rowCnt+1)<(numofuser-2)) {
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
					$('#transactionform').validate(
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
								descrip:
								{
									required: true
								},
								transactiondate:
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
								descrip:
								{
									required: 'Please specify description'
								},
								transactiondate:
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
									target: '#transactionstatus',
									success: function(resp)
									{	
										var case1='<font color="white">1</font>';
										var case0='<font color="white">0</font>';
										if(resp==case1){
											var newform='<form id="newlyformed1" name="newlyformed1" class="sky-form sky-form-modal-new"><div class="message"><i class="icon-ok"></i><p>Transaction Successfully ADDED!!</p><p><b>Requests have been sent for approval to concerned people</b></p><p>Page will Automatically refresh in 5 seconds</p></div></form>';
											jQuery("#transactionstatus").append(newform);
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
											jQuery("#transactionstatus").append(newform);
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
					$('#transactiondate').datepicker({
						dateFormat: 'yy.mm.dd',
						prevText: '<i class="icon-chevron-left"></i>',
						nextText: '<i class="icon-chevron-right"></i>'
					});
				});	
				</script>
                <script type="text/javascript">
				function cantran() {
					if(confirm("Sure you want to cancel transaction?")) {
						$("#transactionform").hide();
						var newform='<form id="canceltrans" name="canceltrans" class="new-form"><div class="messagefailed"><i class="icon-remove"></i><p>Transaction Cancelled!!</p><p>Page will Automatically refresh in 5 seconds</p></div></form>';
						jQuery("#transactiondiv").append(newform);
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
                	
	<div id="services" class="section-content">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Clear Debt</h2>
				</div> 
                <p><u><b>Information:</b></u></p>
                This form will create a record of your <strong>PAYMENTS TO ADMIN</strong>.
                <div id="cleardebtstatus"> </div>
                <div id="cleardebtdiv" class="body-debt body">
                <form method="post" action="cleardebttrans.php" id="cleardebtform" name="cleardebtform" class="sky-form" >
                	<header>Payments to Admin</header>
						<fieldset>					
                            <section>
								<label class="input">
                                	<i class="icon-append icon-shopping-cart"></i>
                                	<input autocomplete="off" type="text" name="cleardebtmode" id="cleardebtmode" placeholder="Mode of payment..... (Cash / Internet Transfer / Cheque)"/>
                                    <b class="tooltip tooltip-bottom-right">Specify Mode of Payment</b>
								</label>
							</section>
                             <section>
								<label class="input">
                                	<i class="icon-append icon-calendar"></i>
                                	<input autocomplete="off" type="text" name="cleardebtdate" id="cleardebtdate" placeholder="Transaction Date"/>
                                    <b class="tooltip tooltip-bottom-right">Specify Date of Payment</b>
								</label>
							</section>
                            <section>
								<label class="input">
                                	<i class="icon-append icon-money"></i>
                                	<input autocomplete="off" type="text" name="cleardebtamt" id="cleardebtamt" placeholder="Amount Paid"/>
                                    <b class="tooltip tooltip-bottom-right">Specify Amount Paid</b>
								</label>
							</section>
                         </fieldset>
                         <footer>
		                    <input type="submit" class="button" name="cleardebtsubmit" id="cleardebtsubmit" value="Done"/>
                            <button type="button" class="button button-secondary" onClick="cancleardebt();" >Cancel</button>
						</footer>
                 </form>
                 </div>
                 <?php
				if(isset($_POST['cleardebtsubmit'])&&$_POST['cleardebtsubmit'] != ''){
                	session_start();
					$_SESSION['user_id']=$user_id;
				}
				?>
                <script type="text/javascript">
				$(function() {
					$('#cleardebtdate').datepicker({
						dateFormat: 'yy.mm.dd',
						prevText: '<i class="icon-chevron-left"></i>',
						nextText: '<i class="icon-chevron-right"></i>'
					});
				});	
				</script>
                 <script type="text/javascript">
				function cancleardebt() {
					if(confirm("Sure you want cancel this entry?")) {
						$("#cleardebtform").hide();
						var newform='<form id="cancelcleardebt" name="cancecleardebt" class="new-form"><div class="messagefailed"><i class="icon-remove"></i><p>Transaction Cancelled!!</p><p>Page will Automatically refresh in 5 seconds</p></div></form>';
						jQuery("#cleardebtdiv").append(newform);
						$("#cancelcleardebt").addClass('submited');
						setTimeout(function(){
							window.location.reload(true);
						},4000)
					}
				}
				</script>
                <script type="text/javascript">
				$(function(){
					$('#cleardebtform').validate(
						{					
							rules:
							{
								cleardebtmode:
								{
									required: true
								},
								cleardebtamt:
								{
									required: true,
									number: true
								},
								cleardebtdate:
								{
									required: true,
									date: true
								}
							},
							messages:
							{
								cleardebtmode:
								{
									required: 'Please specify some mode of payment'
								},
								cleardebtamt:
								{
									required: 'Specify amount paid',
									number: 'Invalid amount'
								},
								cleardebtdate:
								{
									required: 'Specify date of your payment',
									date: 'Invalid date'
								}
							},
							submitHandler: function(form)
							{
								$(form).ajaxSubmit(
								{
									target: '#cleardebtstatus',
									success: function()
									{	
										var newform='<form id="newlyformed3" name="newlyformed3" class="sky-form sky-form-modal-new"><div class="message"><i class="icon-ok"></i><p>Transaction Successfully Sent!!</p><p>This transaction will be approved ONLY by the acknowledgement of admin.</p><p>Please enusre its approval from the admin</p><p>Page will Automatically refresh in 5 seconds</p></div></form>';
										jQuery("#cleardebtstatus").append(newform);
										$("#newlyformed3").addClass('submited');
										jQuery("#mainbody").append('<div id="cleardebt_success" class="sky-form-modal-overlay"></div>');
										$('#cleardebt_success').on('click', function()
										{
											$('#cleardebt_success').fadeOut();
											$('.sky-form-modal-new').fadeOut();
										});
										form = $('#newlyformed3');
										$('#cleardebt_success').fadeIn();
										form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
										setTimeout(function(){
											window.location.reload(true);
										},4000)
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
    		</div> 
    	</div> 
    </div>
				

	<div id="portfolio" class="section-content">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Pending Approvals</h2>
				</div> 
                <div id="pend_appr_div"></div>
                <p><u><b>Information:</b></u></p>
                This following list shows all your expenses .... Please approve or deny them ASAP!!<br><br>
                
                <?php
                $approve_query="SELECT * FROM `transaction` WHERE `id`='$user_id' AND `approval`=0 AND `ref_transid`<100000 AND `ref_transid`>0";
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
                			<td width="100"> &nbsp; Trans. ID. &nbsp;</td>
                			<td width="100"> &nbsp; Date  &nbsp;</td>
                            <td width="180"> &nbsp; Trans. Details &nbsp; </td>
                            <td width="100"> &nbsp; Payable To &nbsp; </td>
                            <td width="100"> &nbsp; Amount &nbsp; </td>
                            <td width="100"> &nbsp; Details &nbsp; </td>
                            <td width="200" colspan="2"> &nbsp; Status &nbsp; </td>
            			</tr>
        			</thead>
                    <tbody class="mynew-table">	
                 <?php   
                     while($approve_data=mysql_fetch_assoc($approve_query_run)){
						 if($approve_data['ref_transid']==0 || $approve_data['ref_transid']>=100000){}
						 else {
				   ?>	 
						<tr height="25" align="center" valign="middle" id="rownum<?php echo $approve_data['transid'];?>">
                        	<td width="100"><font color="#2da5da"><abbr title="Trans. ID." style="border-bottom:none"><?php echo $approve_data['transid'];?></abbr></font></td>
                            <td width="100"><abbr title="Date" style="border-bottom:none"><?php echo $approve_data['date'];?></abbr></td>
                            <td width="180"><abbr title="Description" style="border-bottom:none"><?php echo $approve_data['descrip'];?></td>
                            <td width="100">
                            <?php
                            $ref_transid=$approve_data['ref_transid'];
							$ref_query_run_data=mysql_fetch_assoc(mysql_query("SELECT * FROM `transaction` WHERE `transid`='$ref_transid'"));
							$ref_id=$ref_query_run_data['id'];
							$ref_query_run_userdata=mysql_fetch_assoc(mysql_query("SELECT * FROM `user_info` WHERE `id`='$ref_id'"));
							$ref_name=$ref_query_run_userdata['firstname'];
							?>
                            <?php echo $ref_name;?>
                            </td>
                            <td width="100"><abbr title="Amount" style="border-bottom:none"><?php echo $approve_data['amount'];?></td>
                            <td width="100"></td>
                            <td width="100" id="a<?php echo $approve_data['transid'];?>"><a style="text-decoration:none; color:#27C600" href="javascript&#58;statusupdate(1,'<?php echo $approve_data['transid'];?>')">Approve</a></td>
                            <td width="100" id="r<?php echo $approve_data['transid'];?>"><a style="text-decoration:none; color:#da2d4f" href="javascript&#58;statusupdate(2,'<?php echo $approve_data['transid'];?>')">Reject</a></td>
						</tr>
				 <?php	 
						 }
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
					if(confirm("You confirm to "+str1+" with Trans. id: "+transid)){
						jQuery('#r'+transid).empty();
						jQuery('#a'+transid).empty();
						if(cat==2){
							jQuery('#a'+transid).html('<font color="#da2d4f">REJECTED</font>');
							jQuery('#r'+transid).append('<img src="imgs/not-available.png" />');
						} else if(cat==1) {
							jQuery('#a'+transid).html('<font color="#27C600">APPROVED</font>');
							jQuery('#r'+transid).append('<img src="imgs/available.png" />');
						}
						$.post('userbasedapproval.php', {'cat':cat , 'transid':transid}, function(data) {
							$("#pend_appr_div").html(data);
						});
					}
				}
				</script>
                
    		</div> 
		</div>
	</div>
    
    <div id="contact" class="section-content">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Transaction History</h2>
				</div> 
                <div id="histdiv"> </div>
                <div style="float:right">
                <img src="imgs/print_button.png" id="printbutton" onClick="printData();"/>&nbsp;&nbsp;&nbsp;&nbsp;<img src="imgs/report_green_button2.png" id="gen_report_img" onClick="gen_report();" height="35" width="125"/>
                </div>
                <p><u><b>Information:</b></u></p>
                This is your account statement with record of all your past transactions!<br>
                Last updated on : <script type="text/javascript">var datetime=moment().format('MMMM Do YYYY, h:mm:ss a');document.writeln(datetime);</script><br><br>
                <?php
				$hist_query_run=mysql_query("SELECT * FROM `transaction` WHERE `id`='$user_id'");
				$hist_numrows=mysql_num_rows($hist_query_run);
				if($hist_numrows==0){
				?>
                	<br><b>You have no transaction history</b>
                <?php	
				} else {
				?>
                <div id="printdiv">
                <table border="0" cellspacing="2" cellpadding="5" class="sky-form" id="printtable">
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="75"> &nbsp; Sr. No. &nbsp;</td>
                			<td width="85"> &nbsp; Trans. ID.  &nbsp;</td>
                            <td width="85"> &nbsp; Date &nbsp; </td>
                            <td width="180"> &nbsp; Trans. Details &nbsp; </td>
                            <td width="100"> &nbsp; Amount &nbsp; </td>
                            <td width="100"> &nbsp; Appr. Amt. &nbsp; </td>
                            <td width="90"> &nbsp; Type &nbsp; </td>
                            <td width="80"> &nbsp; Details &nbsp; </td>
                            <td width="200"> &nbsp; Misc. &nbsp; </td>
            			</tr>
        			</thead>
                    <tbody class="mynew-table">	
                    <?php
					$hist_srnr=1;
					$p=0;
					$r=0;
                    while($hist_data=mysql_fetch_assoc($hist_query_run)) {
					?>
                    	<tr height="25" align="center" valign="middle" id="rownumhist<?php echo $hist_data['transid'];?>">
                        	<td width="75"><abbr title="Sr. No." style="border-bottom:none"><?php echo $hist_srnr;?></abbr></td>
                            <td width="85"><font color="#2da5da"><abbr title="Trans. ID." style="border-bottom:none"><?php echo $hist_data['transid'];?></abbr></font></td>
                            <td width="85"><abbr title="Date" style="border-bottom:none"><?php echo $hist_data['date'];?></abbr></td>
                            <td width="180"><abbr title="Description" style="border-bottom:none"><?php echo $hist_data['descrip'];?></abbr></td>
                            <td width="100"><abbr title="Amount" style="border-bottom:none"><?php echo $hist_data['amount'];?></abbr></td>
                            <?php
                            	if($hist_data['approval']==0){  // all pending
									if($hist_data['ref_transid']>=100000){ //bank trans
										$temp_appr_amt=0;
									} else if($hist_data['ref_transid']==0) { //self initiated trans
										$temp_appr_amt=0;
										$temp_transid=$hist_data['transid'];
									   $temp_query_run=(mysql_query("SELECT * FROM `transaction` WHERE `ref_transid`='$temp_transid' AND `approval`=1"));
										while($temp_query_data=(mysql_fetch_assoc($temp_query_run))){
											$temp_appr_amt=$temp_appr_amt+$temp_query_data['amount'];
											
											/*if($temp_appr_amt==$hist_data['amount']){
												$transid_reset=$hist_data['transid'];
												$reset_appr_of_init_query_run=mysql_query("UPDATE `transaction` SET `approval`=1 WHERE `transid`='$transid_reset'");
											}*/
											
										}
									} else if($hist_data['ref_transid']!=0) { //my payable not approved
										$temp_appr_amt=0;
									}
								} else if($hist_data['approval']==1){ // all approved
									$temp_appr_amt=$hist_data['amount'];
								} else if($hist_data['approval']==2){ // all rejected
									$temp_appr_amt=0;
								}
								$final_appr_amts[$hist_data['transid']]=$temp_appr_amt;
							?>
                            <td width="100"><abbr title="Approved Amount" style="border-bottom:none"><?php echo $temp_appr_amt;?></abbr></td>
                            <td width="90"><abbr title="Type" style="border-bottom:none"><?php echo $hist_data['type'];?></abbr></td>
                            <?php
								if($hist_data['ref_transid']==0){ //mode=1
								?>
                                	<td width="80"><a style="color:#2da5da" href="javascript&#58;viewdetail(1,'<?php echo $hist_data['transid'];?>')" >View</a></td>    
                                <?php
								} else if($hist_data['ref_transid']>=100000){ //mode=2
								?>
                                	<td width="80"><a style="color:#2da5da" href="javascript&#58;viewdetail(2,'<?php echo $hist_data['transid'];?>')" >View</a></td>    
                                <?php
								} else { //mode=0
								?>
                                	<td width="80"><a style="color:#2da5da" href="javascript&#58;viewdetail(0,'<?php echo $hist_data['transid'];?>')" >View</a></td>     
                                <?php
								}
                            ?>
                             <?php
								if($hist_data['ref_transid']>=100000){
									if($hist_data['approval']==0){
										?>
                                        	<td width="200"><font color="#609">Pending ADMIN approval</font></td>
                                        <?php
									} else if ($hist_data['approval']==1){
										?>
                                        	<td width="200"><font color="#00B700">ADMIN approved</font></td>
                                        <?php
									} else if ($hist_data['approval']==2){
										?>
                                        	<td width="200"><font color="#FF0000">ADMIN rejected</font></td>
                                        <?php
									}
								} else if($hist_data['ref_transid']==0){
									?>
                                    	<td width="200"><a style="color:#F00" href="javascript&#58;del_user_trans('<?php echo $hist_data['transid'];?>')" >DELETE</a></td>
                                    <?php
								} else {
									if($hist_data['approval']==0){
										?>
	                                        <td width="200"><a style="color:#609" href="#portfolio" >Pending YOUR approval</a></td>
                                        <?php
									} else if($hist_data['approval']==1) {
										?>
                                        	<td width="200"><font color="#00B700">YOU approved</font></td>
                                        <?php
									} else if($hist_data['approval']==2) {
										?>
                                        	<td width="200"><font color="#FF0000">YOU rejected</font></td>
                                        <?php
									}
								} 
                            ?>
                        </tr>
                    <?php
					if($hist_data['type']=="receivable"){
						$r=$r+$final_appr_amts[$hist_data['transid']];
					} else if($hist_data['type']=="payable"){
						$p=$p+$final_appr_amts[$hist_data['transid']];
					}
					$hist_srnr++;
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
							$.ajax({
							  url: 'user_gen_report.php',
							  //type: POST,
							  data: {userid1: userid , start_date1: start_date , end_date1 : end_date},
							  success: function(data) {
								  window.open('user_gen_report.php?userid=' + userid + '&start_date=' + start_date + '&end_date=' + end_date);
								alert("Done with report generation (Enable pop-ups if blocked!)");
							  }
							});
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
                <script type="text/javascript">
				function del_user_trans(transid){
					if(confirm("Sure you wish to DELETE transaction with id : "+transid)){
						$.post('del_user_init_trans.php', {'transid':transid}, function(data) {
							if(data=='<font color="white" size="-4">success</font>'){
								jQuery('#rownumhist'+transid).remove();
							} else if(data=='<font color="white" size="-4">failure</font>'){
								alert("Cant delete... as APPROVED by ALL INVOLVED");
							}
							$("#histdiv").html(data);
						});
					}
				}
				</script>
                <script type="text/javascript">
				function viewdetail(type,transid){
					if(type==1){
						jQuery("#mainbody").append('<div id="viewdetail_1_div" class="sky-form-modal-overlay"></div>');
							$('#viewdetail_1_div').on('click', function()
							{
								$('#viewdetail_1_div').fadeOut();
								$('.sky-form-modal').fadeOut();
							});
							form = $('#viewdetail_1_table');
							$('#viewdetail_1_div').fadeIn();
							form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
							$('#viewdetail_1_body').empty();
							$('#viewdetail_1_body').html('<tr align="center" height="100"><td colspan=4><img src="imgs/ajax-loader.gif" /></td></tr>');
							$.post('viewdetail_1_code.php', {'transid':transid}, function(data) {
								var x=data;
								$('#viewdetail_1_body').empty();
								for(var i=0;i<x.length;i++){
									if(x[i][3]==0){
										x[i][3]='Pending';
									} else if(x[i][3]==1) {
										x[i][3]='Approved';
									} else if(x[i][3]==2) {
										x[i][3]='Rejected';
									}
									//var newrow_1='<tr align="center" valign="middle"><td width="75">'+x[i][0]+'</td><td width="100">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="150" id="status_td">'+x[i][3]+'</td></tr>';
									//jQuery('#viewdetail_1_body').append(newrow_1);
									if(x[i][3]=='Pending'){
										var newrow_1='<tr align="center" valign="middle"><td width="75">'+x[i][0]+'</td><td width="100">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="150"><font color="#609">'+x[i][3]+'</font></td></tr>';
										jQuery('#viewdetail_1_body').append(newrow_1);
									} else if(x[i][3]=='Approved') {
										var newrow_1='<tr align="center" valign="middle"><td width="75">'+x[i][0]+'</td><td width="100">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="150"><font color="#00B700">'+x[i][3]+'</font></td></tr>';
										jQuery('#viewdetail_1_body').append(newrow_1);
									} else if(x[i][3]=='Rejected') {
										var newrow_1='<tr align="center" valign="middle"><td width="75">'+x[i][0]+'</td><td width="100">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="150"><font color="#FF0000">'+x[i][3]+'</font></td></tr>';
										jQuery('#viewdetail_1_body').append(newrow_1);
									}
								}
							}, "json");
							
					} else if(type==0) {
						jQuery("#mainbody").append('<div id="viewdetail_0_div" class="sky-form-modal-overlay"></div>');
						$('#viewdetail_0_div').on('click', function()
						{
							$('#viewdetail_0_div').fadeOut();
							$('.sky-form-modal').fadeOut();
						});
						form = $('#viewdetail_0_table');
						$('#viewdetail_0_div').fadeIn();
						form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
						$('#viewdetail_0_body').empty();
						$('#viewdetail_0_body').html('<tr align="center" height="100"><td colspan=4><img src="imgs/ajax-loader.gif" /></td></tr>');
						$.post('viewdetail_0_code.php', {'transid':transid}, function(data) {
							var x=data;
							$('#viewdetail_0_body').empty();
							for(var i=0;i<x.length;i++){
								if(x[i][4]==0){
									x[i][4]='Pending';
									var newrow_0='<tr align="center" valign="middle"><td width="100">'+x[i][0]+'</td><td width="100">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="100">'+x[i][3]+'</td><td width="150"><font color="#609">'+x[i][4]+'</font></td></tr>';
									jQuery('#viewdetail_0_body').append(newrow_0);
								} else if(x[i][4]==1) {
									x[i][4]='Approved';
									var newrow_0='<tr align="center" valign="middle"><td width="100">'+x[i][0]+'</td><td width="100">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="100">'+x[i][3]+'</td><td width="150"><font color="#00B700">'+x[i][4]+'</font></td></tr>';
									jQuery('#viewdetail_0_body').append(newrow_0);
								} else if(x[i][4]==2) {
									x[i][4]='Rejected';
									var newrow_0='<tr align="center" valign="middle"><td width="100">'+x[i][0]+'</td><td width="100">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="100">'+x[i][3]+'</td><td width="150"><font color="#FF0000">'+x[i][4]+'</font></td></tr>';
									jQuery('#viewdetail_0_body').append(newrow_0);
								} else if(x[i][4]=="Initiator") {
									var newrow_0='<tr align="center" valign="middle" bgcolor="#CCFF33"><td width="100">'+x[i][0]+'</td><td width="100">'+x[i][1]+'</td><td width="100">'+x[i][2]+'</td><td width="100">'+x[i][3]+'</td><td width="150">'+x[i][4]+'</td></tr>';
									jQuery('#viewdetail_0_body').append(newrow_0);
								}
							}
						}, "json");
						
						
						
					} else if(type==2) {
						var newform='<form id="newlyformed4" name="newlyformed4" class="sky-form sky-form-modal-new"><div class="message"><i class="icon-pencil"></i><p>This transaction depends on ADMIN Approval</p><p>Contact ADMIN if any discrepancy!</p></div></form>';
						jQuery("#cleardebtstatus").append(newform);
						$("#newlyformed4").addClass('submited')
						jQuery("#mainbody").append('<div id="type_2_view" class="sky-form-modal-overlay"></div>');
						$('#type_2_view').on('click', function()
						{
							$('#type_2_view').fadeOut();
							$('.sky-form-modal-new').fadeOut();
						});
						form = $('#newlyformed4');
						$('#type_2_view').fadeIn();
						form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
					}
				}
				</script>
                <table border="0" cellspacing="2" cellpadding="5" background="img/white.jpg" class="sky-form sky-form-modal" id="viewdetail_1_table" >
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="75"> &nbsp; Sr. No. &nbsp; </td>
                			<td width="100"> &nbsp; Name  &nbsp;</td>
                            <td width="100"> &nbsp; Amount  &nbsp;</td>
                            <td width="150"> &nbsp; Status  &nbsp;</td>
            			</tr>
        			</thead>
                    <tbody id="viewdetail_1_body" class="mynew-table">
                                    	
                    </tbody>
                 </table>
                 <table border="0" cellspacing="2" cellpadding="5" background="img/white.jpg" class="sky-form sky-form-modal" id="viewdetail_0_table" >
        			<thead style="border-bottom:thin #999999 solid; color:#363636">
           				<tr style="font-weight:bold" align="center" valign="middle" height="30">
                			<td width="100"> &nbsp; Sr. No. &nbsp; </td>
                			<td width="100"> &nbsp; Name  &nbsp;</td>
                            <td width="100"> &nbsp; Amount  &nbsp;</td>
                            <td width="100"> &nbsp; Type  &nbsp;</td>
                            <td width="150"> &nbsp; Status  &nbsp;</td>
            			</tr>
        			</thead>
                    <tbody id="viewdetail_0_body" class="mynew-table">
                                    	
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
                <div id="signoutdiv"> </div>
                <script type="text/javascript">
				function signoutfunc() {
					var check=<?php echo $approve_numrows;?>;
					if(check==0){
						var newform='<form id="newlyformed5" name="newlyformed5" class="sky-form sky-form-modal-new"><div class="message"><i class="icon-signout"></i><p>Signing Out!!</p><p>Thank You for using this app!!</p><p>Visit soon</p><p>Page will Automatically Redirect...</p></div></form>';
						jQuery("#signoutdiv").append(newform);
						$("#newlyformed5").addClass('submited');
						jQuery("#mainbody").append('<div id="signout_success" class="sky-form-modal-overlay"></div>');
						form = $('#newlyformed5');
						$('#signout_success').fadeIn();
						form.css('top', '30%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
						$.post( "logout.php" );
						setTimeout(function(){
							window.location.replace("index.php");
						},4000)
					} else {
						$('#signoutdiv').html('<br><br><font size="+1" color="orange">You still have pending approvals..</font><br><b><font color="red" size="+1">Sign Out - </font><font size="+2" color="red"><u>DISABLED!!!</u></font></b>');
					}
				}
				</script>
             </div>
		</div> 
	</div> 
</div>
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