<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="/files/detailsPageStyles.css">
<title>DigiGames</title>
</head>

<?php
session_start();

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

$sqlFour = "SELECT * FROM ratings WHERE gameID='$gameID'";
$ratingsResult = $conn->query($sqlFour);

if(isset($_SESSION['loggedin'])){
	$id = $_SESSION["id"];
	$user = $_SESSION["username"];
	$sqlTwo = "SELECT * FROM gamekeys WHERE accountID=$id AND gameID='$gameID'";
	$ownResult = $conn->query($sqlTwo);

	$sqlThree = "SELECT * FROM useraccounts WHERE accountID=$id";
	$accountResult = $conn->query($sqlThree);
	$accountRow = $accountResult->fetch_assoc();
	$accountStatus = $accountRow['membershipStatus'];
	
	if(isset($_POST['submitRatingBtn'])){
			$rating = $_POST['ratingFd'];
			$review = $_POST['reviewFd'];
			
			$checkquery = "SELECT * FROM ratings WHERE accountID='$id' AND gameID='$gameID'";
			$checkResult = $conn->query($checkquery);
			
			if($checkResult->num_rows == 0){
				$insertquery = "INSERT INTO ratings VALUES ('$id', '$gameID', '$rating', '$review')";
				$conn->query($insertquery);
			}else{
				$updatequery = "UPDATE ratings SET rating='$rating', ratingDescription='$review'";
				$conn->query($updatequery);
			}
			
			header('Refresh:0');
	}
	
	if(isset($_POST['deleteRatingBtn'])){
			$checkquery = "DELETE FROM ratings WHERE accountID='$id' AND gameID='$gameID'";
			$checkResult = $conn->query($checkquery);
			
			header('Refresh:0');
	}
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
if(isset($_SESSION['loggedin'])){
	if($ownResult->num_rows == 0){
	echo '<div id="purchaseDetailsBar">';
	echo '<div id="purchaseButton">';
	echo '<button type="button" onclick="location.href=\'/purchasePage.php?gameID='.$gameID.'\'">Purchase</button>';
	echo '</div>';
	}
	else{
	echo '<div id="purchaseDetailsBar">';
	echo '<div id="purchaseButton">';
	echo '<button type="button">Play</button>';
	echo '</div>';
	}
}else{
	echo '<div id="purchaseDetailsBar">';
	echo '<div id="purchaseButton">';
	echo '<button type="button" onclick="location.href=\'/loginpage.php\'">Purchase</button>';
	echo '</div>';
}
if(isset($_SESSION['loggedin'])){
	if($ownResult->num_rows == 0){
	echo '<div id="purchasePrice">';
	if($accountStatus == 0){
	echo '<h1 id="normalPrice">$'.$gameRecord['normalPrice'].'</h1>';
	}else{
	echo '<h1 id="proPrice">PRO: $'.$gameRecord['proPrice'].'</h1>';
	}
	echo '</div>';
	}
}else{
	echo '<div id="purchasePrice">';
	echo '<h1>$'.$gameRecord['normalPrice'].'</h1>';
	echo '</div>';
}
echo '<div id="purchaseStatus">';
if(isset($_SESSION['loggedin'])){
	if($ownResult->num_rows == 0){
		echo '<h1>You currently do not own this game.</h1>';
	}else{
		echo '<h1>This game was purchased.</h1>';
	}
}else{
	echo '<h1>You must be logged in to purchase a game.</h1>';
}
echo '</div>';
echo '</div>';
?>

<div id="ratingsBar">
<div id="ratingsLabel">
<h1>Reviews</h1>
</div>

<div id="ratingsFormBar">
<?php 
if(isset($_SESSION['loggedin'])){
echo '<form class="ratingsForm" action="" method="post">';
echo '<label for="ratingField">Rating:</label>';
echo '<input type="number" name="ratingFd" id="ratingField" min="1" max="5"><br>';
echo '<label for="reviewField">Review:</label>';
echo '<input type="text" name="reviewFd" id="reviewField" placeholder="Share your thoughts about this title...">';
echo '<input type="submit" name="submitRatingBtn" id="submitRatingButton" value="Submit">';
echo '</form>';
}else{
echo '<form class="ratingsForm" action="" method="post" onsubmit="myButton.disabled = true; return true;">';
echo '<label for="ratingField">Rating:</label>';
echo '<input type="number" name="ratingFd" id="ratingField" min="1" max="5" readonly><br>';
echo '<label for="reviewField">Review:</label>';
echo '<input type="text" name="reviewFd" id="reviewField" placeholder="Share your thoughts about this title..." readonly>';
echo '<input type="submit" name="submitRatingBtn" id="submitRatingButton" value="Submit">';
echo '</form>';
}
?>
<div id="ratingRule">
<hr>
</div>
</div>

<div id="ratingsListArea">
<ul id="ratingsList">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digigames";
$conn = new mysqli($servername, $username, $password, $dbname);

$count = 0;
if ($ratingsResult->num_rows > 0) {
	while (($row = $ratingsResult->fetch_assoc()) && $count < 5){
		$sql = "SELECT * FROM useraccounts WHERE accountID=".$row['accountID'];
		$accountFetchResult = $conn->query($sql);
		$accountRecord = $accountFetchResult->fetch_assoc();
		
		echo '<li class="ratingsListItem">';
		echo '<div class="ratingsBlock">';

		echo '<div class="ratingsUserImage">';
		echo '<img border="0" alt="Home" src="/files/user.png" width="100%" height="100%"></img>';
		echo '</div>';

		echo '<div class="ratingsUsername">';
		echo '<h1>'.$accountRecord['userName'].'</h1>';
		echo '</div>';

		echo '<div class="ratingsDataBlock">';
		echo '<div class="ratingNumber">';
		echo '<h1>Rating: '.$row['rating'].'</h1>';
		echo '</div>';
		echo '<div class="ratingReview">';
		echo '<h1>'.$row['ratingDescription'].'</h1>';
		echo '</div>';
		if(isset($_SESSION['loggedin'])){
			if($accountRecord['accountID'] == $id){
				echo '<form class="ratingDeleteForm" action="" method="post">';
				echo '<input type="submit" name="deleteRatingBtn" id="deleteRatingButton" value="Delete">';
				echo '</form>';
			}
		}
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
	var finalString = baseStr.concat(searchQuery);
	window.location.href = finalString;
}
</script>