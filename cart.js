cart = localStorage.getItem("cart"); //Create & post cart for guests if it does not yet exist.
if(cart == null){
    cart = [];
}
else{
    cart = cart.split(',');
}
$.post("cart_guest.php",
      {cart: cart.join(",")},
      function(result){
      });

//Add and remove from cart which logic-checking for guests (users get a unique database table, guests get cookied carts)
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