<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Mandela Effect</title>
  <meta name="DCSP Project">
  <meta name="Brady Kruse & Others">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="storefront.js"></script>

</head>

<body>

<a href='cart.php'>Click here to view cart</a>
<a href='account.php'>Click here to view account</a>

</body>

<?php
session_start();
require_once('login.php');
$conn = new mysqli($hn, $un, $pw, $db);

if(isset($_SESSION['username'])){
  echo "<h1>Welcome " . $_SESSION['username'] . " </h1>";
}
else{
  session_unset();
  $_SESSION['type'] = 'guest';
  echo "<h1>Welcome Guest </h1>";
}

echo "<p>We currently have the following items</p>";

$query = "SELECT * FROM items";
$result = $conn->query($query);

while($row = $result->fetch_array()){
 echo
 "<img id=" . $row['itemID'] . " src=" . $row['image_link'] . " alt=" . $row['item_name'] . " width=128 height=128 " . $row['itemID'] . ")></img>"; #STYLING!! #Need buttons for remove from cart / add to cart
 echo
 "<button onclick='AddToCart(" . $row['itemID'] . ")' user= " . $_SESSION['type'] . " id=AddToCart> Add to cart </button>";
 echo
 "<button onclick='RemoveFromCart(" . $row['itemID'] . ")'> Remove from cart </button>";
}

?>

</html>