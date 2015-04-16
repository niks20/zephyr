<?php	
	session_start();

	require('connectiondata.php');
	require_once('functions.php');


	if($_POST['messagecontent']==='')
	{
		$_SESSION['sent']=3;
		$_SESSION['messageresult'] = "Content Empty";
		$_SESSION['subjectdata'] = $_POST['subject'];
		$_SESSION['composeuserbox'] = $_POST['messageto'];
		redirect('compose.php');
	}

	$sid = $_SESSION['userid'];

	$username = $_POST['messageto'];

	$tempusername = strstr($username,'-',true);

	if($tempusername != FALSE)
	{
		$username = substr($tempusername,0,-1);
	}

	$rid = NULL;

	if(ctype_alnum($username))
	{
		$rid = get_user_id($username);

		if($rid==NULL)
		{
			$rid = get_user_id_name($username);
		}
	}

	if($rid==NULL)
	{
		$_SESSION['sent']=2;
		$_SESSION['messageresult'] = "Invalid Username";
		$_SESSION['subjectdata'] = $_POST['subject'];
		$_SESSION['composecontent'] = $_POST['messagecontent'];
		redirect('compose.php');
	}
	else
	{
		$result = sendmessage($rid,$sid,$_POST['subject'],$_POST['messagecontent']);
		$_SESSION['sent']=1;
		$_SESSION['messageresult'] = "Your message has been sent successfully";
		redirect('compose.php');

	}

?>