<!-- A basic profile page for users -->

<?php
	session_start();
	require_once('connectiondata.php');
	require_once('functions.php');

	if(check_login_status()==false)
	{
		redirect('index.php');
	}

	//Check Userid
?>

<html>
<head>

	<title>iPortal - Profile</title>
	<link rel="stylesheet" href="css/profile.css" />
	<?php include_once('header_includes.php'); ?>

</head>
<body>

<div class="mainBody">

	<?php include_once('header.php'); ?>
	
	<div class="main">

		<!-- List of the courses followed by the user -->

		<div class="courseslist">
		
			<div class="mycourseslistheader">
				<center>
					<h3 class="courseslistheaderh3">Courses Followed</h3>
				</center>
			</div>
			<div class="courseslistmain">
			
				<?php 

					$coursearray = get_followed_courses($_GET['userid']);
					for($i = 0;$i<sizeof($coursearray);$i++)
					{
						echo("<a href='courses.php?courseid=" . $coursearray[$i][2] . "'>");
						echo("<div class='courseslistmainitem'>");
						echo("<center><h2 class='courselistitemname'>" . $coursearray[$i][0] . "</h2></center></div></a>");
					}
				?>

			</div>
		</div>

		<!-- General Information of the user -->

		<div class="generalinfoouter">
			<div class="generalinfoinner">
				<center>
				<h3 class='InfoName'><?php echo(get_name($_GET['userid'])) ?></h3>
				<h3 class='InfoType'><?php echo(get_user_type($_GET['userid'])) ?></h3>
				<h3 class='InfoDep'><?php echo(getDepartmentName(get_department_id($_GET['userid']))) ?></h3>
				<h3 class='InfoUsername'>Username: <?php echo(get_username($_GET['userid'])) ?></h3>
				</center>
			</div>
		</div>
	</div>
	
	<?php include_once('footer.php'); ?>

</body>
</html>