
<!-- UI to read the message with the given message id -->
<!-- The message is accessible only if the user is either the sender or reciever of the message -->

<?php
	session_start();
	require_once('connectiondata.php');
	require_once('functions.php');

	if(check_login_status()==false)
	{
		redirect('index.php');
	}

	if(is_msg_accessible($_SESSION['userid'],$_GET['id'])==false)
	{
		redirect('inbox.php');
	}
	
?>

<html>
<head>
	<title>iPortal - Message</title>
	<link rel="stylesheet" href="css/read.css" />
	<?php include_once('header_includes.php'); ?>

</head>
<body>

<div class="mainBody">

	<?php include_once('header.php'); ?>

	<div class="main">
	
		<?php $msg = get_message_array($_GET['id']); ?>

		<center><h3 class='messageheading'>Message</h3></center>
		<center>
			<input type='text' class='input-large search-query' readonly='readonly' style="height:30px; margin-top:20px; width:120px; cursor:default" value="From:">
			<input type='text' class='input-large search-query' readonly='readonly' style="height:30px; margin-top:20px; width:320px; margin-left:5px; cursor:default"
				<?php

					echo "value='".get_user_pretty($msg['sid'])."'";

				?>

			>
		</center>
		<center>
			<input type='text' class='input-large search-query' readonly='readonly' style="height:30px; margin-top:10px; width:120px; cursor:default" value="To:">
			<input type='text' class='input-large search-query' readonly='readonly' style="height:30px; margin-top:10px; width:320px; margin-left:5px; cursor:default"
				<?php

					echo "value='".get_user_pretty($msg['rid'])."'";

				?>

			>
		</center>
		<center>
			<input type='text' class='input-large search-query' readonly='readonly' style="height:30px; margin-top:10px; width:120px; cursor:default" value="Subject:">
			<input type='text' class='input-large search-query' readonly='readonly' style="height:30px; margin-top:10px; width:320px; margin-left:5px; cursor:default"

				<?php

					echo "value='".$msg['subject']."'";

				?>

			>
			
			<textarea name='messagecontent' maxlength=500 readonly='readonly' style="resize:none; margin-top: 20px; height: 250px; width: 75%; cursor:default"><?php

					echo $msg['content'];

				?></textarea>
			<input type="button" class='btn' style="width:150px; margin-top:15px; margin-right:10px" value="Reply" onclick="location.href='compose.php'">
			<input type="button" class='btn' style="width:150px; margin-top:15px; margin-right:10px" value="Back" onclick="location.href='inbox.php'">
			</center>

	</div>

	<?php include_once('footer.php'); ?>
	
</body>
</html>