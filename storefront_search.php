<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Mandela Effect</title>
  <meta name="DCSP Project">
  <meta name="Brady Kruse & Others">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="storefront.js"></script>
  <style>
        input {
      margin-bottom: 0.5em;
    }
    .mysection2 {
   background-color: aliceblue;
   width: 100%;


} 
.mysection {
   background-color: navy;
   width: 100%;
   height: 100px;
}
    .button {
  background-color: #87CEFA; 
  border: none;
  font-weight: bold;
  color: navy;
  padding: 12px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 8px 4px;
  cursor: pointer;
  -webkit-transition-duration: 0.7s; 
  transition-duration: 0.7s;
}
.buttono {
  background-color: #87CEFA;
  border: none;
  font-weight: bold;
  color: navy;
  padding: 12px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 16px 10px;
  cursor: pointer;
  display: flex; 
  justify-content: center; 
  -webkit-transition-duration: 0.7s; 
  transition-duration: 0.7s;
}
.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(25,0,0,0.26),0 17px 50px 0 rgba(25,0,0,0.22);
}
.button3:hover {
  -webkit-transition-duration: 0.7s; 
  transition-duration: 0.7s;
  box-shadow: 0 55px 75px 0 rgba(25,0,0,0.26),0 44px 75px 0 rgba(25,0,0,0.22);
}

.title{
  color: #87CEFA; 
  font-family: 'Trocchi', serif; 
  font-size: 80px; 
  font-weight: bold;
  margin-left: 400px;
}


  </style>

</head>

<body style = 'background-color: aliceblue;'>
<section class = 'mysection'>

<a href='cart.php'><img class = 'button3' style ='float: right; margin-top: 7px; margin-right: 10px' alt="cart" src="https://us.123rf.com/450wm/val2014/val20141603/val2014160300006/54302308-stock-vector-shopping-cart-icon.jpg?ver=6" width="85" height="85"></a>
<a href='account.php'><img class = 'button3' style ='float: right; margin-top: 7px; margin-right: 20px;' alt="cart" src="https://clipartart.com/images/account-profile-clipart-1.jpg" width="85" height="85"></a>
<h1 class = 'title'>The<span style="color:red; font-size:100px">M</span>andela<span style="color:red; font-size: 100px">E</span>ffect</h1>
<button class = 'button button2' onclick="Search()"> Search for item</button>

</section>
</body>
<section class = 'mysection2'>
<?php
//Storefront carbon copy that searches based on LIKE terms. Created so that the storefront wouldn't be broken by an empty query (if a search hasn't yet happened.) This is one of many workarounds, but, again, it works.
session_start();
require_once('login.php');
$conn = new mysqli($hn, $un, $pw, $db);

if(isset($_SESSION['username'])){
  echo "<h1 style='color: steelblue; font-size: 50px;font-style: oblique'>Welcome " . $_SESSION['username'] . " </h1>";
}
else{
  $_SESSION['type'] = 'guest';
  echo "<h1>Welcome Guest </h1>";
}

echo "<p style = 'font-family: Impact, Charcoal, sans-serif; font-size: 25px; color: navy;'>We currently have the following items:</p>";

$query = $_SESSION['query'];
$result = $conn->query($query);

if($result->num_rows){
  while($row = $result->fetch_array()){
  echo
  "<img id=" . $row['itemID'] . " src=" . $row['image_link'] . " alt=" . $row['item_name'] . " width=128 height=128 " . $row['itemID'] . ")></img>";
  echo "$" . $row['price'];
  echo
  "<button class = 'button button2' onclick='AddToCart(" . $row['itemID'] . ")' user= " . $_SESSION['type'] . " id=AddToCart> Add to cart </button>";
  echo
  "<button class = 'button button2' onclick='RemoveFromCart(" . $row['itemID'] . ")'> Remove from cart </button>";
  }
}
else{
  echo "All out of stock!";
}

?>
</section>
</html>