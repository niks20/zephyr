<?php

	//Calls the function to add notification to the database and stores the result in session variables

	session_start();

	include_once('functions.php');

	if($_POST['newnotification']==='')
	{
    	$_SESSION['notificationaddresult']=2;
    	$_SESSION['notificationaddmessage'] = "Content Empty";
	}

	else
	{
		$done = add_notification($_POST['courseid'],$_POST['newnotification']);

		if($done==true)
		{
			$_SESSION['notificationaddresult']=1;
			$_SESSION['notificationaddmessage']="Notification Added";
		}
		else
		{
			$_SESSION['notificationaddresult']=2;
			$_SESSION['notificationaddmessage']="Cannot Add Notification";
		}
	}

	redirect("courses.php?courseid=".$_POST['courseid']."&item=notifications");

?>