<!DOCTYPE html> 
<html>
	<head>
		<title>Register Here!!</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
		<link rel="stylesheet" href="css/first.css" />
		<link rel="stylesheet" href="css/forms.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- icons css -->
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/jquery.form.min.js"></script>
        <script type="text/javascript">
			$(document).ready(function() {
				$("#username").keyup(function (e) {;
					var username = $(this).val();
					if(username.length < 4){$("#check-status-username").html('');return;}
					if(username.length >= 4){
						$("#check-status-username").html('<img src="imgs/ajax-loader.gif" />');
						var retflag='<font color="#FF0000">Username already taken &nbsp; &nbsp; <img src="imgs/not-available.png" /></font>';
						$.post('formlivecheck.php', {'username':username}, function(data) {
						  $("#check-status-username").html(data);
						  if(data == retflag) {
							   $("#submit").prop('disabled' , true);
						  } else {
							   $("#submit").prop('disabled' , false);
						  }
						});
					}
				});	
			});
			</script>
            <script type="text/javascript">
			$(document).ready(function() {
				$("#password").keyup(function (e) {;
					var email = $("#email").val();
					if(email.length < 8){$("#check-status-email").html('');return;}
					if(email.length >= 8){
						$("#check-status-email").html('<img src="imgs/ajax-loader.gif" />');
						var retflag='<font color="#FF0000">Email already regsitered</font> &nbsp; &nbsp; <img src="imgs/not-available.png" />';
						$.post('formlivecheck.php', {'email':email}, function(data) {
							$("#check-status-email").html(data);
							if(data == retflag) {
								   $("#submit").prop('disabled' , true);
						  	} else {
								   $("#submit").prop('disabled' , false);
						    }
						});
					}
				});	
			});
			</script>
            <script type="text/javascript">
			$(document).ready(function() {
                $("#email").keyup(function (e) {;
	                    $('input[type="password"]').val('');
						$("#check-status-email").html('');
                });
            });
			</script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	
	<body class="bg-cyan">
		<div class="body body-s">
        <div id="regdone"></div>		
			<form method="post" action="regcomplete.php" id="regform" name="regform" class="sky-form" />
				<header>Registration form</header>
				
				<fieldset>					
					<section>
						<label class="input">
							<i class="icon-append icon-user"></i>
							<input autocomplete="off" type="text" name="username" id="username" placeholder="Username"/>
                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b>
                            <div class="status-message" align="right" id="check-status-username"></div>
						</label>
					</section>
					
					<section>
						<label class="input">
							<i class="icon-append icon-envelope-alt"></i>
							<input autocomplete="off" type="email" name="email" id="email" placeholder="Email address" />
							<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                            <div class="status-message" align="right" id="check-status-email"></div>
						</label>
					</section>
					
					<section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input autocomplete="off" type="password" name="password" placeholder="Password" id="password" />
							<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
						</label>
					</section>
					
					<section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input autocomplete="off" type="password" name="passwordConfirm" placeholder="Confirm password" id="passwordConfirm" />
							<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
						</label>
					</section>
                    
                    <section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input autocomplete="off" type="text" name="contact" placeholder="Contact" />
							<b class="tooltip tooltip-bottom-right">Don't forget your contact</b>
						</label>
					</section>
				</fieldset>
					
				<fieldset>
					<div class="row">
						<section class="col col-6">
							<label class="input">
                            	<i class="icon-append icon-user"></i>
								<input autocomplete="off" type="text" name="firstname" placeholder="First name" id="firstname" />
                                <b class="tooltip tooltip-bottom-right">Enter Firstname</b>
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
                            	<i class="icon-append icon-user"></i>
								<input autocomplete="off" type="text" name="lastname" placeholder="Last name" id="lastname" />
                                <b class="tooltip tooltip-bottom-right">Enter Lastname</b>
							</label>
						</section>
					</div>
					
					<section>
						<label class="select">
							<select name="gender">
								<option value="0" selected="" disabled="" />Gender
								<option value="1" />Male
								<option value="2" />Female
								<option value="3" />Other
							</select>
							<i></i>
						</label>
					</section>
					
					<section>
						<label class="checkbox"><input type="checkbox" name="terms" id="terms" /><i></i>I agree with the Terms and Conditions</label>
					</section>
				</fieldset>
				<footer>
					<button type="submit" class="button" id="regbutton" name="regbutton">Register</button>
                    <button type="button" class="button button-secondary"><a style="text-decoration:none;" href="index.php">Back</a></button>
				</footer>
                <div class="message">
					<i class="icon-ok"></i>
                    <font size="-1">
					<p>Registeration Successfull!!</p>
                    <p>Redirecting you to home page...</p>
                    <p>If page does not load in 5 seconds, <a href="index.php">Click Here!</a></p>
                    </font>
				</div>
			</form>			
		</div>
		
		<script type="text/javascript">
			$(function()
			{
				$("#regform").validate(
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
						password:
						{
							required: true,
							minlength: 3,
							maxlength: 20
						},
						passwordConfirm:
						{
							required: true,
							minlength: 3,
							maxlength: 20,
							equalTo: '#password'
						},
						contact:
						{
							required: true,
							minlength: 3,
							maxlength: 10,
							number: true
						},
						firstname:
						{
							required: true
						},
						lastname:
						{
							required: true
						},
						gender:
						{
							required: true
						},
						terms:
						{
							required: true
						}
					},
					messages:
					{
						username:
						{
							required: 'Please enter your login'
						},
						email:
						{
							required: 'Please enter your email address',
							email: 'Please enter a VALID email address'
						},
						password:
						{
							required: 'Please enter your password'
						},
						passwordConfirm:
						{
							required: 'Please enter your password one more time',
							equalTo: 'Please enter the same password as above'
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
						gender:
						{
							required: 'Please select your gender'
						},
						terms:
						{
							required: 'You must agree with Terms and Conditions'
						}
					},		
					submitHandler: function(form)
					{
						$(form).ajaxSubmit(
						{
							target : '#regdone',
							success: function()
							{
								$("#regform").addClass('submited');
								setTimeout(function(){
								window.location.href = 'index.php';
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