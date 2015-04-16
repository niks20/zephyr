
<?php
	session_start();
	require_once('connectiondata.php');
	require_once('functions.php');


	//Checks if the username or password field is empty or has invalid entry
	if ( (!isset($_POST['username'])) || (!isset($_POST['password'])) || (!ctype_alnum($_POST['username'])) )
       {
              $_SESSION['loginerror'] = "*Invalid Username";
              redirect('index.php');
       }
  
       $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  
       if (mysqli_connect_errno())
       {
       		$_SESSION['loginerror'] = "*Unable to connect to database.". mysqli_connect_error();
            redirect('index.php');
       }
  
       // Escape any unsafe characters before querying database
       $username = mysqli_real_escape_string($con,$_POST['username']);
       $password = mysqli_real_escape_string($con,$_POST['password']);
  
       // Construct SQL statement for query & execute
       $sql = "SELECT * FROM userlist WHERE username = '" . $username . "' AND password = '" . md5($password) . "'";
       $result = mysqli_query($con,$sql);
       if (is_object($result) && mysqli_num_rows($result) == 1)
       {
              $row = mysqli_fetch_array($result, MYSQL_ASSOC);
              $_SESSION['logged_in'] = true;
              $_SESSION['userid'] = $row["id"];
              $_SESSION['key'] = $row["password"];
              $_SESSION['type'] = $row["type"];
              $_SESSION['username'] = $row["username"];
              $_SESSION['name'] = $row["name"];
              redirect('home.php');
       }

       else
       {
              $_SESSION['loginerror'] = "*Incorrect Username or Password";
              redirect('index.php');
       }

       mysqli_free_result($result);

?>