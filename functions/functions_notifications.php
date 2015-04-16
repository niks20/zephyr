<?php 

require_once('connectiondata.php');


//Returns all the notifications for the courses followed by the user with the given userid

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


//Returns all the notifications for the courses with the given courseid

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


//Adds an entry(notification) to the database 'notifications' - Variables - Courseid, NotificationContent

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


//Deletes an entry(notification) from the database 'notifications' - Variables - Notificationid

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

?>