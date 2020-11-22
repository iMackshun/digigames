<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="/files/profileSettingsPageStyles.css">
<title>DigiGames</title>
</head>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digigames";
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_SESSION['loggedin'])){
	$id = $_SESSION["id"];
	$user = $_SESSION["username"];

	$sqlGetUser = "SELECT * FROM useraccounts WHERE accountID=$id";
	$accountResult = $conn->query($sqlGetUser);
	$accountRow = $accountResult->fetch_assoc();
}
?>

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
<?php
if(isset($_SESSION['loggedin'])){
echo '<a href="/profileSettings.php"><img border="0" alt="Home" src="/files/user.png" width="100%" height="100%"></img></a>';
}else{
echo '<a href="/loginpage.php"><img border="0" alt="Home" src="/files/user.png" width="100%" height="100%"></img></a>';
}
?>
</div>

<?php
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

<div class="sectionRule">
<hr>
</div>
</div>

<!-- Category Bar. Contains Buttons denoting the category that is to be examined. --->
<div id="categoryBar">
<button id="profileSettingsButton" type="button" onclick="location.href='/profileSettings.php'">Profile Settings</button>
<button id="transactionsButton"type="button" onclick="location.href='/transactionspage.php'">Transactions</button>
<button id="libraryButton"type="button" onclick="location.href='/libraryPage.php'">Library</button>
<div class="sectionRule">
<hr>
</div>
</div>

<!-- Main Bar. Contains the remaining content of the page. Scrollable. --->
<div id="mainBar">
<form class="accountSettingsForm" action="" method="post">
<?php
echo '<label for="usernameField">Username:</label>';
echo '<input type="text" name="usernameFd" id="usernameField" value="'.$accountRow['userName'].'"><br>';

echo '<label for="passwordField">Password:</label>';
echo '<input type="password" name="passwordFd" id="passwordField" value="'.$accountRow['hashedPassword'].'"><br>';

echo '<label for="emailField">Email Address:</label>';
echo '<input type="text" name="emailFd" id="emailField" value="'.$accountRow['emailAddress'].'"><br>';

echo '<label for="securityAField">Security Response A:</label>';
echo '<input type="text" name="securityAFd" id="securityAField" value="'.$accountRow['securityResponseA'].'"><br>';

echo '<label for="securityBField">Security Response B:</label>';
echo '<input type="text" name="securityBFd" id="securityBField" value="'.$accountRow['securityResponseB'].'"><br>';

echo '<label for="paypalEmailField">Paypal Email Address:</label>';
echo '<input type="text" name="paypalEmailFd" id="paypalEmailField" value="'.$accountRow['paypalAddress'].'"><br>';

echo '<label for="favGenreField">Favorite Genre:</label>';
echo '<input type="text" name="favGenreFd" id="favGenreField" value="'.$accountRow['favoriteGenre'].'"><br>';
?>

<input type="submit" name="updateSettingsBtn" id="updateSettingsButton" value="Update">
</form>

<?php
if(isset($_SESSION['loggedin'])){
	if(isset($_POST['updateSettingsBtn'])){
		$sql_update= "UPDATE useraccounts SET username='$_POST[usernameFd]', hashedPassword='$_POST[passwordFd]', emailAddress='$_POST[emailFd]', securityResponseA='$_POST[securityAFd]', securityResponseB='$_POST[securityBFd]', paypalAddress='$_POST[paypalEmailFd]', favoriteGenre='$_POST[favGenreFd]' WHERE accountID=$id";
		$updateresult = $conn->query($sql_update);

		if($updateresult)
		{
			echo '<h1 class="recordUpdateText">Records updated successfully</h1>';
		}
		header('Refresh:0');
	}
}
?>

</div>

</body>

<script>
function searchFunction()
{
	var baseStr = "http://localhost/searchPage.php?query=";
	var searchQuery = document.getElementById("searchField").value;
	var finalSlash = "/";
	var finalString = baseStr.concat(searchQuery);
	window.location.href = finalString;
}
</script>
