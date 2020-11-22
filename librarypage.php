<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="/files/libraryPageStyles.css">
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
	
	$keyssql = "SELECT * FROM gamekeys WHERE accountID=$id";
	$ownedKeys = $conn->query($keyssql);
	$finalQuery = "";
	while (($row = $ownedKeys->fetch_assoc())){
		if($finalQuery == ""){
			$finalQuery .= '(SELECT * FROM gamelibrary WHERE gameID='.$row['gameID'].')';
		}else{
			$finalQuery .= 'UNION (SELECT * FROM gamelibrary WHERE gameID='.$row['gameID'].')';
		}
	}
	if(!empty($finalQuery)){
		$searchResults = $conn->query($finalQuery);
	}
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
if (!empty($searchResults)) {
	if ($searchResults->num_rows > 0) {
		while (($row = $searchResults->fetch_assoc())){
			echo '<li class="searchResultsListItem">';
			echo '<div class="searchResultsListBlock">';
			echo '<div class="searchResultsItemImage">';
			echo '<a href="/detailspage.php?gameID='.$row['gameID'].'"><img border="0" alt="Logo" src="'.$row['imageLink'].'" width="100%" height="100%"></img></a>';
			echo '</div>';
			echo '<div class="searchResultsItemTitle">';
			echo '<h1>'.$row['title'].'</h1>';
			echo '</div>';
			echo '<div class="searchResultsItemDescription">';
			echo '<p>'.$row['description'].'</p>';
			echo '</div>';
			echo '<div class="searchResultsItemPrice">';
			echo '<h1>'.$row['normalPrice'].'</h1>';
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
