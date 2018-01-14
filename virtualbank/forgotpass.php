<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Password Recovery</title>
		<link rel="stylesheet" href="css/first.css" />
		<link rel="stylesheet" href="css/forms.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- icons css -->
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery.form.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
        <script type="text/javascript">
			$(document).ready(function() {
				$("#username").keyup(function (e) {;
					var username = $(this).val();
					if(username.length < 4){$("#check-status").html('');return;}
					if(username.length >= 4){
						$("#check-status").html('<img src="imgs/ajax-loader.gif" />');
						$.post('userexistance.php', {'username':username}, function(data) {
						  $("#check-status").html(data);
						  var retflag='<font color="#339900">Username Found</font>';
						  if(data!=retflag){
							 // alert("found");;
							 $("#probutton").prop('disabled' , true);
						  } else {
							  $("#probutton").prop('disabled' , false);
						  }
						});
					}
				});	
			});
			</script>
</head>

<body class="bg-cyan">
		<div class="body body-s">	
        	
			<form method="post" action="" id="forgotpassform" class="sky-form">
            <header>Password Recovery</header>
				<fieldset>					
					<section>
						<label class="input" for="username">
							<i class="icon-append icon-user"></i>
							<input autocomplete="off" type="text" name="username" id="username" placeholder="Username"/>
                            <div class="status-message" align="right" id="check-status"></div>
							<b class="tooltip tooltip-bottom-right">Username which needs recovery</b>
						</label>
					</section>
                    </fieldset>
                    <footer>
                    <input type="submit" class="button" name="probutton" id="probutton" value="Proceed"/>
                    <button type="button" class="button button-secondary"><a style="text-decoration:none;" href="index.php">Back</a></button>
				</footer>
                <div class="message">
					<i class="icon-ok"></i><font size="-1">
					<p>Email sent to your registered email address</p>
                    <p>Check your mail for further instructions!</p></font>
				</div>
                </form>
            
           <script type="text/javascript">
			$(function()
			{
				// Validation		
				$("#forgotpassform").validate(
				{					
					// Rules for form validation
					rules:
					{
						username:
						{
							required: true,
							minlength : 4
						}
					},
					
					// Messages for form validation 
					messages:
					{
						username:
						{
							required: 'Please enter your username',
							minlenght : 'Please enter your username'
						}
					},					
					submitHandler: function(form)
					{
						var uname=document.getElementById('username').value;
						$(form).ajaxSubmit(
						{
							type: "POST",
							url: 'recovery_pass.php',
							data: {uesrname: uname },
							success: function(data)
							{
								$("#forgotpassform").addClass('submited');
							}
						});
					},
					// Do not change code below
					errorPlacement: function(error, element)
					{
						error.insertAfter(element.parent());
					}
				});
			});			
		</script>
        </div>
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