<!---
.______    __  ___ .______       __    __       _______. _______ 
|   _  \  |  |/  / |   _  \     |  |  |  |     /       ||   ____|
|  |_)  | |  '  /  |  |_)  |    |  |  |  |    |   (----`|  |__   
|   _  <  |    <   |      /     |  |  |  |     \   \    |   __|  
|  |_)  | |  .  \  |  |\  \----.|  `--'  | .----)   |   |  |____ 
|______/  |__|\__\ | _| `._____| \______/  |_______/    |_______|
                                                                --->
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
    .mysection2 {
   background-color: aliceblue;
   width: 100%;


} 
.mysection {
   background-color: navy;
   width: 100%;
   height: 85px;
}
    .title{
  color: #87CEFA; 
  font-family: 'Trocchi', serif; 
  font-size: 80px; 
  font-weight: bold; 
  letter-spacing: -1px; 
  line-height: 1; 
  text-align: center; 
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
input[type=password] {
  width: 19%;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  padding: 5px 0px 12px 0px;
}
  </style>


</head>

<body style="background-color:aliceblue;">
  <script src="account.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <section class = 'mysection'>
  <h1 class = 'title'>The<span style="color:red; font-size:100px">M</span>andela<span style="color:red; font-size: 100px">E</span>ffect</h1>
  </section>

  <h1 style="color: steelblue; font-size: 50px;font-style: oblique"> Change Password</h1>
  <?php 
  session_start();
  require_once('login.php');
  $conn = new mysqli($hn, $un, $pw, $db);
  if(isset($_SESSION['username'])){ //Ability to update passwords if user is signed in
    $error_password = "";
    if(isset($_POST['submit_pass']))
    {
      $oldpassword = $_POST['oldpassword'];
      $newpassword = $_POST['newpassword'];
      $salt1 = "qm&h*";
      $salt2 = "pg!@";
      $hasholdpassword = hash('ripemd128', "$salt1$oldpassword$salt2");
      $hashnewpassword = hash('ripemd128', "$salt1$newpassword$salt2");

      $query = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";
      $result = $conn->query($query);
      $row = $result->fetch_array();       
      if($row['pw'] == $hasholdpassword)
      {
      $error_password = "Password successfully changed!";
      $query = "UPDATE users SET pw = '" . $hashnewpassword . "' WHERE (username = '" . $_SESSION['username'] . "' AND pw = '" . $hasholdpassword . "')";
      $result = $conn->query($query);
      }
      else
      {
      $error_password = "Password is incorrect";
      }
    }
    echo $error_password . "
    <form method='post' action='account.php'>
    <label>Old Password: </label>
    <input type='password' name='oldpassword' value = ''> <br>
    <label>New Password: </label>
    <input type='password' name='newpassword' value = ''> <br>
    <input type='submit' name='submit_pass' value='Confirm Change Password' class = 'button button2'>
    </form>
    ";
  }
  else {
    echo "Log in to access this area";
  }
  ?>

  <h1 style="color: steelblue; font-size: 50px;font-style: oblique"> Change Username</h1>
  <?php 
  if(isset($_SESSION['username'])){ //Ability to update username if user is signed in
    $error_username = "";
    if(isset($_POST['submit_user']))
    {
      $oldusername = $_POST['oldusername'];
      $newusername = $_POST['newusername'];

      $query = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";
      $result = $conn->query($query);
      if($result->num_rows)
      {
       $row = $result->fetch_array();       
       if($row['username'] == $oldusername)
       {
        $error_username = "Username successfully changed!";
        $query = "UPDATE users SET username = '" . $newusername . "' WHERE (username = '" . $_SESSION['username'] . "')";
        $result = $conn->query($query);

        $query = "ALTER TABLE " . $oldusername . " RENAME TO " . $newusername . "";
        $result = $conn->query($query);
        $_SESSION['username'] = $newusername;
       }
       else
       {
        $error_username = "Username is incorrect";
       }
      }
    }
    echo $error_username . "
    <form method='post' action='account.php'>
    <label>Old Username: </label>
    <input type='text' name='oldusername' value = ''> <br>
    <label>New Username: </label>
    <input type='text' name='newusername' value = ''> <br>
    <input type='submit' name='submit_user' value='Confirm Change Username' class = 'button button2'>
    </form>
    ";
  }
  else {
    echo "Log in to access this area";
  }
  ?>

  <h1 style="color: steelblue; font-size: 50px;font-style: oblique"> Add/Delete Payment methods</h1>
  <?php 
  if(isset($_SESSION['username'])){ //Ability to add / remove payment info if signed in
    $error_card = "";
    $query = "SELECT * FROM payment_methods WHERE username='" . $_SESSION['username'] . "'";
    $result = $conn->query($query);
    if($result->num_rows){
      echo "Here are your currently existing payment methods (click to remove)";
      $i = 0;
      while($row = $result->fetch_array()){
        echo "<button id=" . $i . " onclick='RemovePaymentMethod(" . $i . ")' user= '" . $_SESSION['username'] . "'>" . $row['cardno'] . "</button>";
        $i++;
      }
    }

    if(isset($_POST['addcard'])){
      $query = "INSERT INTO payment_methods VALUES ('" . $_SESSION['username'] . "' ,  '" . $_POST['card'] . "') ON DUPLICATE KEY UPDATE cardno=cardno";
      $result = $conn->query($query);
      header("Refresh:0");
    }
 
    echo $error_card . "
    <form method='post' action='account.php'>
    <label>Card #: </label>
    <input type='text' name='card' value = ''> <br>
    <input type='submit' name='addcard' value='Add Card' class = 'button button2'>
    </form>
    ";
  }
  else{
    echo "Log in to access this area";
  }
  ?>

  <h1 style="color: steelblue; font-size: 50px;font-style: oblique"> View Orders</h1>
  <?php 
  if(isset($_SESSION['username'])){ //Ability to add / remove payment info if signed in
    $query = "SELECT * FROM orders WHERE username='" . $_SESSION['username'] . "'";
    $result = $conn->query($query);
    if($result->num_rows){
      echo "Here are your currently existing orders (click to remove)<br>";
      while($row = $result->fetch_array()){
        echo "<button onclick='RemoveOrder(" . $row['orderID'] . ")'> Total Price: " . $row['orderTotal'] . "<br>Quantity: " . $row['quantity'] . "<br></button><br>";
      }
    }
    else{
      echo "You have no orders! <br><br>";
    }
  }
  else{
    echo "Log in to access this area";
  }
  ?>


  <?php
  if(isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){ //Ability to add / delete users AND update stock for admins only
    echo "<h1 style='color: steelblue; font-size: 50px;font-style: oblique'> Add/Delete Users</h1>";
    $query = "SELECT * FROM users";
    $result = $conn->query($query);
    if($result->num_rows){
      echo "Here are your currently existing users (click to remove)<br>";
      $i = 0;
      while($row = $result->fetch_array()){
        echo "<button id = " . $i . " onclick='DeleteAccountAdmin(" . $i . ")'>" . $row['username'] . "</button><br>";
        $i++;
      }
    }
    else{
      echo "You have no users! <br><br>";
    }
  
    if(isset($_POST['add_user'])){
      $salt1 = "qm&h*";
      $salt2 = "pg!@";
      $password = $_POST['password_admin'];
      $hash_password = hash('ripemd128', "$salt1$password$salt2");

      $query = "INSERT INTO users(username, pw, type) VALUES('" . $_POST['username_admin'] . "','" . $hash_password . "','" . $_POST['type_admin'] . "')";
      $result = $conn->query($query);
      $query = "CREATE TABLE " . $_POST['username_admin'] . "(
        itemID     INTEGER,
        image_link    VARCHAR(1028),
        item_name   VARCHAR(256),
        quantity    INTEGER,
        PRIMARY KEY (itemID)
      )";
      $result = $conn->query($query);
      unset($_POST['add_user']);
    }
  
    echo"
    <br>
    <form method='post' action='account.php'>
    <label>Username: </label>
    <input type='text' name='username_admin' value = ''> <br>
    <label>Password: </label>
    <input type='password' name='password_admin' value = ''> <br>
    <label>User Type (user / admin): </label>
    <input type='text' name='type_admin' value = ''> <br>
    <input type='submit' name='add_user' value='Add User' class = 'button button2'>
    </form>
    ";

    echo "<h1 style='color: steelblue; font-size: 50px;font-style: oblique'> Edit Stock </h1>";
    $query = "SELECT * FROM items";
    $result = $conn->query($query);
    if($result->num_rows){
      echo "Here is your currently existing stock<br>";
      $i = 0;
      while($row = $result->fetch_array()){
        echo "ItemID: " . $row['itemID'] . " Item Name: " . $row['item_name'] . " Quantity: " . $row['quantity'] . " Price: " . $row['price'] . "<br>";
        echo "<button id = Delete" . $i . " onclick='DeleteStock(" . $i . ")' item_id = " . $row['itemID'] . ">Remove Item</button><br>";
        echo "<button id = Change" . $i . " onclick='ChangeStock(" . $i . ")' item_id = " . $row['itemID'] . ">Update Quantity</button><br>";
        $i++;
      }
    }
    else{
      echo "You have no stock! <br><br>";
    }
  
    if(isset($_POST['add_stock'])){
      $query = "INSERT INTO items(image_link, item_name, quantity, price) VALUES('" . $_POST['image_url'] . "','" . $_POST['item_name'] . "','" . $_POST['quantity'] . "','" . $_POST['price'] . "')";
      $result = $conn->query($query);
      unset($_POST['add_stock']);
    }
  
    echo"
    <br>
    <form method='post' action='account.php'>
    <label>Item Name: </label>
    <input type='text' name='item_name'> <br>
    <label>Quantity: </label>
    <input type='number' min='0' name='quantity'> <br>
    <label>Price: : </label>
    <input type='number' name='price' min='0' step='0.01'> <br>
    <label>Item Image URL: </label>
    <input type='text' name='image_url'> <br>
    <input type='submit' name='add_stock' value='Add Item' class = 'button button2'>
    </form>
    ";
  }
  ?>

  </body>
  <p style="font-style:italic">
<?php //Logout / Login for guests or nonusers
if(isset($_SESSION['username'])){
  echo "<a href='logout_page.php' class = 'buttono button2'>Logout</a>";
}
else{
  echo "<a href='login_page.php' class = 'buttono button2'>Login</a>";
}
?>

<a href='storefront.php' class = 'buttono button2'>Click here to return to storefront</a>
</html>
