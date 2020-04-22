<h1 style="color: steelblue; font-size: 50px;font-style: oblique"> View Orders</h1>
 
  <?php 
  if(isset($_SESSION['username'])){ //Ability to add / remove payment info if signed in
    $query = "SELECT * FROM orders WHERE username='" . $_SESSION['username'] . "'";
    $result = $conn->query($query);
    if($result->num_rows){
      echo "Here are your currently existing orders (click to remove)<br>";
      while($row = $result->fetch_array()){
        echo "<button onclick='RemoveOrder(" . $row['orderID'] . ")'> Total Price: " . $row['orderTotal'] . "<br>Quantity: " . $row['quantity'] . "<br>Shipping: " . $row['shipping'] . "</button><br>";
      }
    }
    else{
      echo "You have no orders! <br><br>";
    }
 
    ;
  }
  else{
    echo "Log in to access this area";
  }
  ?>