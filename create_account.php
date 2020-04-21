<?php
//FEATURE: AUTOMATIC LOGIN
//FEATURE: ENTRY SANITATION, NO DUPLICATION USERS
echo "<h1 style='color: steelblue; font-size: 50px;font-style: oblique'> CREATE ACCOUNT </h1>";
require_once('login.php');
$conn = new mysqli($hn, $un, $pw, $db);
if(isset($_POST['add_user'])){
    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    $password = $_POST['password'];
    $hash_password = hash('ripemd128', "$salt1$password$salt2");

    $query = "INSERT INTO users(username, pw, type) VALUES('" . $_POST['username'] . "','" . $hash_password . "', 'user')";
    $result = $conn->query($query);
    $query = "CREATE TABLE " . $_POST['username'] . "(
        itemID     INTEGER,
        image_link    VARCHAR(1028),
        item_name   VARCHAR(256),
        quantity    INTEGER,
        PRIMARY KEY (itemID)
    )";
    $result = $conn->query($query);
    echo "<a href = login_page.php>Log in</a> to take effect!";
}

echo"
<br>
<form method='post' action='create_account.php'>
<label>Username: </label>
<input type='text' name='username' value = ''> <br>
<label>Password: </label>
<input type='password' name='password' value = ''> <br>
<input type='submit' name='add_user' value='Add User' class = 'button button2'>
</form>
";
  ?>