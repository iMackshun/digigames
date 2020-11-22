<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="/files/transactionsPageStyles.css">
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

	$sqlGetTransactions = "SELECT * FROM transactions WHERE accountID=$id";
	$transactionResults = $conn->query($sqlGetTransactions);
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

<div id="searchResults">
<ul id="searchResultsList">

<?php
if (!empty($transactionResults)) {
	if ($transactionResults->num_rows > 0) {
		while (($row = $transactionResults->fetch_assoc())){
			echo '<li class="searchResultsListItem">';
			echo '<div class="searchResultsListBlock">';
			echo '<div class="searchResultsItemTitle">';
			echo '<h1>'.$row['date'].' | '.$row['price'].' | '.$row['gameTitle'].' | Payment Method: Paypal('.$row['paypalAddress'].')</h1>';
			echo '</div>';
			echo '</div>';
			echo '</li>';
		}
	}
}
?>

</ul>
</div>

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
