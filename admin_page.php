<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TheMandelaEffect Administrator Page</title>
  <style>
  td, th {
  border: 1px solid;
  text-align: center;
  padding: 0.5em;
  }
  </style>
</head>

<body>
  <h1>TheMandelaEffect Administrator Page</h1>

  <!-- PHP to display admin information -->
  <?php
  session_start();
  if($_SESSION['type'] != 'admin')
  {
     echo "I'm sorry...you can't access this page\n";
     echo "<a href='login_page.php'>Click here to login</a>";
  }
  else{
     require_once('login.php');
     $conn = new mysqli($hn, $un, $pw, $db);
     $query = "SELECT * FROM orders";
     $result = $conn->query($query);
     echo "Welcome back " .  $_SESSION['username'] . ", here's your orders:";
     echo "
      <table>
      <tr>
	<th>orderID</th><th>username</th><th>orderTotal</th><th>quantity</th><th>shipping</th>
      </tr>
     ";
     
     while($row = $result->fetch_array()){
      echo "
       <tr>
	 <td>" . $row['orderID'] . "</td>
	 <td>" . $row['username'] . "</td>
	 <td>" . $row['orderTotal'] . "</td>
	 <td>" . $row['quantity'] . "</td>
	 <td>" . $row['shipping'] . "</td>
       </tr>";
      }
      echo "</table>";
      echo "<a href='logout_page.php'>Logout?</a>";     
  }
  ?>
</body>

</html>
