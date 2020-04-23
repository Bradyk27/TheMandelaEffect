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

                $query_two = "SELECT price FROM items WHERE itemID = " . $item_id . " AND quantity >= " . $quantity . "";
                $result_two = $connection->query($query_two);
                if (mysqli_num_rows($result_two)==0) {
                    echo "Not enough in stock! Please reduce quantity of itemID: " . $row['itemID'];
                    die();
                }
                $row_two = $result_two->fetch_array();
                $total_price = $quantity * $row_two['price'];

                $query_three = "INSERT INTO orders(itemID, username, orderTotal, quantity, cardno, order_address) VALUES(" . $item_id . ",'" . $_SESSION['username'] . "'," . $total_price . "," . $quantity . ",'" . $_POST['card'] . "','" . $_POST['order_address'] . "')";
                $result_three = $connection->query($query_three);
                $query_four = "UPDATE items SET quantity = quantity -  " . $quantity . " WHERE itemID = " . $item_id . "";
                $result_four = $connection->query($query_four);
            }

            $query = "DELETE FROM " . $_SESSION['username'];
            $result = $connection->query($query);
            echo "Order placed!";
        break;

        case 'guest':
            $total = 0;
            $cart = $_SESSION['cart'];
            $cart = explode(",", $cart);
            $cart_temp = array_count_values($cart);
            foreach(array_keys($cart_temp) as $index){
                $query = "SELECT price FROM items WHERE itemID=" . $index . " AND quantity >= " . $cart_temp[$index] . "";
                $result = $connection->query($query);
                if (mysqli_num_rows($result)==0) {
                    echo "Not enough in stock! Please reduce quantity of item: " . $index;
                    die();
                }
                $row = $result->fetch_array();
                $total_price = $cart_temp[$index] * $row['price'];
                $query_two = "INSERT INTO orders(itemID, username, orderTotal, quantity, cardno, order_address) VALUES(" . $index . ",'GUEST'," . $total_price . "," . $cart_temp[$index] . ",'" . $_POST['card'] . "','" . $_POST['order_address'] . "')";
                $result_two = $connection->query($query_two);
                $query_three = "UPDATE items SET quantity = quantity -  " . $cart_temp[$index]  . " WHERE itemID = " . $index . "";
                $result_three = $connection->query($query_three);
            }
            unset($_SESSION['cart']);
            echo "True";
        break;
    }
?>