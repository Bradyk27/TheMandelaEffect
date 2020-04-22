<?php
    session_start();
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    switch($_POST['type']){
        case 'user':
            $query = "SELECT * FROM " . $_SESSION['username'];
            $result = $connection->query($query);
            while($row = $result->fetch_array()){
                $item_id = $row['itemID'];
                $quantity = $row['quantity'];

                $query_two = "SELECT price FROM items WHERE itemID = " . $item_id . "";
                $result_two = $connection->query($query);
                $row_two = $result_two->fetch_array();
                $total_price = $quantity * $row_two['price'];
                $query_three = "INSERT INTO orders(itemID, username, orderTotal, quantity, cardno, order_address) VALUES(" . $item_id . ",'" . $_SESSION['username'] . "'," . $total_price . "," . $quantity . "','" . $_POST['card'] . "','" . $_POST['order_address'] . "')";
                $result_three = $connection->query($query_three);
            }

            $query = "DELETE FROM " . $_SESSION['username'];
            $result = $connection->query($query);
        break;

        case 'guest':
            echo "getting here!";
            $total = 0;
            $cart = $_SESSION['cart'];
            $cart = explode(",", $cart);
            $cart_temp = array_count_values($cart);
            foreach(array_keys($cart_temp) as $index){
                $query = "SELECT price FROM items WHERE itemID=" . $index . "";
                $result = $connection->query($query);
                $row = $result->fetch_array();
                $total_price = $cart_temp[$index] * $row['price'];
                $query_two = "INSERT INTO orders(itemID, username, orderTotal, quantity, cardno, order_address) VALUES(" . $index . ",'GUEST'," . $total_price . "," . $cart_temp[$index] . ",'" . $_POST['card'] . "','" . $_POST['order_address'] . "')";
                echo $query_two;
                $result_two = $connection->query($query_two);
                
            }
            unset($_SESSION['cart']);
    }
?>