$(document).ready(function(){
    
    var div = '<div></div>';
    var anc = '<a></a>';
    var ul = '<ul></ul>';
    var li = '<li></li>';
    var button = '<button></button>';
    var span = '<span></span>';
    var input = '<input></input>';
    var h5 = '<h5></h5>';
    var par = '<p></p>';
    var new_line = '</br>';
    var baseUrl =window.location.origin + "/" + window.location.pathname.split('/')[1];
/*    
                <div class="col-sm-10 col-md-offset-3">
                    <div class="grocery_data ">
                    
                        <div class="well well-sm col-sm-4 ">Item 1</div>
                        <div class="well well-sm col-sm-2 col-md-offset-1 ">3000</div>
                        
                        <button class="btn btn-danger col-md-offset-1">
                                <span class="glyphicon glyphicon-remove"></span> 
                                Delete
                        </button>
                    </div> 
                    </br>  
                    </br>  
                    
                    <div class="grocery_error">
                    
                        <div class="well well-sm col-sm-4 ">no such grocery</div>
                        
                        <button class="btn btn-success col-md-offset-2">
                                <span class="glyphicon glyphicon-plus"></span> 
                                Add
                        </button>
                        <button class="btn btn-danger col-md-offset-1">
                                <span class="glyphicon glyphicon-edit"></span> 
                                Edit
                        </button>
                    </div>    
                </div>
                    
*/  
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
        
        var delete_grocery = $(button).addClass("btn btn-danger col-md-offset-1")
                                     .append($(span).addClass("glyphicon glyphicon-remove"))
                                     .append(' Delete');
            
        var div_grocery_data = $(div).addClass('grocery_data');
            div_grocery_data.append($(div).addClass("well well-sm col-sm-4").text(groceryname));
            div_grocery_data.append($(div).addClass("well well-sm col-sm-2 col-md-offset-1").text(quantity))
            div_grocery_data.append(delete_grocery);
            div_grocery_data.append(hidden_groceryname);
            div_grocery_data.append(hidden_quantity);
            div_grocery_data.append(new_line); ;
            div_grocery_data.append(new_line); ;
        
        var grocery_div = $(div).addClass('grocery col-sm-10 col-md-offset-3'); 
            grocery_div.append(div_grocery_data);    
        
        $('#grocery_list').append(grocery_div);
        $("#groceryname").val('');
        $("#quantity").val('');
        
        delete_grocery.click(function(e){
            e.preventDefault();
            $(this).parents('.grocery').remove();
            
        });//delete_button.click
    });
    
    $("#groceryname").autocomplete({
        source: baseUrl + "/index.php/api_c/getAutocompleteGroceries",
        minLength: 2
    });
    
    $("#add_course").click(function(e){
        e.preventDefault();
        addCorseUrl = baseUrl + '/index.php/api_c/addCourse';
        courseData = $("#add_course_form").serializeArray();
        
        $("#coursename_error").remove();
        $(".groceries_error").remove();
        //mydo must have at least one grocery for submit
        $.post(addCorseUrl,courseData,function(e){
            if(e.success === false){
                
                $.each(e.errors,function(key,value){
                    
                    if(key === 'coursename'){
                        var coursename_error = $(div).attr('id','coursename_error').addClass("well well-sm alert alert-warning");//.attr('role','alert');
                        $("#coursename").after(coursename_error.append(value));
                    } else if (key.indexOf('groceries')>=0){
                        
                        position = key.match(/\d+/);
                        var dom_input = $($("input[name='groceries[]']")[position]);
                        
                        var dom_grocery_div = dom_input.parents('.grocery');
                        
                        var grocery_error = $(div).addClass("well well-sm alert alert-warning col-sm-4");
                        var add_grocery_button = $(button).addClass("btn btn-success col-md-offset-2")
                                     .append($(span).addClass("glyphicon glyphicon-plus"))
                                     .append(' Add');
                        var edit_grocery_button = $(button).addClass("btn btn-danger col-md-offset-1")
                                     .append($(span).addClass("glyphicon glyphicon-edit"))
                                     .append(' Edit');
                         var div_grocery_error = $(div).addClass('groceries_error');
                        div_grocery_error.append(grocery_error.append(value));
                        div_grocery_error.append(add_grocery_button);
                        div_grocery_error.append(edit_grocery_button);
                        dom_grocery_div.append(new_line); 
                        dom_grocery_div.append(div_grocery_error); 
                                                   
                        $(edit_grocery_button).click(function(e){
                            e.preventDefault();
                            $("#groceryname").val(dom_input.val());
                            $("#quantity").val($($("input[name='quantity[]']")[0]).val());
                            $(this).parents('.grocery').remove();
                            //mydo remove everything except grocery div, add input with autocomplete filled 
                            //value and ok button
                            
                        });//delete_button.click 
                        
                        $(add_grocery_button).click(function(e){
                            e.preventDefault();
                            addGroceryUrl = baseUrl + '/index.php/api_c/addGrocery';
                            groceryData = { 'new_grocery' : dom_input.val()};
                            $.post(addGroceryUrl,groceryData,function(e){
                                if(e.success === true){
                                    console.log($(this));
                                    $(add_grocery_button).parents('.groceries_error').remove();
                                    var grocery_msg = $(par).addClass("alert alert-danger col-sm-4");
                                    var sub_div = $(div).addClass('groceries_error');
                                    sub_div.append(grocery_msg.append('grocery successfully added'));
                                    dom_grocery_div.append(sub_div);    
                                } else if(e.success === false) {
                                    
                                }
                            },'json');
                            
                            
                            
                        });//delete_button.click 
                        
                        //mydo if gorcery is not in grocery table, append ADD and  EDIT  button
                    }//else
                });//each
            } else if(e.success === true){
                window.location.replace(baseUrl +'/index.php/courses_c/show_courses');
            }//
        },'json');
    });//click
});//$(document).ready