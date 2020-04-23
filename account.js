/*
.______    __  ___ .______       __    __       _______. _______ 
|   _  \  |  |/  / |   _  \     |  |  |  |     /       ||   ____|
|  |_)  | |  '  /  |  |_)  |    |  |  |  |    |   (----`|  |__   
|   _  <  |    <   |      /     |  |  |  |     \   \    |   __|  
|  |_)  | |  .  \  |  |\  \----.|  `--'  | .----)   |   |  |____ 
|______/  |__|\__\ | _| `._____| \______/  |_______/    |_______|
                                                                */
//All buttons here post the edit_payment.php page, then alert appropriate results
function RemovePaymentMethod(buttonid){
    var cardno = document.getElementById(buttonid).innerHTML;
    $.post("edit_account.php",
    {card: cardno,
     type: 'payment'},
    function(result){
        alert(result);
        location.reload();
        return false;
    });
}

function RemoveOrder(orderID){ 
    $.post("edit_account.php",
    {order: orderID,
     type: 'order'},
    function(result){
        alert(result);
        location.reload();
        return false;
    });
}

function DeleteAccountUser(){
    if(confirm("Are you sure? This will cancel all existing orders")){
        $.post("edit_account.php",
        {type: 'delete_account'},
        function(result){
            alert(result);
            location.reload();
            return false;
        });
    }
}

function DeleteAccountAdmin(buttonid){
    var user = document.getElementById(buttonid).innerHTML;
    if(confirm("Are you sure? This will cancel all existing orders")){
        $.post("edit_account.php",
        {type: 'delete_account_admin',
        username: user},
        function(result){
            alert(result);
            location.reload();
            return false;
        });
    }
}

function DeleteStock(buttonid){
    var item_id = document.getElementById("Delete" + buttonid).getAttribute("item_id");
    if(confirm("Are you sure you wish to delete this item?")){
        $.post("edit_account.php",
        {item: item_id,
         type: 'remove'},
        function(result){
            alert(result);
            location.reload();
            return false;
    });
    }
}

function ChangeStock(buttonid){
    var item_id = document.getElementById("Delete" + buttonid).getAttribute("item_id");
    var new_quantity = prompt("Enter new item quantity");
    while(isNaN(new_quantity)){
        var new_quantity = prompt("Enter numeric item quantity");
    }
    $.post("edit_account.php",
    {item: item_id,
    type: 'update',
    quantity: new_quantity},
    function(result){
        alert(result);
        location.reload();
        return false;
    });
}