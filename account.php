<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Mandela Effect</title>
  <meta name="DCSP Project">
  <meta name="Brady Kruse & Others">


  <style>
      input {
      margin-bottom: 0.5em;
    }
    .mysection2 {
   background-color: aliceblue;
   width: 100%;


} 
.mysection {
   background-color: navy;
   width: 100%;
   height: 85px;
}
    .title{
  color: #87CEFA; font-family: 'Trocchi', serif; font-size: 80px; font-weight: bold; letter-spacing: -1px; line-height: 1; text-align: center; 
}
  .button {
  background-color: #87CEFA; /* Green */
  border: none;
  font-weight: bold;
  color: navy;
  padding: 12px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 8px 4px;
  cursor: pointer;
  -webkit-transition-duration: 0.7s; /* Safari */
  transition-duration: 0.7s;
}
.buttono {
  background-color: #87CEFA; /* Green */
  border: none;
  font-weight: bold;
  color: navy;
  padding: 12px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 16px 10px;
  cursor: pointer;
  display: flex; 
  justify-content: center; 
  -webkit-transition-duration: 0.7s; /* Safari */
  transition-duration: 0.7s;
}
.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(25,0,0,0.26),0 17px 50px 0 rgba(25,0,0,0.22);
}
input[type=password] {
  width: 19%;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  padding: 5px 0px 12px 0px;
}
  </style>


</head>

<body style="background-color:aliceblue;">
  <script src="account.js"></script>
  <section class = 'mysection'>
  <h1 class = 'title'>The<span style="color:red; font-size:100px">M</span>andela<span style="color:red; font-size: 100px">E</span>ffect</h1>
  </section>

  <h1 style="color: steelblue; font-size: 50px;font-style: oblique"> Change Username / Change Password</h1>
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
        $querypass = "UPDATE users SET password ='hashnewpassword' WHERE username ='username'";
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
    <input type='submit' name='submit' value='Confirm Change Password' class = 'button button2'>
    </form>
    ";}
  }

  else {
    die("Log in to access this area");
  }?>
  <h1 style="color: steelblue; font-size: 50px;font-style: oblique"> Add/Delete Payment methods</h1>
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
    <input type='submit' name='addcard' value='Add New Payment Method' class = 'button button2'>
    <input type='submit' name='removecard' value='Delete Payment Method' class = 'button button2'>
    </form>
    ";}
  }

  else {
    die("Log in to access this area");
  }

  ?>
  <?php
  if($_SESSION['type'] == 'admin'){
    echo "<h1 style='color: steelblue; font-size: 50px;font-style: oblique'> Add/Delete Users</h1>";
     
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
    <input type='submit' name='adduser' value='Add New User' class = 'button button2'>
    <input type='submit' name='removeuser' value='Remove User' class = 'button button2'>
    </form>
    ";}
  }

  else {
    die("Log in to access this area");
  }}?>
</body>
<p style="font-style:italic">
<a href='logout_page.php' class = 'buttono button2'>Logout</a>
<a href='storefront.php' class = 'buttono button2'>Click here to return to storefront</a>
</html>
