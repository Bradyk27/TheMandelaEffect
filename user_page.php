<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Page</title>
  <style>
  td, th {
  border: 1px solid;
  text-align: center;
  padding: 0.5em;
  }
  </style>
</head>

<body>
  <h1>User Page</h1>

  <!-- build information for the user page -->
  <?php
  session_start();
  if($_SESSION['type'] != 'user')
  {
     echo "I'm sorry...you can't access this page\n";
     echo "<a href='http://pluto.cse.msstate.edu/~bak225/Lab5/login_page.php'>Click here to login</a>";
  }
  else{
     $username = $_SESSION['username'];
     require_once('login.php');
     $conn = new mysqli($hn, $un, $pw, $db);
     $query = "SELECT * FROM users WHERE username='$username'";
     $result = $conn->query($query);
     echo "Welcome back " .  $_SESSION['username'] . ", here's your orders:";
     echo "                                                                                                                                                                         
      <table>
      <tr>                                                                                                                                                                         
        <th>orderID</th><th>orderTotal</th><th>quantity</th><th>shipping</th>                                                                                       
      </tr>                                                                                                                                                                         
     ";
     while($row = $result->fetch_array()){
      echo "                                                                                                                                                                        
       <tr>                                                                                                                                                                         
         <td>" . $row['orderID'] . "</td>                                                                                                                          
         <td>" . $row['orderTotal'] . "</td>                                                                                                                                                 <td>" . $row['quantity'] . "</td>                                                                                                                                          
         <td>" . $row['shipping'] . "</td>                                                                                                                                          
       </tr>";
      }
      echo "</table>";
      echo "<a href='logout_page.php'>Logout?</a>";
  }
  ?>

</body>

</html>
