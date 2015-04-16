<?php 

require_once('connectiondata.php');

//Creates an entry in database corresponding to the required message - Variables - Sender Id, Reciever Id, Content(Message)

function sendmessage($rid,$sid,$subject,$content)
{

	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql="INSERT INTO messages (rid,sid,subject,content,seen) VALUES ('".$rid."','".$sid."','".$subject."','".$content."',0);";

	$result = mysqli_query($con,$sql) or die('Message not sent: '.mysql_error());

	return $result;
}


//Returns whether the message with the given messageid is accessible to the user with the given userid

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


//Returns an array containing all the information (rid,sid,content) of the message with the given messageid

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

function get_inbox_messages($userid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * from messages WHERE rid=" .$userid. " ORDER BY timestamp1 DESC";

	$result = mysqli_query($con,$sql); 

	$size = mysqli_num_rows($result);

	if($size==0)
	{
		return array();
	}
	else
	{
		for($i=0;$i<$size;$i++)
		{
			$row = mysqli_fetch_assoc($result);
			$ans[] = $row;
		}
	}

	return $ans;
}

function get_outbox_messages($userid)
{
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
	if (mysqli_connect_errno())
	{
	      printf("Unable to connect to database: %s", mysqli_connect_error());
	      exit();
	}

	$sql = "SELECT * from messages WHERE sid=" .$userid. " ORDER BY timestamp1 DESC";

	$result = mysqli_query($con,$sql); 

	$size = mysqli_num_rows($result);

	if($size==0)
	{
		return array();
	}
	else
	{
		for($i=0;$i<$size;$i++)
		{
			$row = mysqli_fetch_assoc($result);
			$ans[] = $row;
		}
	}

	return $ans;
}

?>
