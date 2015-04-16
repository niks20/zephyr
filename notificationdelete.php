<?php


	//Calls the function to delete notification from the database and stores the result in session variables
	
	session_start();

	include_once('functions.php');
	if($_SESSION['userid']==get_faculty_id($_POST['courseid']))
	{

		$done = delete_notification($_POST['notificationid']);

		if($done==true)
		{
			  $_SESSION['notificationdeleteresult']=1;
			  $_SESSION['notificationdeletemessage']="Notification Deleted";
		}
		else
		{
			  $_SESSION['notificationdeleteresult']=2;
			  $_SESSION['notificationdeletemessage']="Cannot Delete Notification";
		}

	}

	redirect("courses.php?courseid=".$_POST['courseid']."&item=notifications");

?>