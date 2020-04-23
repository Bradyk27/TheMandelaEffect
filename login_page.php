<!---
.______    __  ___ .______       __    __       _______. _______ 
|   _  \  |  |/  / |   _  \     |  |  |  |     /       ||   ____|
|  |_)  | |  '  /  |  |_)  |    |  |  |  |    |   (----`|  |__   
|   _  <  |    <   |      /     |  |  |  |     \   \    |   __|  
|  |_)  | |  .  \  |  |\  \----.|  `--'  | .----)   |   |  |____ 
|______/  |__|\__\ | _| `._____| \______/  |_______/    |_______|
                                                                --->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Log in to TheMandelaEffect</title>

  <style>
      input {
      margin-bottom: 0.5em;
    }
.mysection {
   background-color: navy;
   width: 100%;
   height: 85px;
}
.mysection2 {
   background-color: aliceblue;
   width: 100%;


}
  .button {
  background-color: #87CEFA;
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
  -webkit-transition-duration: 0.7s;
  transition-duration: 0.7s;
}

.title{
  color: #87CEFA; 
  font-family: 'Trocchi', serif; 
  font-size: 80px; 
  font-weight: bold; 
  letter-spacing: -1px; 
  line-height: 1; 
  text-align: center; 
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
input[type=text] {
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

<body style = 'background-color: aliceblue'>
<section class="mysection">
<h1 class = 'title'>Welcome to The<span style="color:red; font-size:100px">M</span>andela<span style="color:red; font-size: 100px">E</span>ffect</h1>
</section>
<section class="mysection2">

  <?php
    //Essentially just the same login page as was created for a lab
     session_start();
     require_once('login.php');
     $error1 = "";
     $error2 = "";

     $username = "EnterUsername";
     $password = "";

     if(isset($_SESSION['type']) && $_SESSION['type'] == 'user')
     {
      header("Location: account.php");
     }
     if(isset($_SESSION['type']) && $_SESSION['type'] == 'admin')
     {
      header("Location: account.php");
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
       if($row['pw'] == $hash_password)
       {
        if($row['type'] == 'admin')
        {
         $_SESSION['type'] = 'admin';
         header("Location: account.php");
        }
        else if($row['type'] == 'user')
        {
         $_SESSION['type'] = 'user';
         header("Location: account.php");
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

  <p style='color: red'>
   <?php echo $error1;
   echo$error2;?>
  </p>

  <form method='post' action='login_page.php'>
    <label>Username: </label>
    <input type='text' name='username' value = "<?php echo $username?>"> <br>
    <label>Password: </label>
    <input type='password' name='password' value = "<?php echo $password?>"> <br>
    <input type='submit' name='submit' value='Log in' class = 'button button2'>
  </form>

  <p style="font-style:italic">
  <a href="create_account.php" class = 'button button2'>Create Account</a>
  <a href="storefront.php" class = 'button button2'>Head to the storefront</a>
  </section>
  </p>
<section class="mysection2">
</section>
</body>

</html>
