<!-- The login page -->

<!-- Redirected to home if already logged in -->

<?php
	session_start();

	require_once('functions.php');

	if(check_login_status())
	{
		redirect("home.php");
	}

?>



<html>
<head>
	<title>iPortal - Login</title>
	<link rel="stylesheet" href="css/index.css" />
</head>
<body>

<div class="mainBody">

	<div class='header'>
	
		<img src="images/logo.png" height='100%'>
		<img src="images/trademark.gif" height='100%' style="margin-left:140px;margin-right:140px">
		<img src="images/iitd.png" height='100%'>

	</div>
	<?php include_once('footer.php'); ?>
	<div class="main" >
		

		<!-- Login Form -->

		<div class="login" >
		 	<form name='loginform' action="logincheck.php" method='post'>
		  		<table align='center' style="margin-top: 30%">
		  	 	<tr><td><input class="logininput" type='text' placeholder='Username' name='username' autofocus="autofocus"></td></tr>
		  	 	<tr><td><input class="logininput" type='password' placeholder='Password' name='password'></td></tr>
		  	 	<tr><td><input class="loginsubmit" type='submit' value='Log in' style="width: 100%; height:25px"></td></tr>
		  	 	<tr><td><p align='right' style="font-size: 12px" ><a href="/home.php" >Forgot password</a></p></td></tr>
		  		</table>
		 	</form>

		 	<?php
				if(isset($_SESSION['loginerror']))
				{
					echo '<div id="errortext">'.$_SESSION['loginerror'].'</div>';
					unset($_SESSION['loginerror']);
				}
			?>

		</div>	
		
	</div>
</div>

	

</body>
</html>