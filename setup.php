<?php
/*
.______    __  ___ .______       __    __       _______. _______ 
|   _  \  |  |/  / |   _  \     |  |  |  |     /       ||   ____|
|  |_)  | |  '  /  |  |_)  |    |  |  |  |    |   (----`|  |__   
|   _  <  |    <   |      /     |  |  |  |     \   \    |   __|  
|  |_)  | |  .  \  |  |\  \----.|  `--'  | .----)   |   |  |____ 
|______/  |__|\__\ | _| `._____| \______/  |_______/    |_______|
                                                                */
  //Initial setup for creation of test users and what not. Could certainly be cleaned up but eh, it works for testing purposes.
  require_once 'login.php';
  $connection = new mysqli($hn, $un, $pw, $db);

// USERS
  $query = "DROP TABLE users";  
  $result = $connection->query($query);
  $query = "CREATE TABLE users (
    forename VARCHAR(32),
    surname  VARCHAR(32),
    type     VARCHAR(10),
    username VARCHAR(32),
    pw VARCHAR(32),
    PRIMARY KEY(username)
  )";
  $result = $connection->query($query);

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
    $query  = "INSERT INTO users (forename, surname, type, username, pw)
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
    orderID     INT AUTO_INCREMENT,
    itemID      VARCHAR(32),
    username    VARCHAR(32),
    orderTotal  DECIMAL(4,2),
    quantity    VARCHAR(10),
    cardno      VARCHAR(32),
    order_address VARCHAR(256),
    PRIMARY KEY(orderID)
  )";

  $result = $connection->query($query);

  echo 'Test orders created and populated<br>';

  // ORDERS END

  //STOCK

  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error)
    die($connection->connect_error);

  $query = "DROP TABLE items";
  $result = $connection->query($query);
  $query = "CREATE TABLE items (
    itemID     INTEGER AUTO_INCREMENT,
    image_link    VARCHAR(1028),
    item_name   VARCHAR(256),
    quantity    INTEGER,
    price  DECIMAL(4,2),
    PRIMARY KEY(itemID)
  )";

  $result = $connection->query($query);

  if (!$result)
    die($connection->error);

  add_item($connection, "https://images-na.ssl-images-amazon.com/images/I/91s-zQ3T81L.jpg", "Berenstein Bears Book", 1, 10.00);
  add_item($connection, "https://media1.s-nbcnews.com/i/newscms/2019_34/2977421/190819-think-chick-fil-a-popeyes-ew-524p_c2ab1236d77261ba150bba22caaf78b1.jpg", "Motherfucking Chick fil a sandwich", 1, 25.25);

  function add_item($connection, $link, $name, $qty, $price)
  {
    $query = "INSERT INTO items (image_link, item_name, quantity, price)
      VALUES ('$link', '$name', '$qty' , '$price')";

    $result = $connection->query($query);

    if(!$result)
      die($connection->error);
  }

  echo 'Test items created and populated<br>';

  // STOCK END


  // CART

  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error)
    die($connection->connect_error);

  $query = "DROP TABLE bsmith";
  $result = $connection->query($query);
  $query = "CREATE TABLE bsmith (
    itemID     INTEGER,
    image_link    VARCHAR(1028),
    item_name   VARCHAR(256),
    quantity    INTEGER DEFAULT(1),
    price       DECIMAL(4,2),
    PRIMARY KEY (itemID)
  )";

  $result = $connection->query($query);

  $query = "INSERT INTO bsmith SELECT * FROM items WHERE itemID=1";
  $result = $connection->query($query);
  $query = "UPDATE bsmith SET quantity = 1 WHERE itemID = 1";
  $result = $connection->query($query);
  if(!$result)
    die($connection->error);

  echo 'Test cart created and populated<br>';

  // CART END

  // PAYMENT METHODS
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error)
    die($connection->connect_error);

  $query = "DROP TABLE payment_methods";
  $result = $connection->query($query);
  $query = "CREATE TABLE payment_methods (
    username     varchar(32),
    cardno    VARCHAR(256),
    PRIMARY KEY(cardno)
  )";
  $result = $connection->query($query);

  echo 'Payment_methods created and populated<br>';

  // PAYMENT METHODS END


  $connection->close();
?>
