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

	<title>iPortal - Inbox</title>
	<link rel="stylesheet" href="css/inbox.css" />
	<?php include_once('header_includes.php'); ?>

</head>
<body>

<div class="mainBody">

	<?php include_once('header.php'); ?>
	
	<div class="main" >
					
		<div class="mainbar">

			<div class="composebuttoncontainerouter">
				<a href='compose.php'><div class="composebuttoncontainerinner">
					<center>
						<h2 class='othertext'>Compose</h2>
					</center>
				</div></a>
			</div>

			<div class="currenttopiccontainer">
				<center>
					<h2 class='currenttopic'>Inbox</h2>
				</center>
			</div>

			<div class="othertopiccontainerouter">
				<a href='outbox.php'><div class="othertopiccontainerinner">
					<center>
						<h2 class='othertext'>Outbox</h2>
					</center>
				</div></a>
			</div>

		</div>

		<div class="messagetablecontainer">

			<table class="messagetable">
				<thead class="messagetablehead">
					<tr>
						<th style="word-wrap:break-word;width:30%;">Sender</th>
						<th style="word-wrap:break-word;width:40%;">Subject</th>
						<th style="word-wrap:break-word;width:30%;">Time</th>
					</tr>
				</thead>
				<tbody>

				<?php
					$inboxmessages = get_inbox_messages($_SESSION['userid']);
					$no_of_messages = sizeof($inboxmessages);

					for($i=0;$i<$no_of_messages ;$i++)
					{
						echo "<tr onclick=\"window.location='read.php?id=".$inboxmessages[$i]['id']."'\">";
						echo "<td valign='middle'>".get_user_pretty($inboxmessages[$i]['sid'])."</td>";
						echo "<td valign='middle'>".$inboxmessages[$i]['subject']."</td>";
						echo "<td valign='middle'>".pretty_timestamp($inboxmessages[$i]['timestamp1'])."</td>";
						echo "</tr>";
					}
				?>

				</tbody>
			</table>

		</div>

	</div>	
		
	
	<?php include_once('footer.php'); ?>

</body>
</html>