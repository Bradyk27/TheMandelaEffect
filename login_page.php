<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Log in to TheMandelaEffect</title>

  <style>
    input {
      margin-bottom: 0.5em;
    }
  </style>
</head>

<body>

  <?php
     session_start();
     require_once('login.php');
     $error1 = "";
     $error2 = "";
     $username = "EnterUsername";
     $password = "EnterPassword";
     if($_SESSION['type'] == 'user')
     {
      header("Location: user_page.php");
     }
     if($_SESSION['type'] == 'admin')
     {
      header("Location: admin_page.php");
     }

    
     $conn = new mysqli($hn, $un, $pw, $db);
     $salt1 = "qm&h*";
     $salt2 = "pg!@";

     if(isset($_POST['submit']))
     {
      $username = $_POST['username'];
      $_SESSION['username'] = $username;
      $password = $_POST['password'];
      $hash_password = hash('ripemd128', "$salt1$password$salt2");
      $query = "SELECT * FROM users WHERE username = '$username'";
      $result = $conn->query($query);
      if($result->num_rows)
      {
       $row = $result->fetch_array();       
       if($row['password'] == $hash_password)
       {
        if($row['type'] == 'admin')
        {
         $_SESSION['type'] = 'admin';
         header("Location: admin_page.php");
        }
        else if($row['type'] == 'user')
        {
         $_SESSION['type'] = 'user';
         header("Location: user_page.php");
        }
       }
       else
       {
        $error1 = "Username and Password Combination do not match";
       }
      }
      else
      {
       $error2 = "Username and Password Combination do not match";
      }

     }

  ?>

  <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
  TheMandelaEffect</span>!</h1>


  <p style='color: red'>
   <?php echo $error1;
   echo$error2;?>
  </p>

  <form method='post' action='login_page.php'>
    <label>Username: </label>
    <input type='text' name='username' value = "<?php echo $username?>"> <br>
    <label>Password: </label>
    <input type='password' name='password' value = "<?php echo $password?>"> <br>
    <input type='submit' name='submit' value='Log in'>
  </form>



  <p style="font-style:italic">
  <a href="account.php">Create Account Link</a>
  
  </p>

</body>

</html>
