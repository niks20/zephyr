<?php 

require_once('connectiondata.php');

function redirect($page)
{
	header('Location: ' . $page);
	die();
}

function check_login_status()
{
	if (isset($_SESSION['logged_in']))
	{
		return $_SESSION['logged_in'];
	}

	return false; 
}

function get_followed_courses($userid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM usercourse WHERE userid = '" . $userid . "'";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);
	$ans = array();
	if($size==0)
	{
		return $ans;
	}

	else if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		$tempstring = "SELECT * FROM courselist WHERE courseid = ".$row['courseid'];
	}

	else
	{
		$row = mysqli_fetch_assoc($result);
		$tempstring = "SELECT * FROM courselist WHERE courseid = ".$row['courseid'];

		while($row = mysqli_fetch_assoc($result))
		{
			$tempstring = $tempstring." OR courseid = ".$row['courseid'];
		}
	}

	$result = mysqli_query($con,$tempstring);
	
	for($i=0;$i<$size;$i++)
	{
		$row = mysqli_fetch_assoc($result);
		$ans[] = array($row['coursetype'].$row['coursenumber'],$row['coursename'],$row['courseid']);
	}

	return $ans;
}

function get_unfollowed_courses($userid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM usercourse WHERE userid = '" . $userid . "'";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	$ans = array();

	if($size==0)
	{
		$tempstring = "SELECT * FROM courselist";
	}

	else if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		$tempstring = "SELECT * FROM courselist WHERE courseid <> ".$row['courseid'];
	}

	else
	{
		$row = mysqli_fetch_assoc($result);
		$tempstring = "SELECT * FROM courselist WHERE courseid <> ".$row['courseid'];

		while($row = mysqli_fetch_assoc($result))
		{
			$tempstring = $tempstring." AND courseid <> ".$row['courseid'];
		}
	}

	$result = mysqli_query($con,$tempstring);

	$size = mysqli_num_rows($result);
	
	for($i=0;$i<$size;$i++)
	{
		$row = mysqli_fetch_assoc($result);
		$ans[] = array($row['coursetype'].$row['coursenumber'],$row['coursename'],$row['courseid']);
	}

	return $ans;
}

function get_course_array($courseid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM courselist WHERE courseid = " . $courseid;

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);
	$ans = array();
	if($size==0)
	{
		return $ans;
	}

	else if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	else
	{
		printf("Multiple Courses Matched !");
	    exit();
	}
}

function get_faculty_id($courseid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM courselist WHERE courseid = " . $courseid;

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==0)
	{
		return $NULL;
	}

	else if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		return $row['facultyid'];
	}

	else
	{
		printf("Multiple Courses Matched !");
	    exit();
	}
}
 
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

function get_all_users_array_search()
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM userlist";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	$arr=array();

	for($i=0;$i<$size;$i++)
	{
		$row = mysqli_fetch_assoc($result);
		$arr[] = $row['username'] . " - " . $row['name'];
	}

	return $arr;

}

function get_all_courses_array_search()
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM courselist";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	$arr=array();

	for($i=0;$i<$size;$i++)
	{
		$row = mysqli_fetch_assoc($result);
		$arr[] = $row['coursetype'] . $row['coursenumber'] . ": ".$row['coursename'];
	}

	return $arr;

}

function get_merged_search_array()
{
	$arr1 = get_all_users_array_search();
	$arr2 = get_all_courses_array_search();
	$arr = array_merge($arr1,$arr2);
	return $arr;
}

function get_course_id($coursetype,$coursenumber)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT courseid FROM courselist WHERE coursetype='" . $coursetype . "' and coursenumber=" . $coursenumber;

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==0)
	{
		return NULL;
	}
	else
	{
		$row = mysqli_fetch_assoc($result);
		return $row['courseid'];
	}

}

function get_user_id($username)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT id FROM userlist WHERE username='" . $username . "'";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==0)
	{
		return NULL;
	}
	else
	{
		$row = mysqli_fetch_assoc($result);
		return $row['id'];
	}

}

function get_user_id_name($name)
{

	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT id FROM userlist WHERE upper(name) LIKE upper('%" . $name . "%')";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		return $row['id'];
	}
	else
	{
		return NULL;
	}

}

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


function sendmessage($rid,$sid,$content)
{

	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql="INSERT INTO messages (rid,sid,content,seen) VALUES ('".$rid."','".$sid."','".$content."',0);";

	$result = mysqli_query($con,$sql) or die('Message not sent: '.mysql_error());

	return $result;
}

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

