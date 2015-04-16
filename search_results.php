<!-- Returns the search results for the query in the search bar -->
<!-- Reutrns no result found if no result matched with the query -->

<?php
	session_start();

	require_once('connectiondata.php');
	require_once('functions.php');

	mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	mysql_select_db('iportal');

	if(!isset($_POST['searchbar']))
	{
		redirect('home.php');
	}

	$content= $_POST['searchbar'];

	$coursetype = substr($content,0,3);
	$coursenumber = substr($content,3,3);

	if(strlen($coursetype)==3 and strlen($coursenumber)==3 and ctype_alnum($coursetype) and is_numeric($coursenumber))
	{
		$id = get_course_id($coursetype,$coursenumber);

		if($id==NULL)
		{

		}

		else
		{
			redirect('courses.php?courseid='.$id);
		}
	}

	$tempusername = strstr($content,'-',true);

	if($tempusername == FALSE)
	{
		$username = $content;
	}
	else
	{
		$username = substr($tempusername,0,-1);
	}

	if(ctype_alnum($username))
	{
		$id = get_user_id($username);

		if($id!=NULL)
		{
			redirect('profile.php?userid='.$id);
		}
		else
		{
			$id = get_user_id_name($username);

			if($id!=NULL)
			{
				redirect('profile.php?userid='.$id);
			}
		}
	}

	$_SESSION['searcherror'] = "No results found.";
	redirect($_POST['currurl']);
/*
	$sql1="SELECT * FROM userlist where username='".$_POST['searchbar']."'";
	$result=mysql_query($sql1) or die('error');
	//echo mysql_num_rows($result);
	if(mysql_num_rows($result)==1)
	{
		$searchtype="user";
	}
	else
	{

	}*/

?>