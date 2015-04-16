<?php

	//Uploads the file to the proper folder
	//File stored in $_FILES["file"] variable
	//Proper Folder identified from courseid and itemtype

	session_start();

	include_once('functions.php');

	if ($_FILES["file"]["error"] > 0)
	{
		$_SESSION['uploadresult'] = 3;
		$_SESSION['uploadmessage'] = "Unknown Error";
	}
	else
	{
		//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		//echo "Type: " . $_FILES["file"]["type"] . "<br>";
		//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

		if (file_exists("courses/".$_POST['courseid']."/".$_POST['itemtype']."/". $_FILES["file"]["name"]))
		{
			$_SESSION['uploadresult'] = 2;
			$_SESSION['uploadmessage'] = "File Already Exists";
		}

		else
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"courses/".$_POST['courseid']."/".$_POST['itemtype']."/". $_FILES["file"]["name"]);
			$_SESSION['uploadresult'] = 1;
			$_SESSION['uploadmessage'] = "File Uploaded Successfully";
		}

	}

	redirect("courses.php?courseid=".$_POST['courseid']."&item=".$_POST['itemtype']);

?>