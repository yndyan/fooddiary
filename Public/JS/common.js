$(document).ready(function() {

    $(".confirm_delete").click(function(e){
        console.log('ola');
        if(!confirm("Confirm deleting?")){
             e.preventDefault();
        } //if
    });//confirm_delete").click

});//$(document).ready
