<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Mandela Effect</title>
  <meta name="DCSP Project">
  <meta name="Brady Kruse & Others">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>

<body>
  <script src="account.js"></script>
  <h1> Change Username / Change Password</h1>
  <?php 
  session_start();
  $user = $_SESSION['username'];

  if ($user)
  {
    if($_POST['submit'])
    {
      $oldpassword = $_POST['oldpassword'];
      $newpassword = $_POST['newpassword'];
      $salt1 = "qm&h*";
      $salt2 = "pg!@";
      $hasholdpassword = hash('ripemd128', "$salt1$oldpassword$salt2");
      $hashnewpassword = hash('ripemd128', "$salt1$newpassword$salt2");
      require_once('login.php');
      $conn = new mysqli($hn, $un, $pw, $db);
      $query = "SELECT * FROM users";
      $username = $_POST['username'];
      $_SESSION['username'] = $username;
      $result = $conn->query($query);
      if($result->num_rows)
      {
       $row = $result->fetch_array();       
       if($row['password'] == $hasholdpassword)
       {
        $querypass = "UPDATE users SET password='hashnewpassword' WHERE username='username'";
       }
       else{die("Not the correct old password");}
      }
      else{die("database connecting problem");}
      }
    else{
    echo"
    <form method='post' action='account.php'>
    <label>Old Password: </label>
    <input type='password' name='oldpassword' value = ''> <br>
    <label>New Password: </label>
    <input type='password' name='newpassword' value = ''> <br>
    <input type='submit' name='submit' value='Confirm Change Password'>
    </form>
    ";}
  }

  else {
    die("Log in to access this area");
  }?>
  <h1> Add/Delete Payment methods</h1>
  <?php 
  $user = $_SESSION['username'];

  if ($user)
  {
    if($_POST['addcard'])
    {

      }
    if($_POST['removecard']){
      
    }
    else{
    echo"
    <form>
    <input type='submit' name='addcard' value='Add New Payment Method'>
    <input type='submit' name='removecard' value='Remove Payment Method'>
    </form>
    ";}
  }

  else {
    die("Log in to access this area");
  }

  ?>
  <?php
  if($_SESSION['type'] == 'admin'){
    echo "<h1> Add/Delete Payment methods</h1>";
     
  $user = $_SESSION['username'];

  if ($user)
  {
    if($_POST['adduser'])
    {
      
      }
    if($_POST['removeuser']){
      
    }
    else{
    echo"
    <form>
    <input type='submit' name='adduser' value='Add New User'>
    <input type='submit' name='removeuser' value='Remove User'>
    </form>
    ";}
  }

  else {
    die("Log in to access this area");
  }}?>
</body>
<p style="font-style:italic">
<a href='logout_page.php'>Logout</a>
<a href='storefront.php'>Click here to return to storefront</a>
</html>
