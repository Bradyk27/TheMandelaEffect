/*
.______    __  ___ .______       __    __       _______. _______ 
|   _  \  |  |/  / |   _  \     |  |  |  |     /       ||   ____|
|  |_)  | |  '  /  |  |_)  |    |  |  |  |    |   (----`|  |__   
|   _  <  |    <   |      /     |  |  |  |     \   \    |   __|  
|  |_)  | |  .  \  |  |\  \----.|  `--'  | .----)   |   |  |____ 
|______/  |__|\__\ | _| `._____| \______/  |_______/    |_______|
                                                                */
//Create cart if one does not yet exist
cart = localStorage.getItem("cart");
if(cart == null){
    cart = [];
}
else{
    cart = cart.split(',');
}

//A variety of button functions. These are so useful. 
function AddToCart(item_id){
    var user = document.getElementById("AddToCart").getAttribute("user");
    if(user=='guest'){
        cart.push(item_id.toString());
        localStorage.setItem("cart", cart);
        alert("Item added to cart!");
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
        alert("Item removed from cart!");
        return;
    }
    $.post("edit_cart.php",
    {item: item_id,
     add_remove: "remove"},
    function(result){
        alert(result);
    });
}

function Search(){
    var search_query = prompt("What would you like to search for?");
    $.post("storefront_search_query.php",
    {search: search_query},
    function(result){
        window.location.href = "storefront_search.php";
    });
}