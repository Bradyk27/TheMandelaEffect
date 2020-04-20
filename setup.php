<?php
  require_once 'login.php';
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error)
    die($connection->connect_error);

// USERS
  $query = "DROP TABLE users";  
  $result = $connection->query($query);
  $query = "CREATE TABLE users (
    forename VARCHAR(32),
    surname  VARCHAR(32),
    type     VARCHAR(10),
    username VARCHAR(32),
    password VARCHAR(32),
    PRIMARY KEY(username)
  )";
  $result = $connection->query($query);
  if (!$result)
    die($connection->error);

  $salt1    = "qm&h*";
  $salt2    = "pg!@";

  $forename = 'Bill';
  $surname  = 'Smith';
  $type     = 'user';
  $username = 'bsmith';
  $password = 'mysecret';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $forename, $surname, $type, $username, $token);

  $forename = 'Pauline';
  $surname  = 'Jones';
  $type     = 'user';
  $username = 'pjones';
  $password = 'acrobat';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $forename, $surname, $type, $username, $token);

  $forename = 'Super';
  $surname  = 'User';
  $type     = 'admin';
  $username = 'admin';
  $password = 'admin';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $forename, $surname, $type, $username, $token);

  echo 'Test users created<br>';

  function add_user($connection, $fn, $sn, $ty, $un, $pw)
  {
    $query  = "INSERT INTO users (forename, surname, type, username, password)
      VALUES('$fn', '$sn', '$ty', '$un', '$pw')";

    $result = $connection->query($query);

    if (!$result)
      die($connection->error);
  }

  $connection->close();

  // USER END



  // ORDERS

  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error)
    die($connection->connect_error);

  $query = "DROP TABLE orders";
  $result = $connection->query($query);
  $query = "CREATE TABLE orders (
    orderID     VARCHAR(32),
    username    VARCHAR(32),
    orderTotal  VARCHAR(32),
    quantity    VARCHAR(10),
    shipping    VARCHAR(32)
  )";

  $result = $connection->query($query);

  if (!$result)
    die($connection->error);

  add_order($connection, "0001", "pjones", "$23.85", "4", "2-day shipping");
  add_order($connection, "0002", "pjones", "$13.99", "1", "standard shipping");
  add_order($connection, "0003", "bsmith", "$35.79", "3", "standard shipping");
  add_order($connection, "0004", "pjones", "$101.14", "11", "free shipping");
  add_order($connection, "0005", "bsmith", "$189.75", "8", "free shipping");
  add_order($connection, "0006", "pjones", "$24.89", "1", "1-day shipping");
  add_order($connection, "0007", "bsmith", "$60.92", "7", "free shipping");

  function add_order($connection, $oid, $un, $ot, $qty, $sp)
  {
    $query = "INSERT INTO orders (orderID, username, orderTotal, quantity, shipping)
      VALUES ('$oid', '$un', '$ot', '$qty', '$sp')";

    $result = $connection->query($query);

    if(!$result)
      die($connection->error);
  }

  echo 'Test orders created and populated<br>';

  // ORDERS END

  //Stock

  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error)
    die($connection->connect_error);

  $query = "DROP TABLE items";
  $result = $connection->query($query);
  $query = "CREATE TABLE items (
    itemID     VARCHAR(32),
    image_link    VARCHAR(1028),
    item_name   VARCHAR(256),
    quantity    INTEGER
  )";

  $result = $connection->query($query);

  if (!$result)
    die($connection->error);

  add_item($connection, "0001", "https://images-na.ssl-images-amazon.com/images/I/91s-zQ3T81L.jpg", "Berenstein Bears Book", 1);
  add_item($connection, "0002", "https://media1.s-nbcnews.com/i/newscms/2019_34/2977421/190819-think-chick-fil-a-popeyes-ew-524p_c2ab1236d77261ba150bba22caaf78b1.jpg", "Motherfucking Chick fil a sandwich", 1);

  function add_item($connection, $oid, $link, $name, $qty)
  {
    $query = "INSERT INTO items (itemID, image_link, item_name, quantity)
      VALUES ('$oid', '$link', '$name', '$qty')";

    $result = $connection->query($query);

    if(!$result)
      die($connection->error);
  }

  echo 'Test items created and populated<br>';

  // ORDERS END


  //Sample Cart

  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error)
    die($connection->connect_error);

  $query = "DROP TABLE bsmith";
  $result = $connection->query($query);
  $query = "CREATE TABLE bsmith (
    itemID     INTEGER,
    image_link    VARCHAR(1028),
    item_name   VARCHAR(256),
    quantity    INTEGER,
    PRIMARY KEY (itemID)
  )";

  $result = $connection->query($query);

  if (!$result)
    die($connection->error);

  $query = "INSERT INTO bsmith SELECT * FROM items WHERE itemID=1";
  $result = $connection->query($query);

  if(!$result)
    die($connection->error);

  echo 'Test cart created and populated<br>';


  $connection->close();
?>
