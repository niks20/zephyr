<?php
	session_start();
	require_once('connectiondata.php');
	require_once('functions.php');

	if(check_login_status()==false)
	{
		redirect('index.php');
	}
?>

<html>
<head>
	<title>iPortal - Compose</title>
	<link rel="stylesheet" href="css/changePassword.css" />
	<?php include_once('header_includes.php'); ?>

</head>
<body>

<div class="mainBody">

	<?php include_once('header.php'); ?>

	<div class="main">
	
		<center>
		<h3 class='CPheading'>Change Password</h3>
		</center>
		<form align='center' class='CPform' action='changePwdAction.php' method='post'>
			<input type='password' class='input-large search-query span4' style='height:35px;margin-bottom:10px;margin-top:30px' placeholder='Type old password...' name='old_pwd' />
			<input type='password' class='input-large search-query span4' style='height:35px;margin-bottom:10px;' placeholder='Type current password...' name='curr_pwd1' />
			<input type='password' class='input-large search-query span4' style='height:35px;margin-bottom:10px;' placeholder='Re-Type current password...' name='curr_pwd2' />
				<br>
			<button type='submit' class='btn' style="width:160px; margin-top:20px; margin-right:10px">Change</button>
			<button type='reset' class='btn' style="width:160px; margin-top:20px; margin-left:10px">Clear</button>
			
		</form>
			</center>
		<?php

			if(isset($_SESSION['sent']))
			{
				if(($_SESSION['sent'])==1)
				{
					echo ('

						<div class="alert alert-success" style="width: 50%; margin-left:21%; margin-right:24%"><a class="close" data-dismiss="alert">x</a>    
						<strong>Success!</strong> '.$_SESSION['message'].'</div>

					');
				}

				else
				{
					echo ('

						<div class="alert alert-error" style="width: 50%; margin-left:21%; margin-right:24%"><a class="close" data-dismiss="alert">x</a> 
						<strong>Error!</strong> '.$_SESSION['message'].'</div>

					');
				}

				unset($_SESSION['sent']);
				unset($_SESSION['message']);
			}
				
		?>
		
	</div>

	<?php include_once('footer.php'); ?>
	
</body>
</html>