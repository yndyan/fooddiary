$(document).ready(function(){
    
    var div = '<div></div>';
    var anc = '<a></a>';
    var ul = '<ul></ul>';
    var li = '<li></li>';
    var button = '<button></button>';
    var span = '<span></span>';
    var input = '<input></input>';

//<div class="col-sm-10 col-md-offset-3"
//        <ul class="list-group list-inline">
//            <li class="list-group-item col-sm-4 ">Item 1</li>
//            <li class="list-group-item col-sm-2 col-md-offset-1 ">3000</li>
//            <button class="btn btn-danger col-md-offset-1">
//                    <span class="glyphicon glyphicon-remove"></span> 
//                    Delete
//            </button>
//         </ul>
//</div>    
    $("#add_grocery").click(function(e){
        
        e.preventDefault();
        //add protection from 
        groceryname = $("#groceryname").val();
        quantity    = $("#quantity").val();
        var hidden_groceryname =$(input).attr('type','hidden')
                                        .attr('name','groceries[]')
                                        .attr('value',groceryname);
            
        var hidden_quantity =   $(input).attr('type','hidden')
                                        .attr('name','quantity[]')
                                        .attr('value',quantity);
        
        var delete_button = $(button).addClass("btn btn-danger col-md-offset-1")
                                     .append($(span).addClass("glyphicon glyphicon-remove"))
                                     .append(' Delete');
            
        var u_list = ($(ul).addClass("list-group list-inline"));
            u_list.append($(li).addClass('list-group-item col-sm-4 ').text(groceryname));
            u_list.append($(li).addClass('list-group-item col-sm-2 col-md-offset-1 ').text(quantity));
            u_list.append(delete_button);
            u_list.append(hidden_groceryname);
            u_list.append(hidden_quantity);
            
        var main_div = $(div).addClass('col-sm-10 col-md-offset-3'); 
            main_div.append(u_list);    
        
        $('#grocery_list').append(main_div);
        $("#groceryname").val('');
        $("#quantity").val('');
        
        delete_button.click(function(e){
            e.preventDefault();
            $(this).parent().remove();
        });//delete_button.click
    });
    
    $("#groceryname").autocomplete({//add jq base_url
        source: "http://localhost/fooddiary/index.php/api_c/getAutocompleteGroceries",
        minLength: 2
        
    });
    
    
    //event trigered function that uses add_course_template
    
});//$(document).ready