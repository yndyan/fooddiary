$(document).ready(function() {
    var list = $('#food_list');
    var button_delete = $('#button_delete');
    
    
    $('#add').click(function(e) {
       

        if ($('#food_in').val()) {
                var list_row = $('<tr><td width="90%" >'+$('#food_in').val()+ '</td>');
                list_row.append('<input type="hidden" value="'+$('#food_in').val()+'" name="niz[]" /> ');

                var delete_row = $('<td  width="10%"> <span class="glyphicon glyphicon-remove"></span></td></tr>');

                delete_row.click(function(e) {
                        e.preventDefault();
                        $(this).parent().remove();

                });

                list_row.append(delete_row);

                list.append(list_row);
                $('#food_in').val('');
        } else {
                alert('Please enter data');
        } // else if
    });

    $( "#datepicker" ).datepicker();
    $( "#timepicker" ).timepicker();
    $( "#why" ).autocomplete({
      source: "http://localhost/fooddiary/index.php/reasons_c/getAutocompleteReasons",
      minLength: 2,
      select: function( event, ui ) {
        
        
            //ui.item.value:
          
      }
    });    
        
        
});
    
