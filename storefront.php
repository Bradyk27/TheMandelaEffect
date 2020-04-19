<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Mandela Effect</title>
  <meta name="DCSP Project">
  <meta name="Brady Kruse & Others">

</head>

<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="storefront.js"></script>
</body>

<a href='cart.php'>Click here to view cart</a>
<a href='account.php'>Click here to view account</a>

<?php
require_once('login.php');

$conn = new mysqli($hn, $un, $pw, $db);

echo "<h1>Current Stock</h1>";
echo "<p>We currently have the following items</p>";

$query = "SELECT * FROM items";
$result = $conn->query($query);


while($row = $result->fetch_array()){
 echo
 "<img id=" . $row['itemID'] . " src=" . $row['image_link'] . " alt=" . $row['item_name'] . " width=128 height=128 onclick=AddToCart(" . $row['itemID'] . ")></img>"; #STYLING!! #Need buttons for remove from cart / add to cart
}

?>

</html>
