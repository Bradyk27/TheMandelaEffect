<!---
.______    __  ___ .______       __    __       _______. _______ 
|   _  \  |  |/  / |   _  \     |  |  |  |     /       ||   ____|
|  |_)  | |  '  /  |  |_)  |    |  |  |  |    |   (----`|  |__   
|   _  <  |    <   |      /     |  |  |  |     \   \    |   __|  
|  |_)  | |  .  \  |  |\  \----.|  `--'  | .----)   |   |  |____ 
|______/  |__|\__\ | _| `._____| \______/  |_______/    |_______|
                                                                --->
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
margin: 8px 4px;
cursor: pointer;
-webkit-transition-duration: 0.7s; /* Safari */
transition-duration: 0.7s;
}

.button2:hover {
box-shadow: 0 12px 16px 0 rgba(25,0,0,0.26),0 17px 50px 0 rgba(25,0,0,0.22);
}
.mysection2 {
background-color: aliceblue;
width: 100%;
}

td, th {
border: 1px solid;
text-align: center;
padding: 0.5em;
}
.mysection {
background-color: navy;
width: 100%;
height: 85px;
}
img {
border: 1px solid #ddd;
border-radius: 4px;
padding: 5px;
width: 150px;
display: block;
margin-left: auto;
margin-right: auto;
width: 50%;
}
.shop{color: red; 
font-family: 'Trocchi',serif; 
font-size: 36px; font-weight: 1000; 
line-height: 88px;
text-align: left; }
.title{color: #87CEFA; 
font-family: 'Trocchi', serif; 
font-size: 80px; 
font-weight: bold; 
letter-spacing: -1px; 
line-height: 1; 
text-align: center; }
</style>
</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="checkout_page.js"></script>

<h1 style="color: steelblue; font-size: 50px;font-style: oblique"> Checkout</h1>

<?php
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    session_start();

    if($_SESSION['type'] == 'user' || $_SESSION['type'] == 'admin'){ //Databased cart for user / admin with ability to check out
        $_SESSION['total'] = 0;
        $query = "SELECT * FROM " . $_SESSION['username'] . "";
        $result = $connection->query($query);
        if($result->num_rows){
            while($row = $result->fetch_array()){
                $_SESSION['total'] += $row['quantity'] * $row['price'];
            }
            echo "Total $:" . $_SESSION['total'];
            $error_card = "";
            $query = "SELECT * FROM payment_methods WHERE username='" . $_SESSION['username'] . "'";
            $result = $connection->query($query);
            if($result->num_rows){
                echo "<br>Here are your currently existing payment methods (click one to place order!)<br>";
                $i = 0;
                 while($row = $result->fetch_array()){
                    echo "<button id=" . $i . " onclick='PlaceOrder(" . $i . ")'>" . $row['cardno'] . "</button><br>";
                    $i++;
                } 
            }
            else{
                echo "<br>Visit the account page to add payment!";
            }
        }
        else{
            echo "Visit the storefront to create a cart!";
        }
    }

    elseif($_SESSION['type'] == 'guest'){ //Cookied cart for guests via Javascript with check out button
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            $total = 0;
            $cart = $_SESSION['cart'];
            $cart = explode(",", $cart);
            $cart_temp = array_count_values($cart);
            foreach(array_keys($cart_temp) as $index){
                $query = "SELECT * FROM items WHERE itemID=" . $index . "";
                $result = $connection->query($query);
                while($row = $result->fetch_array()){
                    $total += $row['price'] * $cart_temp[$index];
                }
            }
        echo "Total: $" . $total;
        echo "<button onclick='PlaceOrderGuest()'>Click to place order!</button><br>";
        }

        else{
            echo "Visit the storefront to create a cart!";
        }
    }

    else{
        echo "Visit the storefront to create a cart!"; //Guest types are set when they visit the storefront, so if they haven't done yet they will be kindly instructed to.
    }
?>
</body>
<a href='account.php' class = 'button button2'>Click here to view account</a>
<a href='storefront.php' class = 'button button2'>Click here to return to storefront</a>
</section>
</html>
