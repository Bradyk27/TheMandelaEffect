function RemovePaymentMethod(buttonid){ //Removes payment method by posting to a edit_payment.php which handles server side
    var cardno = document.getElementById(buttonid).innerHTML;
    $.post("edit_payment.php",
    {card: cardno,
     type: 'payment'},
    function(result){
        alert(cardno + " Removed!");
        location.reload();
        return false;
    });
}

function RemoveOrder(orderID){
    $.post("edit_payment.php",
    {order: orderID,
     type: 'order'},
    function(result){
        alert("Order #" + orderID + " Removed!");
        location.reload();
        return false;
    });
}

function DeleteAccountUser(){
    if(confirm("Are you sure? This will cancel all existing orders")){
        $.post("edit_payment.php",
        {type: 'delete_account'},
        function(result){
            alert("Account Deleted!");
            location.reload();
            return false;
        });
    }
}

function DeleteAccountAdmin(buttonid){
    var user = document.getElementById(buttonid).innerHTML;
    if(confirm("Are you sure? This will cancel all existing orders")){
        $.post("edit_payment.php",
        {type: 'delete_account_admin',
        username: user},
        function(result){
            alert("Account Deleted!");
            location.reload();
            return false;
        });
    }
}