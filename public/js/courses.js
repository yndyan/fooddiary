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
        var courses_list_item = $(expand_button).parents(".course");
        var json_course_id = { 'course_id' : $(courses_list_item).attr('id').match(/\d+/)[0]};
        getCourseUrl = baseUrl + '/index.php/api_c/getCourseData';
        
        $.post(getCourseUrl,json_course_id,function(result){
            if(result.success === true){
                var buttons = expand_button.parent(".buttons");
                expand_button.detach();
                buttons.detach();
                courses_list_item.append(expanded_grocery_template(result));
                if(result.groceries[0]['groceryname'] !== null){                
                    for (var i = 0, len = result.groceries.length; i < len; i++) {
                        courses_list_item.find(".groceries_list").append(add_grocery_template(result.groceries[i]))
                                   .append(new_line)
                                   .append(new_line);
                    }//for
                }//if
                
                courses_list_item.find(".calories").append(buttons);
                
                courses_list_item.find(".collapse_course").click(function(){
                    buttons .detach()
                            .append(expand_button);
                    courses_list_item.find(".expanded_grocery").remove();
                    courses_list_item.append(buttons);
                });//collapse_button.click
                
                $(".delete_grocery").click(function(e){ 
                    e.preventDefault();
                    var delete_button = $(this);
                    if(confirm("Confirm deleting?")){
                        var deleteGroceryUrl = baseUrl + '/index.php/api_c/deleteGroceryFromCourse';//api delete from course
                        var grocery_list_item = delete_button.parents('.grocery_data');
                        var course_grocery_id = { 'course_grocery_id' : grocery_list_item.attr('id').match(/\d+/)[0]};
                        $.post(deleteGroceryUrl,course_grocery_id,function(e){
                            if(e.success === true){
                                console.log('grocery deleted');
                                grocery_list_item.remove();
                                //mydo bug -- two new lines not deleted
                            } else {
                                console.log('error delete');
                            }//else 
                        },'json');//post deleteGroceryUrl
                    }//if(confirm 
                });//$(".delete_grocery").click
                
                $("#groceryname").autocomplete({//mydo problem whem more when one is expanded
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
    


    
var add_grocery_to_course = function(e){        
    e.preventDefault();
    var data = { 'groceryname' : $("#groceryname").val(),
                 'quantity'    : $("#quantity").val(),
                 'course_id'   : $(this).parents(".course").attr('id').match(/\d+/)[0]};
    
    
    checkGroceryExistUrl = baseUrl + '/index.php/api_c/checkGroceryExist';

    $.post(checkGroceryExistUrl,data,function(e){
        if(e.exist === true){
            addGroceryToCourseDatabase(data);
        } else {
            if(confirm('No such grocery! \n Add grocery?')){
                addGroceryUrl = baseUrl + '/index.php/api_c/addGrocery'; 
                $.post(addGroceryUrl,data,function(e){
                    if(e.success === true){
                    addGroceryToCourseDatabase(data);
                    } else {
                        console.log('error writing in database');
                    }//else if add grocery
                },'json');

            } else {
                console.log('cancel adding grocery');
            }//else if confirm add grocery
        }//else if exist
    },'json');//$.post(checkGroceryExistUrl
};// $("#add_grocery_to_course")

    
function addGroceryToCourseDatabase(data){
    addGroceryToCourseUrl = baseUrl + '/index.php/api_c/addGroceryToCourse';
    
    $.post(addGroceryToCourseUrl,data,function(result){
        if(result.success === true){
            data.course_grocery_id = result.course_grocery_id; 
            $('.groceries_list').append(add_grocery_template(data))
                                .append(new_line)
                                .append(new_line);
            $("#groceryname").val('');
            $("#quantity").val('');  
            $(".delete_grocery").click(function(e){ 
                e.preventDefault();
                var delete_button = $(this);
                if(confirm("Confirm deleting?")){
                    var deleteGroceryUrl = baseUrl + '/index.php/api_c/deleteGroceryFromCourse';//api delete from course
                    var grocery_list_item = delete_button.parents('.grocery_data');
                    var course_grocery_id = { 'course_grocery_id' : grocery_list_item.attr('id').match(/\d+/)[0]};
                    $.post(deleteGroceryUrl,course_grocery_id,function(e){
                        if(e.success === true){
                            console.log('grocery deleted');
                            grocery_list_item.remove();
                            //mydo bug -- two new lines not deleted
                        } else {
                            console.log('error delete');
                        }//else 
                    },'json');//post deleteGroceryUrl
                }//if(confirm 
            });//$(".delete_grocery").click   
        } else {
            console.log('database error adding grocery to course');
        }//else if addgrocery  
    },'json');//post
      
}//addGroceryToCourseDatabase
    
    
    
    
function add_grocery_template(data){
    
    
var grocery_template = 
 '<div id="course_grocery_id_' + data.course_grocery_id +' " class="grocery_data">'
+'  <div class="well well-sm col-sm-5">'+data.groceryname+'</div>'
+'  <div class="well well-sm col-sm-3 col-md-offset-1">'+data.quantity+'</div>'
+'  <button class="delete_grocery btn btn-danger col-md-offset-1">'
+'      <span class="glyphicon glyphicon-remove"></span>'
+'      Delete'
+'  </button>'
+'  <input type="hidden" name="groceries[]" value="'+data.groceryname+'">'
+'  <input type="hidden" name="quantity[]" value="'+data.quantity+'">'
 +'</div>';
 
return grocery_template ;
}//add grocery
 
function expanded_grocery_template(data){
var expanded_template = 
 '<div class="expanded_grocery">'
+'	<button class="collapse_course btn btn-info pull-right" type="submit"> '
+'		<span class="glyphicon glyphicon-collapse-up"></span>'
+'		collapse'
+'	</button>'

+'	<br>'
+'	<br>'
+'	<br>'

+'	<div class="panel panel-default">'
+'		<div class="panel-heading">'
+'			<h3 class="panel-title">Description</h3>'
+'		</div>'

+'		<div class="panel-body">'+data.coursedescription +'</div>'
+'	</div>'

+'		<div class="form-group col-sm-12">'
+'			<div class="col-sm-5">'
+'				<label class="control-label" for="groceryname">Grocery name: </label>'
+'				<input id="groceryname" class="form-control ui-widget ui-autocomplet-input" type="text" name="groceryname" placeholder="Enter grocery name" autocomplete="off">'
+'			</div>'

+'			<div class="col-sm-3 col-md-offset-1">'
+'				<label class="control-label" for="quantity">Quantity: </label>'
+'				<input id="quantity" class="form-control ui-widget" type="text" name="quantity" placeholder="Enter quantity">'
+'			</div>'

+'			<div class="col-sm-2">'
+'				<label class="control-label">???: </label>'
+'				<button id="add_grocery_to_course" class="btn btn-success" type="submit">'
+'				<span class="glyphicon glyphicon-plus"></span>'
+'				Add grocery'
+'				</button>'
+'			</div>'
+'		</div>'
+'	<br>'
+'	<br>'
+'	<br>'
+'		<div class="groceries_list col-sm-12"> 	</div>'
+'		<div class="calories col-sm-12">'
+'			<p>Calories</p>'
+'			<div class="well well-sm col-sm-5">'+data.calories+'</div>'
+'		</div>'
+'</div>';     

return expanded_template;
}//expanded_grocery_template 

    
});//$(document).ready


