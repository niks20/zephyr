<?php 

require_once('connectiondata.php');

//To redirect to a page

function redirect($page)
{
	header('Location: ' . $page);
	die();
}

//Checks Login Status

function check_login_status()
{
	if (isset($_SESSION['logged_in']))
	{
		return $_SESSION['logged_in'];
	}

	return false; 
}

//Returns ########################################################

function get_faculty_name($facultyid)
{	
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM userlist WHERE id = " . $facultyid . " AND type = 2";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		return $row['name'];
	}

	else
	{
		printf("Invalid Faculty id !");
	    exit();
	}
}


//Gives a merged array of all the available users and courses for search

function get_merged_search_array()
{
	$arr1 = get_all_users_array_search();
	$arr2 = get_all_courses_array_search();
	$arr = array_merge($arr1,$arr2);
	return $arr;
}


//Gives the full address/location of the current page

function curPageURL()
{
	$pageURL = 'http';

	$pageURL .= "://";

	if ($_SERVER["SERVER_PORT"] != "80")
	{
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}
	else
	{
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}

	return $pageURL;
}


//Gives a user-friendly filesize for the given file and its directory

function pretty_filesize($dir,$file)
{
	$size = filesize($dir.$file);

	if($size<1024)
	{
		$size = $size." Bytes";
	}
	else if(($size<1048576)&&($size>1023))
	{
		$size=round($size/1024, 1)." KB";
	}
	else if(($size<1073741824)&&($size>1048575))
	{
		$size=round($size/1048576, 1)." MB";
	}
	else
	{
		$size=round($size/1073741824, 1)." GB";
	}

	return $size;
}


//Gives a detailed extension for the given extension

function pretty_filetype($ext)
{
	switch ($ext)
	{
		case "png": $extn="PNG Image"; break;
		case "jpg": $extn="JPEG Image"; break;
		case "jpeg": $extn="JPEG Image"; break;
		case "svg": $extn="SVG Image"; break;
		case "gif": $extn="GIF Image"; break;
		case "ico": $extn="Windows Icon"; break;

		case "txt": $extn="Text File"; break;
		case "log": $extn="Log File"; break;
		case "htm": $extn="HTML File"; break;
		case "html": $extn="HTML File"; break;
		case "xhtml": $extn="HTML File"; break;
		case "shtml": $extn="HTML File"; break;
		case "php": $extn="PHP Script"; break;
		case "js": $extn="Javascript File"; break;
		case "css": $extn="Stylesheet"; break;

		case "pdf": $extn="PDF Document"; break;
		case "xls": $extn="Spreadsheet"; break;
		case "xlsx": $extn="Spreadsheet"; break;
		case "doc": $extn="Microsoft Word Document"; break;
		case "docx": $extn="Microsoft Word Document"; break;

		case "zip": $extn="ZIP Archive"; break;
		case "htaccess": $extn="Apache Config File"; break;
		case "exe": $extn="Windows Executable"; break;

		default:
		if($ext!="")
		{
			$extn=strtoupper($ext)." File";
		}
		else
		{
			$extn="Unknown";
		}
	}

	return $extn;
}

function getPasswordMD5($userid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM userlist WHERE id = ".$userid;

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		return $row['password'];
	}

	else
	{
		printf("Invalid id !");
	    exit();
	}
}

function changepassword($userid,$passwordMD5)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "UPDATE userlist SET password='" . $passwordMD5 . "' WHERE id = ".$userid;

	$result = mysqli_query($con,$sql); 

	return $result;
}

function getDepartmentName($departmentid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM dep WHERE id = ".$departmentid;

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		return $row['department'];
	}

	else
	{
		printf("Invalid id !");
	    exit();
	}
}

function pretty_timestamp($timestamp1)
{
	$timestamp2 = strtotime($timestamp1);
	return date("d M Y h:i a", $timestamp2);
}
?>
