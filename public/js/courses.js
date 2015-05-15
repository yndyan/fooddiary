$(document).ready(function(){
    
    var div = '<div></div>';
    var anc = '<a></a>';
    var ul = '<ul></ul>';
    var li = '<li></li>';
    var button = '<button></button>';
    var span = '<span></span>';
    var input = '<input></input>';
    var label = '<label></label>';
    var h3 = '<h3></h3>';
    var h5 = '<h5></h5>';
    var par = '<p></p>';
    var new_line = '</br>';
    var baseUrl =window.location.origin + "/" + window.location.pathname.split('/')[1];
    
    $(".expand_course").click(function(e){
        e.preventDefault();
        var expand_button = $(this);
        console.log('expand button = '+ expand_button);
        var courses_list_item = $(expand_button).parents(".course");
        course_id = $(courses_list_item).attr('id').match(/\d+/)[0];
        json_course_id ={'course_id': course_id};
        getCourseUrl = baseUrl + '/index.php/api_c/getCourseData';
        $.post(getCourseUrl,json_course_id,function(e){
            if(e.success == true){
                console.log('success is true');
                
                buttons = expand_button.parent(".buttons");
                buttons.detach();
                console.log(buttons);
                var collapse_button =  $(button).addClass('collapse_course')
                                            .addClass('btn btn-info')
                                            .addClass('pull-right')
                                            .attr('type','submit')
                                            .append($(span).addClass('glyphicon glyphicon-collapse-up'))
                                            .append('collapse');
                
                
                var div_description_panel =   $(div).addClass('panel panel-default')
                                    .append($(div)  .addClass('panel-heading')
                                                    .append($(h3).addClass('panel-title')
                                                                 .text('Description')))
                                    .append($(div).addClass('panel-body')
                                                  .text(e.coursedescription));
                
                var div_groceryname_input =   $(div).addClass('col-sm-5')
                                            .append($(label).addClass('control-label')
                                                            .attr('for','groceryname')
                                                            .text('Grocery name: '))
                                            .append($(input).addClass('form-control ui-widget')
                                                            .attr('id','groceryname')
                                                            .attr('name','groceryname')
                                                            .attr('placeholder','Enter grocery name')
                                                            .attr('type','text'));
                                                    
                var div_quantity_input =   $(div).addClass('col-sm-3 col-md-offset-1')
                                            .append($(label).addClass('control-label')
                                                            .attr('for','quantity')
                                                            .text('Quantity: '))
                                            .append($(input).addClass('form-control ui-widget')
                                                            .attr('id','quantity')
                                                            .attr('name','quantity')
                                                            .attr('placeholder','Enter quantity')
                                                            .attr('type','text'));
                                                    
                var div_add_grocery_button =  $(div).addClass('col-sm-2')
                                                .append($(label).addClass('control-label')
                                                                .text('???: '))
                                                .append($(button).addClass('btn btn-success')
                                                                 .attr('type','submit')
                                                                 .attr('id','add_grocery_to_course')
                                                                 .append($(span).addClass('glyphicon glyphicon-plus'))
                                                                 .append(' Add grocery'));
                
                var div_grocery_input = $(div) .addClass('form-group ')
                                        .addClass('col-sm-12')
                                        .append(div_groceryname_input)
                                        .append(div_quantity_input)
                                        .append(div_add_grocery_button);
                                
                var div_groceries_list = $(div).addClass('groceries_list')
                                        .addClass('col-sm-12');   
                               
                if(e.groceries[0]['groceryname'] !== null){                
                    for (var i = 0, len = e.groceries.length; i < len; i++) {
                        div_groceries_list.append(add_grocery_template(e.groceries[i]))
                                   .append(new_line)
                                   .append(new_line);
                    }//for
                }//if
                
                
                var div_calories_buttons = $(div)   .addClass('col-sm-12')
                                                .append($(par).text('Calories'))
                                                .append($(div)  .addClass('well well-sm')
                                                                .addClass('col-sm-5')
                                                                .append(e.calories))
                                                .append(buttons);
                
                
                var div_expanded_grocery = $(div).addClass('expanded_grocery');
                
                
                
                div_expanded_grocery.append(collapse_button)  
                                    .append(new_line)
                                    .append(new_line)
                                    .append(new_line)
                                    .append(div_description_panel)
                                    .append(div_grocery_input)
                                    .append(new_line)
                                    .append(new_line)
                                    .append(new_line)
                                    .append(div_groceries_list)
                                    .append(div_calories_buttons);
                expand_button.detach();            
                courses_list_item.append(div_expanded_grocery);
                
                
                collapse_button.click(function(){
                    console.log('collase grocery');
                    buttons.detach();
                    buttons.append(expand_button);
                    div_expanded_grocery.remove();
                    courses_list_item.append(buttons);
                });//collapse_button.click
                
                $(".delete_grocery").click(delete_grocery);
                
                $("#groceryname").autocomplete({
                    source: baseUrl + "/index.php/api_c/getAutocompleteGroceries",
                    minLength: 2
                });
                
                $("#add_grocery_to_course").click(add_grocery_to_course);
                
                
            } else {
                console.log('success is false');
                //mydo error msg 
            }//else
        },'json');//post
    });//expand_course.click
    
    

var delete_grocery = function(e){    
console.log(e);    
e.preventDefault();
    if(confirm("Confirm deleting?")){
        deleteGroceryUrl = baseUrl + '/index.php/api_c/deleteGroceryFromCourse';//api delete from course
        
        var grocery_list_item_id = $(".delete_grocery").parent('.grocery_data').attr('id');
        course_grocery_id = { 'course_grocery_id' : grocery_list_item_id.match(/\d+/)[0]};
        $.post(deleteGroceryUrl,course_grocery_id,function(e){
            if(e.success === true){
                console.log('grocery deleted');
                $(".delete_grocery").parent("#"+grocery_list_item_id).remove();
            } else {
                console.log('error delete');
            }//else 
        },'json');//post
    }//if(confirm 
};

//    
var add_grocery_to_course = function(e){        
        e.preventDefault();
        //add protection from 
        var data = {};
        data.groceryname = $("#groceryname").val();
        data.quantity    = $("#quantity").val();
        data.course_id   = $(this).parents(".course").attr('id').match(/\d+/)[0];
        //console.log(data);
        checkGroceryExistUrl = baseUrl + '/index.php/api_c/checkGroceryExist';
        
        $.post(checkGroceryExistUrl,data,function(e){
            if(e.exist == true){
                
                addGroceryToCourseUrl = baseUrl + '/index.php/api_c/addGroceryToCourse';
                
                //add  to course database and return course_grocery_id
                $('.groceries_list').append(add_grocery_template(data))
                                    .append(new_line)
                                    .append(new_line);
                $("#groceryname").val('');
                $("#quantity").val('');
                $(".grocery_data").find(".delete_grocery").click(delete_grocery);//delete_button.click
            } else {
                if(confirm('No such grocery! \n Add grocery?')){
                    
                    
                    $.post(addGroceryUrl,data,function(e){
                        if(e.success === true){
                            
                            
                            //add  to course database and return course_grocery_id
                            $('.groceries_list').append(add_grocery_template(data))
                                    .append(new_line)
                                    .append(new_line);
                            $("#groceryname").val('');
                            $("#quantity").val('');

                            $(".grocery_data").find(".delete_grocery").click(function(e){
                                delete_grocery(e);
                            });//delete_button.click
                        } else {
                            console.log('error writing in database');
                        }
                    },'json');
                    
                } else {
                    console.log('cancel adding grocery');
                }
            }
        },'json');
    };// $("#add_grocery_to_course")

    
function addGroceryToCourseDatabase(data){
    
    addGroceryUrl = baseUrl + '/index.php/api_c/addGrocery';   
        
    }
    
    /*
    
    $("#add_grocery_to_course").click(function(e){
  
        e.preventDefault();
        groceryname = $("#groceryname").val();
        
       
        
        
        quantity    = $("#quantity").val();
        var hidden_groceryname =$(input).attr('type','hidden')
                                        .attr('name','groceries[]')
                                        .attr('value',groceryname);
            
        var hidden_quantity =   $(input).attr('type','hidden')
                                        .attr('name','quantity[]')
                                        .attr('value',quantity);
        
        var delete_grocery = $(button).addClass("delete_btn btn btn-danger col-md-offset-1")
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
    
   */ 
    
    
function add_grocery_template(e){
    var hidden_groceryname =$(input).attr('type','hidden')
                                    .attr('name','groceries[]')
                                    .attr('value',e.groceryname);

    var hidden_quantity =   $(input).attr('type','hidden')
                                    .attr('name','quantity[]')
                                    .attr('value',e.quantity);

    var button_delete_grocery = $(button).addClass("delete_grocery btn btn-danger col-md-offset-1")
                                 .append($(span).addClass("glyphicon glyphicon-remove"))
                                 .append(' Delete');

    var div_groceryname = $(div).addClass("well well-sm col-sm-5").text(e.groceryname);

    var div_quantity = $(div).addClass("well well-sm col-sm-3 col-md-offset-1").text(e.quantity);

    var div_grocery_data = $(div).addClass('grocery_data')
                                 .attr('id','course_grocery_id_'+e.course_grocery_id)
                        .append(div_groceryname)
                        .append(div_quantity)
                        .append(button_delete_grocery)
                        .append(hidden_groceryname)
                        .append(hidden_quantity);
    return    div_grocery_data;
}//add grocery
 
 

    
});//$(document).ready


