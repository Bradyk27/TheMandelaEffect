<?php
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    $query = "DELETE FROM payment_methods WHERE cardno = '" . $_POST['card'] . "'";
    $result = $connection->query($query);
?>
