




$(document).ready(function() {
    var list = $('#food_list');
    var button_delete = $('#button_delete');

    $('#add').click(function(e) {
       

        if ($('#food_in').val()) {
                var list_row = $('<li>'+$('#food_in').val()+ '</li>');
                list_row.append('<input type="hidden" value="'+$('#food_in').val()+'" name="niz[]" /> ');

                var delete_row = $('<img src="http://localhost/fooddiary/public/img/delete-300x300.jpg"  style="width:20px;height:20px">');

                delete_row.click(function(e) {
                        e.preventDefault();
                        $(this).parent().remove();

                });

                list_row.append(delete_row);

                list.append(list_row);
                $('#food_in').val('');
        } else {
                alert('String prazan');
        } // else if
    });

    $(function() {
    $( "#datepicker" ).datepicker();
  });

   
});
    
