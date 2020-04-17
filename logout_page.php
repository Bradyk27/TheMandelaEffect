<!DOCTYPE html>
<html lang="en">

<head>
<style>
.mysection2 {
   background-color: aliceblue;
   width: 100%;


} 
.mysection {
   background-color: navy;
   width: 100%;
   height: 85px;
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
  margin: 16px 10px;
  cursor: pointer;
  display: flex; 
  justify-content: center; 
  -webkit-transition-duration: 0.7s; /* Safari */
  transition-duration: 0.7s;
}
.title{
  color: #87CEFA; font-family: 'Trocchi', serif; font-size: 80px; font-weight: bold; letter-spacing: -1px; line-height: 1; text-align: center; 
}
.state{
  color: #000000; font-family: 'Trocchi', serif; font-size: 65px; font-weight: bold;text-align: center; font-style: italic; 
}

.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(25,0,0,0.26),0 17px 50px 0 rgba(25,0,0,0.22);
}
</style>
</head>

<body style = 'background-color: aliceblue;'>
  <!-- php to handle logging out -->
  <?php
  session_start();
  session_unset();
  session_destroy();
  ?>
<section class = 'mysection'>
  <h1 class = 'title'>The<span style="color:red; font-size:100px">M</span>andela<span style="color:red; font-size: 100px">E</span>ffect</h1>
</section>
<section class = 'mysection2'>

  <p class ='state'>
    You are now logged out, please visit our site again.
  </p>

  <p>
    <a href="login_page.php" class = 'button button2'>Log in</a>
    <a href="storefront.php" class = 'button button2'>Return to storefront</a>
  </p>
  </section>
</body>

</html>
