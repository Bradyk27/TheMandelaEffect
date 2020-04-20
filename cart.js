//BUG: CART REQUIRES EXTRA REFRESH / EMPTY CART BREAKS
//FEATURE: ADD OR REMOVE FROM CART BUTTON ON CART PAGE
//STYLING: DISPLAY QUANTITY, ORGANIZE ITEMS

$(document).ready(function(){
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