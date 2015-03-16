$(document).ready(function(){
    
    var div = '<div></div>';
    var anc = '<a></a>';
    var ul = '<ul></ul>';
    var li = '<li></li>';
    var button = '<button></button>';
    var span = '<span></span>';
    var input = '<input></input>';
    var h5 = '<h5></h5>';
    
    var baseUrl =window.location.origin + "/" + window.location.pathname.split('/')[1];
    

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
    $("#add_grocery_to_course").click(function(e){
        
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
        //mydo if gorcery is not in grocery table, ask to add new grocery
        $('#grocery_list').append(main_div);
        $("#groceryname").val('');
        $("#quantity").val('');
        
        delete_button.click(function(e){
            e.preventDefault();
            $(this).parent().remove();
        });//delete_button.click
    });
    
    $("#groceryname").autocomplete({//add jq base_url
        source: baseUrl + "/index.php/api_c/getAutocompleteGroceries",
        minLength: 2
        
    });
    
    
    $("#add_course").click(function(e){
        e.preventDefault();
        addCorseUrl = baseUrl + '/index.php/api_c/addCourse';
        courseData = $("#add_course_form").serializeArray();
        
        $("#coursename_error").remove();
        $(".groceries_error").remove();

        $.post(addCorseUrl,courseData,function(e){
            if(e.success === false){
                
                $.each(e.errors,function(key,value){
                    if(key === 'coursename'){
                        var coursename_error = $(h5).attr('id','coursename_error').addClass("alert alert-warning");
                        $("#coursename").after(coursename_error.append(value));
                    } else if (key.indexOf('groceries')>=0){
                        position = key[key.length - 2];
                        //position = key.match(/\d+/);
                        var grocery_parent = $($("input[name='groceries[]']")[position]).parent();
                        var grocery_error = $(h5).addClass('groceries_error').addClass("alert alert-danger").addClass('col-sm-4 ');
                        grocery_parent.after(grocery_error.append(value));
                    }//else
                });//each
            } else if(e.success === true){
                //redirect to main page, add message 
            }//
        },'json');
    });//click
});//$(document).ready