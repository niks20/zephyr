<?php	
	session_start();

	require('./connectiondata.php');
	require_once('functions.php');
	

	if($_POST['old_pwd']==='' || $_POST['curr_pwd1']==='' || $_POST['curr_pwd2']==='')
	{
		$_SESSION['sent']=3;
		$_SESSION['message'] = "Empty Password";
		redirect('changePassword.php');
	}

	$databaseMD5 = getPasswordMD5($_SESSION['userid']);
	$givenMD5 = md5($_POST['old_pwd']);

	if($databaseMD5==$givenMD5)
	{
		if($_POST['curr_pwd1']==$_POST['curr_pwd2'])
		{
			changepassword($_SESSION['userid'],md5($_POST['curr_pwd1']));
			$_SESSION['sent'] = 1;
			$_SESSION['message'] = "Password changed successfully";
		}
		else
		{
			$_SESSION['sent'] = 2;
			$_SESSION['message'] = "New passwords do not match";
		}
	}

	else
	{
		$_SESSION['sent'] = 2;
		$_SESSION['message'] = "Incorrect old password";
	}

	redirect('changePassword.php');
?>