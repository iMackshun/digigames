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

<div id="headerRule">
<hr>
</div>
</div>

<!-- Main Bar. Contains the remaining content of the page. Scrollable. --->
<div id="mainBar">

<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
<br/>
Username: <input type = "text" name = "usernametb"/>
<br/><br/>
Password: <input type = "text" name = "passwordtb"/>
<br/><br/>
<input type = "submit" value = "Login" name = "logintb"/>
</form>

<?php

if (isset($_POST['logintb']))
{
	$user = $_POST['usernametb'];
	$pass = $_POST['passwordtb'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "DIGIGAMES";

	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT COUNT(*) FROM useraccounts WHERE (userName = '$user' && hashedPassword = '$pass')";
	$result = $conn->query($sql);

	if ($result > 0) include 'mainpage.php';
	else echo "There is no account with these login credentials";
}

?>