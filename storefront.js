//STYLING: Display items better!
if(localStorage.getItem["cart"]==null){
    localStorage.setItem("cart", []);
}
cart = localStorage.getItem("cart").split(',');
if(cart[0] == ""){
    cart = []
}

function AddToCart(item_id){
    var user = document.getElementById("AddToCart").getAttribute("user");
    if(user=='guest'){
        cart.push(item_id.toString());
        localStorage.setItem("cart", cart);
        return;
    }
    $.post("edit_cart.php",
    {item: item_id,
     add_remove: "add"},
    function(result){
        alert(result);
    });
}

function RemoveFromCart(item_id){
    var user = document.getElementById("AddToCart").getAttribute("user");
    if(user=='guest'){
        cart.splice(cart.indexOf(item_id.toString()), 1);
        localStorage.setItem("cart", cart);
        return;
    }
    $.post("edit_cart.php",
    {item: item_id,
     add_remove: "remove"},
    function(result){
        alert(result);
    });
}