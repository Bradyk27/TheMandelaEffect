<?php
  session_start();
  require_once 'login.php';
  $connection = new mysqli($hn, $un, $pw, $db);
  switch($_REQUEST['add_remove']){
    case "add":
      echo "Item added to cart!";
      add($connection);
      break;
    
    case "remove":
      echo "Item removed from cart!";
      remove($connection);
      break;
  }
  

  function add($connection){
    $query = "INSERT INTO " . $_SESSION['username'] . " SELECT * FROM items WHERE itemID=" . $_REQUEST['item'] . " ON DUPLICATE KEY UPDATE " . $_SESSION['username'] . ".quantity=" . $_SESSION['username'] . ".quantity+1";
    $result = $connection->query($query);
  }

  function remove($connection){
    $query = "UPDATE " . $_SESSION['username'] . " SET quantity = quantity - 1 WHERE itemID = " . $_REQUEST['item'] . " AND quantity > 0";
    $result = $connection->query($query);
    $query = "DELETE FROM " . $_SESSION['username'] . " WHERE quantity = 0";
    $result = $connection->query($query);
  }
?>
