function PlaceOrder(buttonid){ //Removes payment method by posting to a edit_payment.php which handles server side
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

function PlaceOrderGuest(){
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