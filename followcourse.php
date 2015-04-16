<?php	

	
	//To add a course for a user - Variables - courseid, userid

	session_start();

	require_once('functions.php');

	
	if(isset($_GET['item']))
	{
		$item = $_GET['item'];
	}
	else
	{
		$item = "intro";
	}

	$a = follow_course($_SESSION['userid'],$_GET['courseid']);

	if($a==0)
	{
		$_SESSION['followresult']=2;
		$_SESSION['followmessage']="Error!";
	}
	else if($a==10)
	{
		$_SESSION['followresult']=2;
		$_SESSION['followmessage']="9 Courses Already!";
	}
	else
	{
		$_SESSION['followresult']=1;
		$_SESSION['followmessage']="Course Followed!";
	}

	redirect('courses.php?courseid='.$_GET['courseid'].'&item='.$item);

?>