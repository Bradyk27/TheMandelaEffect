<?php
//Massive switch statement that essentially just handles database manipulation for accounts
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    switch($_POST['type']){
        case 'payment':
            $query = "DELETE FROM payment_methods WHERE cardno = '" . $_POST['card'] . "'";
            $result = $connection->query($query);
            echo "Card Removed!";
        break;

        case 'order':
            $query = "DELETE FROM orders WHERE orderID = " . $_POST['order'] . "";
            $result = $connection->query($query);
            echo "Order Removed!";
        break;
        
        case 'delete_account':
            session_start();
            $query = "DELETE FROM users WHERE username = '" . $_SESSION['username'] . "'";
            $result = $connection->query($query);
            $query = "DROP TABLE '" . $_SESSION['username'] . "'";
            $result = $connection->query($query);
            $query = "DELETE FROM payment_methods WHERE username = '" . $_SESSION['username'] . "'";
            $result = $connection->query($query);
            $query = "DELETE FROM orders WHERE username = '" . $_SESSION['username'] . "'";
            $result = $connection->query($query);
            echo "Account Deleted!";
        break;

        case 'delete_account_admin':
            $query = "DELETE FROM users WHERE username = '" . $_POST['username'] . "'";
            $result = $connection->query($query);
            $query = "DROP TABLE '" . $_POST['username'] . "'";
            $result = $connection->query($query);
            $query = "DELETE FROM payment_methods WHERE username = '" . $_POST['username'] . "'";
            $result = $connection->query($query);
            $query = "DELETE FROM orders WHERE username = '" . $_POST['username'] . "'";
            $result = $connection->query($query);
            echo "Account Deleted!";
        break;
        
        case 'remove':
            $query = "DELETE FROM items WHERE itemID = '" . $_POST['item'] . "'";
            $result = $connection->query($query);
            echo "Item Deleted!";
        break;

        case 'update':
            $query = "UPDATE items SET quantity = " . $_POST['quantity'] . " WHERE itemID = " . $_POST['item'] . "";
            $result = $connection->query($query);
            echo "Quantity Updated!";
        break;
    }
?>
