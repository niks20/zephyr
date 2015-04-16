<?php
	session_start();
	require_once('connectiondata.php');
	require_once('functions.php');

	if(check_login_status()==false)
	{
		redirect('index.php');
	}
?>

<html>
<head>
	<title>iPortal - Compose</title>
	<link rel="stylesheet" href="css/compose.css" />
	<?php include_once('header_includes.php'); ?>

</head>
<body>

<div class="mainBody">

	<?php include_once('header.php'); ?>

	<div class="main">
	
	<!-- Basic Form Design -->

		<center><h3 class='composeheading'>Compose</h3></center>
		<form align='center' class='messageform' action='sendmessage.php' method='post'>
		<center>
			<input type='text' name='messageto' class='input-large search-query span5' placeholder='To...' id='user_search_bar' autofocus='autofocus' style="height:30px; margin-top:10px;"

				<?php

					if(isset($_SESSION['composeuserbox']))
					{
						echo "value='".$_SESSION['composeuserbox']."'";

						unset($_SESSION['composeuserbox']);
					}
				?>

			>

			<input type='text' name='subject' class='input-large search-query span5' placeholder='Subject...' id='user_search_bar' style="height:30px; margin-top:15px;"

				<?php

					if(isset($_SESSION['subjectdata']))
					{
						echo "value='".$_SESSION['subjectdata']."'";

						unset($_SESSION['subjectdata']);
					}
				?>

			>
			<textarea name='messagecontent' maxlength=500 style="resize:none; margin-top: 20px; height: 250px; width: 75%;"><?php

					if(isset($_SESSION['composecontent']))
					{
						echo $_SESSION['composecontent'];
						unset($_SESSION['composecontent']);
					}
				?></textarea>

			

			<button type='submit' class='btn' style="width:150px; margin-top:15px; margin-right:10px">Send</button>
			<input type="button" class='btn' style="width:150px; margin-top:15px; margin-right:10px" value="Discard & Back" onclick="location.href='inbox.php'">
			</center>
		</form>
			
		<?php

			// Alert box to inform user about the result

			if(isset($_SESSION['sent']))
			{
				if(($_SESSION['sent'])==1)
				{
					echo ('

						<div class="alert alert-success" style="width: 70%; margin-left:12%; margin-right:12%"><a class="close" data-dismiss="alert">x</a>    
						<strong>Success!</strong> '.$_SESSION['messageresult'].'</div>

					');
				}

				else
				{
					echo ('

						<div class="alert alert-error" style="width: 70%; margin-left:12%; margin-right:12%"><a class="close" data-dismiss="alert">x</a> 
						<strong>Error!</strong> '.$_SESSION['messageresult'].'</div>

					');
				}

				unset($_SESSION['sent']);
				unset($_SESSION['messageresult']);
			}
				
		?>
		
	</div>

	<?php include_once('footer.php'); ?>
	
</body>
</html>