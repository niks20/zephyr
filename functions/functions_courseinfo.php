<?php 

require_once('connectiondata.php');


//Gives an array of all the courses followed by a given userid

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


//Gives an array of all the courses not followed by a given userid

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



//Gives the course details for the given courseid

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


//Gives the faculty id for the given courseid

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


//Gives an array of all the courses present in the database

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


//Returns courseid for the course with given coursetype and coursenumber

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


//Returns whether the given course is followed by the user with the given userid

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


//Returns the number of courses followed by the user with the given userid

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


//Creates an entry in database 'usercourse' which implies that the user with given userid follows the course with given courseid

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


//Deletes the entry in database 'usercourse' which implies that the user with given userid not does not follow the course with given courseid

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


//Returns a compact courseinfo of the form " courseid: coursename"

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
