<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>
<div align="right">
<img src="imgs/site_logo.jpg" height="150" width="300" />
</div>
<div id="wrapper">
    <div class="user-icon"></div>
    <div class="pass-icon"></div>

<form name="login-form" class="login-form" action= "<?php echo $current_file; ?>" method="POST">

    <div class="header">
    <h1>Login Form</h1>
    <p><span>Enter details to enter accounting WebAPP and check your current financial status!!.</span>
    </p>
    </div>
    <?php
	if(isset($_POST['submit1'])&&$_POST['submit1'] != ''){
	if(isset($_POST['username'])&&isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_hash = md5($password);
		if (!empty($username)&&!empty($password)) {
			$query = "SELECT `id` FROM `user_info` WHERE `username`='".mysql_real_escape_string($username)."' AND `password`='$password_hash'";
			if($query_run = mysql_query($query)){
				$query_num_rows = mysql_num_rows($query_run);
				if($query_num_rows == 0) {
					echo '<font size="-1" face="Bree Serif, serif" color="#FF0000">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Invalid Username/Password Combination</font>';
				} else if ($query_num_rows == 1) {
					$user_id = mysql_result($query_run,0,'id');
					$userdata=mysql_fetch_assoc(mysql_query("SELECT * FROM `user_info` WHERE `id`='$user_id'"));
					$usernamefound=$userdata['username'];
					$visit_count=$userdata['visit_count'];
					$visit_count++;
					mysql_query("UPDATE `user_info` SET `visit_count`='$visit_count' WHERE `id`='$user_id'");
					session_start();
					$_SESSION['user_id'] = $user_id;
					if($username=="admin") {
						header('Location: adminpanel.php');
					} else {
						header('Location: userpanel.php');
					}
				}
			}
		} else {
			echo '<font size="-1" face="Bree Serif, serif" color="#FF0000">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Username/Password Missing</font>';
		}
	}
	}
	if(isset($_POST['submit2'])&&$_POST['submit2'] != '')
	{
		header('Location: register.php');
	}
	?>
    
    <div class="content">
	<input autocomplete="off" name="username" type="text" class="input username" value="Username" onfocus="this.value=''" placeholder="Username"/>
    <input autocomplete="off" name="password" type="password" class="input password" value="Password" onfocus="this.value=''" placeholder="Password"/>
    <br><br />
    <div align="right"><font size="-1" face="Bree Serif, serif" color="#3256E9"><u><a style="color:#3256E9; text-decoration:none" href="forgotpass.php" >Forgot Password?</a></u></font></div>
    </div>
    <div class="footer">
    <input type="submit" name="submit1" value="Login" class="button" />
    <input type="submit" name="submit2" value="Register" class="register" />
    </div>
</form>

</div>
<div class="gradient"></div>
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