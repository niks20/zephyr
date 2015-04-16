<?php 

require_once('connectiondata.php');


//Gives an array of all the usernames

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


//Gives the userid of the user with the given username

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


//Gives the userid of the user with the given name

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


//Gives a complete user identity of the form " username - Name "

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

function get_name($userid)
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
		return $row['name'];
	}
	else
	{
		return NULL;
	}
}


function get_username($userid)
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
		return $row['username'];
	}
	else
	{
		return NULL;
	}
}


function get_user_type($userid)
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
		if($row['type']==1)
		{
			return 'Administrator';
		}
		else if($row['type']==2)
		{
			return 'Faculty';
		}
		else if($row['type']==3)
		{
			return 'Student';
		}
		else
		{
			return '';
		}
	}
	else
	{
		return NULL;
	}
			
}

function get_department_id($userid)
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
		return $row['departmentid'];
	}
	else
	{
		return NULL;
	}
}


?>
