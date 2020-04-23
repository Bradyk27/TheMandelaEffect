<?php //Sets session for new carts
    session_start();
    $cart = $_POST['cart']; //USED TO BE REQUEST
    $_SESSION['cart'] = $cart;
?>