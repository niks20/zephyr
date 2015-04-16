<?php

session_start();

require_once('functions.php');

if (check_login_status() == false)
{
	redirect('\index.php');
}

else
{
	/*
	unset($_SESSION['logged_in']);
	unset($_SESSION['userid']);
	unset($_SESSION['key']);
	unset($_SESSION['type']);
	unser($_SESSION['username']);*/
	session_unset();
	session_destroy();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="refresh" content="1; url=index.php">
	<title>iPortal - Logged Out</title>
	<link rel="stylesheet" type="text/css" href="css/logout.css" />
</head>
<body>
<center>
<h1>Logged Out</h1>
<p>You have successfully logged out. Redirecting to <a href="index.php">login</a> screen.</p>
</center>
</body>
</html>
</html>