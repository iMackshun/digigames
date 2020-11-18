<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="/files/detailsPageStyles.css">
<title>DigiGames</title>
</head>

<?php
if(!empty($_GET['gameID'])){
$gameID = $_GET['gameID'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digigames";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM gamelibrary WHERE gameID='$gameID'";
$gameResult = $conn->query($sql);
$gameRecord = $gameResult->fetch_assoc();

$sqlTwo = "SELECT * FROM gamekeys WHERE accountID=1 AND gameID='$gameID'";
$ownResult = $conn->query($sqlTwo);

$sqlThree = "SELECT * FROM useraccounts WHERE accountID=1";
$accountResult = $conn->query($sqlThree);
$accountRow = $accountResult->fetch_assoc();
$accountStatus = $accountRow['membershipStatus'];

$sqlFour = "SELECT * FROM ratings WHERE gameID='$gameID'";
$ratingsResult = $conn->query($sqlFour);

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
<a href="/profileSettings.php"><img border="0" alt="Home" src="/files/user.png" width="100%" height="100%"></img></a>
</div>

<div id="headerRule">
<hr>
</div>
</div>

<!-- Main Bar. Contains the remaining content of the page. Scrollable. --->
<div id="mainBar">

<div id="gameDetailsBar">

<div id="gameScreenshot">
<?php
echo '<img border="0" alt="Home" src="'.$gameRecord['screenshotLink'].'" width="100%" height="100%"></img>';
?>
</div>

<div id="gameDetails">
<div id="gameTitleLabel">
<?php
echo '<h1>'.$gameRecord['title'].'</h1>';
?>
</div>

<div id="gameDescriptionLabel">
<?php
echo '<p>'.$gameRecord['description'].'</p>';
?>
</div>
</div>
</div>

<?php
echo '<div id="purchaseDetailsBar">';
echo '<div id="purchaseButton">';
echo '<button type="button">Purchase</button>';
echo '</div>';
if($ownResult->num_rows == 0){
echo '<div id="purchasePrice">';
if($accountStatus == 0){
echo '<h1>$'.$gameRecord['normalPrice'].'</h1>';
}else{
echo '<h1>$'.$gameRecord['proPrice'].'</h1>';
}
echo '</div>';
}
echo '<div id="purchaseStatus">';
if($ownResult->num_rows == 0){
	echo '<h1>You currently do not own this game.</h1>';
}else{
	echo '<h1>This game was purchased.</h1>';
}
echo '</div>';
echo '</div>';
?>

<div id="ratingsBar">
<div id="ratingsLabel">
<h1>Reviews</h1>
</div>

<div id="ratingsFormBar">
<form class="ratingsForm" action="">
<label for="ratingField">Rating:</label>
<input type="number" name="rating" id="ratingField" min="1" max="5"><br>
<label for="reviewField">Review:</label>
<input type="text" name="review" id="reviewField" placeholder="Share your thoughts about this title...">
<input type="submit" name="submitRating" id="submitRatingButtonButton" value="Submit">
</form>
<div id="ratingRule">
<hr>
</div>
</div>

<div id="ratingsListArea">
<ul id="ratingsList">
<?php
$count = 0;
if ($ratingsResult->num_rows > 0) {
	while (($row = $ratingsResult->fetch_assoc()) && $count < 5){
		echo '<li class="ratingsListItem">';
		echo '<div class="ratingsBlock">';

		echo '<div class="ratingsUserImage">';
		echo '<img border="0" alt="Home" src="/files/user.png" width="100%" height="100%"></img>';
		echo '</div>';

		echo '<div class="ratingsUsername">';
		echo '<h1>'.$row['accountID'].'</h1>';
		echo '</div>';

		echo '<div class="ratingsDataBlock">';
		echo '<div class="ratingNumber">';
		echo '<h1>Rating: '.$row['rating'].'</h1>';
		echo '</div>';
		echo '<div class="ratingReview">';
		echo '<h1>'.$row['ratingDescription'].'</h1>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</li>';
	}
}
?>
</ul>
</div>

</div>

</div>

</div>

</body>

<script>
function searchFunction()
{
	var baseStr = "http://localhost/searchPage.php?query=";
	var searchQuery = document.getElementById("searchField").value;
	var finalSlash = "/";
	var finalString = baseStr.concat(searchQuery, finalSlash);
	window.location.href = finalString;
}
</script>