<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Mandela Effect</title>
  <meta name="DCSP Project">
  <meta name="Brady Kruse & Others">

  <style>
        input {
      margin-bottom: 0.5em;
    }
.mysection {
   background-color: navy;
   width: 100%;
   height: 85px;
}
.button {
  background-color: #87CEFA; /* Green */
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
  -webkit-transition-duration: 0.7s; /* Safari */
  transition-duration: 0.7s;
}

.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(25,0,0,0.26),0 17px 50px 0 rgba(25,0,0,0.22);
}
.mysection2 {
   background-color: aliceblue;
   width: 100%;
}

td, th {
  border: 1px solid;
  text-align: center;
  padding: 0.5em;
  }
  .mysection {
   background-color: navy;
   width: 100%;
   height: 85px;
 }
 img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
.shop{color: red; 
font-family: 'Trocchi',serif; 
font-size: 36px; font-weight: 1000; 
line-height: 88px;
text-align: left; }
.title{color: #87CEFA; 
font-family: 'Trocchi', serif; 
font-size: 80px; 
font-weight: bold; 
letter-spacing: -1px; 
line-height: 1; 
text-align: center; }
</style>
</head>

<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="cart.js"></script>
  <section class="mysection">
<h1 class = 'title'>Welcome to The<span style="color:red; font-size:100px">M</span>andela<span style="color:red; font-size: 100px">E</span>ffect</h1>
</section>
<section class="mysection2">
<h1 class = 'shop'>Shopping Cart</h1>
  <?php
  require_once 'login.php';
  $connection = new mysqli($hn, $un, $pw, $db);
  session_start();

  if($_SESSION['type'] == 'user' || $_SESSION['type'] == 'admin'){ //Databased cart for user / admin
    $total = 0;
    echo "<p style = 'font-family: Impact, Charcoal, sans-serif; font-size: 25px; color: navy;'>Welcome back " . $_SESSION['username'] . "</p>";
    echo "<br><p style = 'font-family: Impact, Charcoal, sans-serif; font-size: 25px; color: navy;'>Here's your orders: </p>";
    $query = "SELECT * FROM " . $_SESSION['username'] . "";
    $result = $connection->query($query);
    if($result->num_rows){
      while($row = $result->fetch_array()){
        echo
        "<img id=" . $row['itemID'] . " src=" . $row['image_link'] . " alt=" . $row['item_name'] . " width=128 height=128)></img>";
        echo "Quantity: " . $row['quantity'];
        echo "<br>Price: " . $row['price']; $total += $row['quantity'] * $row['price'];
        echo
        "<button class = 'button button2' onclick='AddToCart(" . $row['itemID'] . ")' user= " . $_SESSION['type'] . " id=AddToCart> Add to cart </button>";
        echo
        "<button class = 'button button2' onclick='RemoveFromCart(" . $row['itemID'] . ")'> Remove from cart </button>";
      }
      echo "Total: $" . $total;
      echo "<a href='checkout_page.php' class = 'button button2'>Click here to checkout</a>";
    }
    else{
      echo "Visit the storefront to create a cart!";
    }
  }

  elseif($_SESSION['type'] == 'guest'){ //Cookied cart for guests via Javascript
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
      $total = 0;
      $cart = $_SESSION['cart'];
      $cart = explode(",", $cart);
      $cart_temp = array_count_values($cart);
      foreach(array_keys($cart_temp) as $index){
        $query = "SELECT * FROM items WHERE itemID=" . $index . "";
        $result = $connection->query($query);
        while($row = $result->fetch_array()){
          echo
          "<img id=" . $row['itemID'] . " src=" . $row['image_link'] . " alt=" . $row['item_name'] . " width=128 height=128)></img>"; 
          echo "Quantity: " . $cart_temp[$index];
          echo "<br>Price: " . $row['price']; $total += $cart_temp[$index] * $row['price'];
          echo
          "<button class = 'button button2' onclick='AddToCart(" . $row['itemID'] . ")' user= " . $_SESSION['type'] . " id=AddToCart> Add to cart </button>";
          echo
          "<button class = 'button button2' onclick='RemoveFromCart(" . $row['itemID'] . ")'> Remove from cart </button>";
        }
      }
      echo "Total: $" . $total;
      echo "<a href='checkout_page.php' class = 'button button2'>Click here to checkout</a>";
    }
    else{
      echo "Visit the storefront to create a cart!";
    }
  }

  else{
    echo "Visit the storefront to create a cart!"; //Guest types are set when they visit the storefront, so if they haven't done yet they will be kindly instructed to.
  }
?>

</body>
<a href='account.php' class = 'button button2'>Click here to view account</a>
<a href='storefront.php' class = 'button button2'>Click here to return to storefront</a>
</section>
</html>
