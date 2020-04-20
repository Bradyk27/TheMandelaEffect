$(document).ready(function(){ //Gotta make this run FIRST
  cart = localStorage.getItem("cart").split(',');
  if(cart==null){
      cart=[];
  }

  $.post("cart_guest.php",
      {cart: cart.join(",")},
      function(result){
        alert("Welcome, Guest! Create an account to save your cart!");
      });
});