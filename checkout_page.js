/*
.______    __  ___ .______       __    __       _______. _______ 
|   _  \  |  |/  / |   _  \     |  |  |  |     /       ||   ____|
|  |_)  | |  '  /  |  |_)  |    |  |  |  |    |   (----`|  |__   
|   _  <  |    <   |      /     |  |  |  |     \   \    |   __|  
|  |_)  | |  .  \  |  |\  \----.|  `--'  | .----)   |   |  |____ 
|______/  |__|\__\ | _| `._____| \______/  |_______/    |_______|
                                                                */
//Contains various button functions for placing orders
function PlaceOrder(buttonid){ //Places orders for users
    var cardno = document.getElementById(buttonid).innerHTML;
    var address = prompt("Enter your address");
    $.post("checkout_payment.php",
    {card: cardno,
     type: 'user',
     order_address: address},
    function(result){
        alert(result);
        location.reload();
        return false;
    });
}

function PlaceOrderGuest(){ //Places orders for guests who haven't any payment methods
    var cardno = prompt("Please enter your card #");
    var address = prompt("Enter your address");
    $.post("checkout_payment.php",
    {card: cardno,
     type: 'guest',
     order_address: address},
    function(result){
        if(result=="True"){
            alert("Order placed!");
            localStorage.clear();
            location.reload();
            return false;
        }
        else{
            alert(result);
            location.reload();
            return false;
        }
    });
}