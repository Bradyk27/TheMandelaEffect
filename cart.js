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
        
      });
});

function AddToCart(item_id){
  var user = document.getElementById("AddToCart").getAttribute("user");
  if(user=='guest'){
      alert("Added to cart!");
      cart.push(item_id.toString());
      localStorage.setItem("cart", cart);
      location.reload();
      return;
  }
  $.post("edit_cart.php",
  {item: item_id,
   add_remove: "add"},
  function(result){
      alert(result);
      location.reload();
      return false;
  });
}

function RemoveFromCart(item_id){
  var user = document.getElementById("AddToCart").getAttribute("user");
  if(user=='guest'){
      alert("Removed from cart!");
      cart.splice(cart.indexOf(item_id.toString()), 1);
      localStorage.setItem("cart", cart);
      location.reload();
      return;
  }
  $.post("edit_cart.php",
  {item: item_id,
   add_remove: "remove"},
  function(result){
      alert(result);
      location.reload();
      return false;
  });
}