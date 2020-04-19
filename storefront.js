var cart = localStorage.getItem("cart").split(",");
if(cart==""){
    cart = []
}

function AddToCart(item_id){ //NEED BUTTONS FOR THIS! STYLING!
    cart.push(item_id);
    localStorage.setItem("cart", cart);
}

function RemoveFromCart(item_id){ //Would be useful to have a quantity amount for removing / adding
    cart.splice(cart.indexOf(item_id), 1);
    localStorage.setItem("cart", cart);
}
