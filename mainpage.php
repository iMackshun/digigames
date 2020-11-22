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
<?php
session_start();
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

<div id="headerRule">
<hr>
</div>
</div>

<!-- Main Bar. Contains the remaining content of the page. Scrollable. --->
<div id="mainBar">

<!-- Contains an image of a game that is being promoted by the service.--->
<div id="promotionalSection">

<div id="promotionalImage">
<a href="/detailspage.php?gameID=2"><img border="0" alt="Home" src="/files/jsrpromo.jpg" width="100%" height="100%"></img></a>
</div>

<div id="promotionalData">
<h1 id="promotionalTitle">Jet Set Radio</h1>
<h2 id="promotionalTitle">Tag, grind, and trick to the beat in SEGA’s hit game Jet Set Radio! Fight for control of Tokyo-to, mark your turf with graffiti, tag walls, billboards, and even rival gang members! Perform tricks and flips on magnetically driven in-line skates, but watch out for the local police force!</h2>
</div>

<div id="promotionalLeftArrow">
<button type="button"><img border="0" alt="Left" src="/files/left.png" width="100%" height="100%"></button>
</div>

<div id="promotionalRightArrow">
<button type="button"><img border="0" alt="Right" src="/files/right.png" width="100%" height="100%"></button>
</div>

</div>

<!-- Contains an array of games that are recommended for the user to play. Based on the user's favorite genre.--->

<div id="recommendedSection">

<div id="recommendedText">
<h1>Recommended for you:<h1>
</div>

<?php
if(isset($_SESSION['loggedin'])){
	echo '<div id="recommendedGameEntries">';
	echo '<ul id="recommendedGameEntryList">';

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "digigames";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if(isset($_SESSION['loggedin'])){
		$id = $_SESSION["id"];
		$sqlThree = "SELECT * FROM useraccounts WHERE accountID=$id";
		$accountResult = $conn->query($sqlThree);
		$accountRow = $accountResult->fetch_assoc();
		$favGenre = $accountRow['favoriteGenre'];
		$sql = "SELECT * FROM gamelibrary WHERE genre='$favGenre'";
		$result = $conn->query($sql);
	}else{
		$sql = "SELECT * FROM gamelibrary WHERE genre='Fighting'";
		$result = $conn->query($sql);
	}

	$count = 0;
	if ($result->num_rows > 0) {
		while (($row = $result->fetch_assoc()) && $count < 6){
			echo "<li class='recommendedGameEntry'>";
			echo '<h1>'.$row['genre'].'</h1>';
			echo "<div class='recommendedGameEntryImage'>";
			echo '<a href="/detailspage.php?gameID='.$row['gameID'].'">';
			echo '<img border="0" alt="Home" src="'.$row['imageLink'].'" width="100%" height="100%"></img>';
			echo "</a>";
			echo "</div>";
			echo '<h1 class="recommendedGameEntryLabel">'.$row['title'].'</h1>';
			echo "</li>";
			$count++;
		}
	}
}
?>
</ul>
</div>

</div>

<!-- Center the promotional bar. --->
<script>
var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
var prmSec = document.getElementById("promotionalSection");
if(prmSec && prmSec.style){
	var offset = String((width - 1128)/2.0);
	prmSec.style.left = offset.concat("px");
}
</script>

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
