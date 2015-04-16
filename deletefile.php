<?php

	//To delete the file - Variables - courseid, itemtype, filepath

	session_start();
	include_once('functions.php');

	if(isset($_POST['filepath']))
	{
		$done = unlink($_POST['filepath']);
		if($done==true)
		{
			$_SESSION['deleteresult']=1;
			$_SESSION['deletemessage']="File Deleted Successfully";
		}
		else
		{
			$_SESSION['deleteresult']=2;
			$_SESSION['deletemessage']="Cannot Delete File";
		}
	}
	else
	{
		$_SESSION['deleteresult']=2;
		$_SESSION['deletemessage']="File not found";
		}

	redirect("courses.php?courseid=".$_POST['courseid']."&item=".$_POST['itemtype']);

?>