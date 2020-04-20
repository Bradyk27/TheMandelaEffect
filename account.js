//TO DOS FOR ACCOUNT SCREEN
//STYLING: Make it look all pretty and stuff :))
//FEATURE: Entry sanitation!
//FEATURE: Alert on duplicate cards / nonexisting card
//FEATURE: DELETE / ADD ACCOUNT FOR ADMIN & USER
//BUG: ERROR MESSAGES NOT RESETTING EVERY TIME

function RemovePaymentMethod(buttonid){ //Removes payment method by posting to a edit_payment.php which handles server side
    var user = document.getElementById(buttonid).getAttribute("user");
    var cardno = document.getElementById(buttonid).innerHTML;
    $.post("edit_payment.php",
    {card: cardno},
    function(result){
        alert(result);
        alert(cardno + " Removed!");
        location.reload();
        return false;
    });
}