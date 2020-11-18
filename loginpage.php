<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="/files/mainPageStyles.css">
<title>DigiGames</title>
</head>

<body>
<!-- The Header Bar. Used to navigate to different parts of the site.--->
<div id="navigationBar">

<div id="headerImage">
<a href="/mainpage.php"><img border="0" alt="Home" src="/files/digigameslogo.png" width="100%" height="100%"></img></a>
</div>

<div id="headerSearchBar">
<form class="headerForm" action="javascript:searchFunction();">
<input type="text" name="search" id="searchField" placeholder="Search for games by title, genre, and more">
<input type="submit" name="submitButton" id="searchButton" value="Search">
</form>
</div>

<div id="profileIcon">
<a href="/profileSettings.php"><img border="0" alt="Home" src="/files/user.png" width="100%" height="100%"></img></a>
</div>

<?php
session_start();
if(isset($_SESSION['loggedin'])){
echo	'<div id="logoutIcon">';
echo	'<a href="/logoutpage.php"><img border="0" alt="Log Out" src="/files/logout.png" width="100%" height="100%"></img></a>';
echo	'</div>';
}else{
echo	'<div id="logoutIcon">';
echo	'<a href="/loginpage.php"><img border="0" alt="Log In" src="/files/login.png" width="100%" height="100%"></img></a>';
echo	'</div>';
}
?>

<div id="headerRule">
<hr>
</div>
</div>

<!-- Main Bar. Contains the remaining content of the page. Scrollable. --->
<div id="mainBar">

<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post" autocomplete="off">
<br/>
Username: <input type = "text" name = "usernametb"/>
<br/><br/>
Password: <input type = "password" name = "passwordtb"/>
<br/><br/>
<input type = "submit" value = "Login" name = "logintb"/>
</form>

<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
{
	header ("location: mainpage.php");
	exit;
}

$username_err = $password_err = "";

if (isset($_POST['logintb']))
{
	if (empty(trim($_POST['usernametb']))) $username_err = "Please enter username."; //Check if username box is empty
	else $user = trim($_POST['usernametb']);

	if (empty(trim($_POST['passwordtb']))) $password_err = "Please enter password"; //Check if password box is empty
	else $pass = trim($_POST['passwordtb']);

	if (empty($username_err) && empty($password_err))
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "DIGIGAMES";
		$link = new mysqli ($servername, $username, $password, $dbname);

		$sql = "SELECT accountID, userName, hashedPassword FROM useraccounts WHERE userName = ?";
		if ($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "s", $param_username); //Bind variables to statement
			$param_username = $user;
			if (mysqli_stmt_execute($stmt))
			{
				mysqli_stmt_store_result($stmt);
				if (mysqli_stmt_num_rows($stmt) == 1) //Check if username in the system
				{
					mysqli_stmt_bind_result($stmt, $id, $user, $hashed_password); //Bind result variables
					if (mysqli_stmt_fetch($stmt))
					{
						if   ($pass == $hashed_password) //For hash: (password_verify($pass, $hashed_password))
						{
							session_start();
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["username"] = $user;

							header ("location: mainpage.php");
						}
						else
						{
							echo "The password was not valid";
						}
					}
				}
				else
				{
					echo "No account with that username";
				}
			}
			else
			{
				echo "Oops! Something went wrong. Try again later";
			}
			mysqli_stmt_close($stmt);
		}
	}
	mysqli_close($link);
}
?>