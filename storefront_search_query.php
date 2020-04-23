<?php
//Handles query creation AFTER a term has been searched
session_start();
$search_term = $_POST['search'];
$query = "SELECT * FROM items WHERE item_name LIKE '%" . $search_term . "%' AND quantity > 0";
$_SESSION['query'] = $query;
?>