function is_course_followed($userid,$courseid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT id FROM usercourse WHERE userid=" . $userid . " and courseid=". $courseid;

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==0)
	{
		return false;
	}
	else
	{
		return true;
	}

}

function number_of_courses_followed($userid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT id FROM usercourse WHERE userid=" . $userid;

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	return $size;
}

function follow_course($userid,$courseid)
{

	$alreadyfollowed = is_course_followed($userid,$courseid);

	if($alreadyfollowed == true)
	{
		return 1;
	}
	else
	{

		if(number_of_courses_followed($userid)<9)
		{
			$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		  
			if (mysqli_connect_errno())
			{
			      printf("Unable to connect to database: %s", mysqli_connect_error());
			      exit();
			}

			$sql = "INSERT INTO usercourse (userid, courseid) VALUES ('" . $userid . "','". $courseid . "')";

			$result = mysqli_query($con,$sql); 

			if($result==false)
			{
				return 0;
			}
			else
			{
				return 2;
			}
		}
		else
		{
			return 10;
		}
	}
}

function unfollow_course($userid,$courseid)
{

	$alreadyfollowed = is_course_followed($userid,$courseid);

	if($alreadyfollowed == false)
	{
		return true;
	}
	else
	{
		$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	  
		if (mysqli_connect_errno())
		{
		      printf("Unable to connect to database: %s", mysqli_connect_error());
		      exit();
		}

		$sql = "DELETE FROM usercourse WHERE userid='" . $userid . "' and courseid='". $courseid . "'";

		$result = mysqli_query($con,$sql); 

		if($result==false)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

function is_msg_accessible($userid,$mid)
{

	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT rid,sid from messages WHERE id=" .$mid;

	$result = mysqli_query($con,$sql); 

	$size = mysqli_num_rows($result);

	if($size==0)
	{
		return false;
	}
	else
	{
		$row = mysqli_fetch_assoc($result);
		if($row['rid']==$userid)
		{
			return true;
		}
		else if($row['sid']==$userid)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

function get_message_array($mid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * from messages WHERE id=" .$mid;

	$result = mysqli_query($con,$sql); 

	$size = mysqli_num_rows($result);

	if($size==0)
	{
		return false;
	}
	else
	{
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
}

function get_user_pretty($userid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM userlist WHERE id=".$userid;

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);

	if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		return $row['username']." - ".$row['name'];
	}
	else
	{
		return NULL;
	}
}

function get_all_notifications($userid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM usercourse WHERE userid = '" . $userid . "'";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);
	$ans = array();

	if($size==0)
	{
		return $ans;
	}

	else if($size==1)
	{
		$row = mysqli_fetch_assoc($result);
		$tempstring = "SELECT * FROM notifications WHERE courseid = ".$row['courseid'];
	}

	else
	{
		$row = mysqli_fetch_assoc($result);
		$tempstring = "SELECT * FROM notifications WHERE courseid = ".$row['courseid'];

		while($row = mysqli_fetch_assoc($result))
		{
			$tempstring = $tempstring." OR courseid = ".$row['courseid'];
		}

		$tempstring = $tempstring. " ORDER BY timestamp DESC";
	}


	$result = mysqli_query($con,$tempstring);

	$size = mysqli_num_rows($result);
	
	for($i=0;$i<$size;$i++)
	{
		$row = mysqli_fetch_assoc($result);
		$ans[] = $row;
	}

	return $ans;
}

function get_all_course_notifications($courseid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM notifications WHERE courseid = " . $courseid . " ORDER BY timestamp DESC";

	$result = mysqli_query($con,$sql); 
	
	$size = mysqli_num_rows($result);
	$ans = array();
	
	for($i=0;$i<$size;$i++)
	{
		$row = mysqli_fetch_assoc($result);
		$ans[] = $row;
	}

	return $ans;
}

function add_notification($courseid,$notification)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql="INSERT INTO notifications (courseid,notification) VALUES (".$courseid.",'".$notification."')";

	$result = mysqli_query($con,$sql) or die('Notification Not Added: '.mysql_error());

	return $result;
}

function delete_notification($notificationid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}
	
	$sql="DELETE FROM notifications WHERE id=" .$notificationid;

	$result = mysqli_query($con,$sql) or die('Notification Not Added: '.mysql_error());

	return $result;
}


function get_course_pretty_id($courseid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * FROM courselist WHERE courseid = '" . $courseid . "'";

	$result = mysqli_query($con,$sql); 

	$row = mysqli_fetch_assoc($result);

	return $row['coursetype'].$row['coursenumber'];
}

?>
