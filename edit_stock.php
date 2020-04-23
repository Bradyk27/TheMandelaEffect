<?php
    //Handles databasic of removing stock
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    switch($_POST['type']){
        case 'remove':
            $query = "DELETE FROM items WHERE itemID = '" . $_POST['item'] . "'";
            $result = $connection->query($query);
            echo "Item Deleted!";
        break;

        case 'update':
            $query = "UPDATE items SET quantity = " . $_POST['quantity'] . " WHERE itemID = " . $_POST['item'] . "";
            $result = $connection->query($query);
            echo "Quantity updated!";
        break;
    }
?>
