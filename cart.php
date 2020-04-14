<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Mandela Effect</title>
  <meta name="DCSP Project">
  <meta name="Brady Kruse & Others">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>

<body>
  <script src="cart.js"></script>
  <h1> Cart Page</h1>
  <?php 
  session_start();
  $user = $_SESSION['username'];
  if ($user)
  {
    require_once('login.php');
    $conn = new mysqli($hn, $un, $pw, $db);
    $username = $_POST['username'];
    $_SESSION['username'] = $username;
    $query = "SELECT * FROM cart";
    $result = $conn->query($query);
    echo "Welcome back " .  $_SESSION['username'] . ", here's your cart items:";
    echo "
     <table>
     <tr>
     <th>itemID</th><th>itemName</th><th>quantity</th>
     </tr>
    ";
    
    while($row = $result->fetch_array()){
     echo "
      <tr>
      <td>" . $row['itemID'] . "</td>
      <td>" . $row['itemName'] . "</td>
      <td>" . $row['quantity'] . "</td>
      </tr>";
     }
     echo "</table>";
    if($_POST['submit'])
    {

    }
    else{
    echo"
    <input type='submit' name='submit' value='Checkout'>
    </form>
    ";}
  }

  else {
    die("Log in to access this area");
  }?>
</body>
<a href='account.php'>Click here to view account</a>
<a href='storefront.php'>Click here to return to storefront</a>
</html>
