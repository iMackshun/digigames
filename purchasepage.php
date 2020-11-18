<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="/files/purchasePageStyles.css">
<title>DigiGames</title>
</head>

<?php
session_start();

if(!empty($_GET['gameID'])){
$gameID = $_GET['gameID'];
$id = $_SESSION["id"];	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digigames";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM gamelibrary WHERE gameID='$gameID'";
$gameResult = $conn->query($sql);
$gameRecord = $gameResult->fetch_assoc();
$usersql = "SELECT * FROM useraccounts WHERE accountID='$id'";
$userResult = $conn->query($usersql);
$userRecord = $userResult->fetch_assoc();

if(isset($_SESSION['loggedin'])){
	if(isset($_POST['purchaseBtn'])){		
			$insertquery = "INSERT INTO gamekeys VALUES ('$id', '$gameID')";
			$conn->query($insertquery);
			
			$paymentType = $_POST["paymentType"];
			
			if($paymentType == "paypal"){

			}
			else if($paymentType == "creditcard"){
				
			}
			
			header('location: detailspage.php?gameID='.$gameID);
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

<div id="headerRule">
<hr>
</div>
</div>

<!-- Main Bar. Contains the remaining content of the page. Scrollable. --->
<div id="mainBar">

<div id="paymentLabel">
<h1>Payment Type</h1>
</div>

<div id="paymentTypeBlock">
<form id="paymentTypeForm" method="post">
  <input type="radio" id="paypal" name="paymentType" value="paypal">
  <label for="paypal">PayPal</label><br>
  <input type="radio" id="creditcard" name="paymentType" value="creditcard">
  <label for="creditcard">Credit/Debit Card</label><br>
</form> 
</div>
<?php
echo '<div id="gameInfoBlock">';
echo '<div id="gameImage">';
echo '<img border="0" alt="Home" src='.$gameRecord['imageLink'].' width="100%" height="100%"></img>';
echo '</div>';

echo '<div id="gameTitle">';
echo '<h1>'.$gameRecord['title'].'</h1>';
echo '</div>';

echo '<div id="gamePrice">';
echo '<h1>$'.$gameRecord['normalPrice'].'</h1>';
echo '</div>';
echo '</div>';

echo '<div id="purchaseBlock">';
echo '<div id="subtotalLabel">';
echo '<h1>Subtotal</h1>';
echo '</div>';
echo '<div id="subtotalAmountLabel">';
echo '<h1>$'.$gameRecord['normalPrice'].'</h1>';
echo '</div>';

echo '<div id="salesTaxLabel">';
echo '<h1>Sales Tax</h1>';
echo '</div>';
echo '<div id="salesTaxAmountLabel">';
echo '<h1>$0.00</h1>';
echo '</div>';

echo '<div id="totalLabel">';
echo '<h1>Total</h1>';
echo '</div>';
echo '<div id="totalAmountLabel">';
echo '<h1>$'.$gameRecord['normalPrice'].'</h1>';
echo '</div>';
?>

<form class="purchaseForm" action="" method="post">
<input type="submit" name="purchaseBtn" id="purchaseButton" value="Purchase">
</form>
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