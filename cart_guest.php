<?php
    session_start();
    $cart = $_REQUEST['cart'];
    $_SESSION['cart'] = $cart;
?>