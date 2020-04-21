<?php
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    switch($_POST['type']){
        case 'payment':
            $query = "DELETE FROM payment_methods WHERE cardno = '" . $_POST['card'] . "'";
            $result = $connection->query($query);
        break;

        case 'order':
            $query = "DELETE FROM orders WHERE orderID = " . $_POST['order'] . "";
            $result = $connection->query($query);
        break;
        
        case 'delete_account':
            session_start();
            $query = "DELETE FROM users WHERE username = '" . $_SESSION['username'] . "'";
            echo $query;
            $result = $connection->query($query);
            $query = "DROP TABLE '" . $_SESSION['username'] . "'";
            $result = $connection->query($query);
            $query = "DELETE FROM payment_methods WHERE username = '" . $_SESSION['username'] . "'";
            $result = $connection->query($query);
            $query = "DELETE FROM orders WHERE username = '" . $_SESSION['username'] . "'";
            $result = $connection->query($query);
            session_unset();
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
            break;
        }
?>
