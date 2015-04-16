<?php	

	//To remove a course for a user - Variables - courseid, userid

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

	$a = unfollow_course($_SESSION['userid'],$_GET['courseid']);

	if($a==true)
	{
		$_SESSION['followresult']=3;
		$_SESSION['followmessage']="Unfollowed!";
	}
	else
	{
		$_SESSION['followresult']=2;
		$_SESSION['followmessage']="Cannot Unfollow!";
	}
	
	redirect('courses.php?courseid='.$_GET['courseid'].'&item='.$item);

?>