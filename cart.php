<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Mandela Effect</title>
  <meta name="DCSP Project">
  <meta name="Brady Kruse & Others">

  <link rel="stylesheet" href="css/styles.css?v=1.0">
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
.shop{color: red; font-family: 'Trocchi',serif; font-size: 36px; font-weight: 1000; line-height: 88px;text-align: left; }
.title{color: #87CEFA; font-family: 'Trocchi', serif; font-size: 80px; font-weight: bold; letter-spacing: -1px; line-height: 1; text-align: center; }
</style>
</head>

<body>
  <script src="cart.js"></script>
  <section class="mysection">
<h1 class = 'title'>Welcome to The<span style="color:red; font-size:100px">M</span>andela<span style="color:red; font-size: 100px">E</span>ffect</h1>
</section>
<section class="mysection2">
<h1 class = 'shop'>Shopping Cart</h1>
  <?php 
  session_start();
  $username = $_SESSION['username'];
    require_once('login.php');
    $conn = new mysqli($hn, $un, $pw, $db);
    $username = $_POST['username'];
    $_SESSION['username'] = $username;
    $query = "SELECT * FROM cart WHERE user = 'username'";
    $result = $conn->query($query);
    echo "Welcome back " .  $_SESSION['username'] . ", here's your cart items:";
    echo "
     <table>
     <tr>
     <th>Item ID</th><th>Item Name</th><th>quantity</th>
     </tr>
    ";
    
    /*while($row = $result->fetch_array()){
     echo "
      <tr>
      <td>" . $row['itemID'] . "</td>
      <td>" . $row['itemName'] . "</td>
      <td>" . $row['quantity'] . "</td>
      </tr>";}*/
     echo "</table>";
    echo"<input type='submit' name='submit' value='Checkout' class = 'button button2'>";
   echo"</form>";
?>
</body>
<a href='account.php' class = 'button button2'>Click here to view account</a>
<a href='storefront.php' class = 'button button2'>Click here to return to storefront</a>
</section>
</html>
