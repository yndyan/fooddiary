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
var baseUrl =window.location.origin + "/" + window.location.pathname.split('/')[1];

$("#add_grocery_to_course").click(function(e){

    e.preventDefault();
    var data = {};
    data.groceryname = $("#groceryname").val();
    data.quantity    = $("#quantity").val();
    checkGroceryExistUrl = baseUrl + '/index.php/api_c/checkGroceryExist';

    $.post(checkGroceryExistUrl,data,function(e){
        if(e.exist === true){
            $('#grocery_list').append(add_grocery_template(data));
            $("#groceryname").val('');
            $("#quantity").val('');
            $(".grocery_data").find(".delete_grocery").click(function(e){
                e.preventDefault();
                $(this).parents('.grocery_data').remove();
            });//delete_button.click
        } else {
            if(confirm('No such grocery! \n Add grocery?')){
                addGroceryUrl = baseUrl + '/index.php/api_c/addGrocery';

                $.post(addGroceryUrl,data,function(e){
                    if(e.success === true){
                        $('#grocery_list').append(add_grocery_template(data));
                        $("#groceryname").val('');
                        $("#quantity").val('');

                        $(".grocery_data").find(".delete_grocery").click(function(e){
                            e.preventDefault();
                            $(this).parents('.grocery_data').remove();
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
});// $("#add_grocery_to_course")
    
//----------------------------------------------------------------------------------    
    
$("#groceryname").autocomplete({
    source: baseUrl + "/index.php/api_c/getAutocompleteGroceries",
    minLength: 2
});
    
//----------------------------------------------------------------------------------    
    
$("#add_course").click(function(e){
    e.preventDefault();
    addCorseUrl = baseUrl + '/index.php/api_c/addCourse';
    courseData = $("#add_course_form").serializeArray();

    $("#coursename_error").remove();
    $("#calories_error").remove();
    $(".groceries_error").remove();
    
    $.post(addCorseUrl,courseData,function(e){
        if(e.success === false){

            $.each(e.errors,function(key,value){

                if(key === 'coursename'){
                    var coursename_error = $(div).attr('id','coursename_error').addClass("well well-sm alert alert-warning");//.attr('role','alert');
                    $("#coursename").after(coursename_error.append(value));
                } else if (key.indexOf('groceries')>=0){
                    position = key.match(/\d+/);
                    var dom_input = $($("input[name='groceries[]']")[position]);
                    var dom_grocery_div = dom_input.parents('.grocery_data');
                    var grocery_error = '<div class="groceries_error col-sm-5 col-sm-offset-2">'
                                      + '    <div class="well well-sm alert alert-warning">'+value+'</div>'
                                      + '</div>';
                    dom_grocery_div.append(grocery_error); 
                } else if (key === 'calories'){
                    var coursename_error = $(div).attr('id','calories_error').addClass("well well-sm alert alert-warning");//.attr('role','alert');
                    $("#calories").after(coursename_error.append(value));
                }
            });//each
        } else if(e.success === true){
            window.location.replace(baseUrl +'/index.php/courses_c/show_courses');
        }//
    },'json');
});//#add_course.click
//----------------------------------------------------------------------------------    
    $(".delete_btn").click(function(e){
            e.preventDefault();
            $(this).parents('.grocery').remove();
    });//delete_button.click

    
function add_grocery_template(data){
    
var grocery_template = 
 '<div class="grocery_data">'
+'      <div class="col-sm-5 col-md-offset-2">'
+'          <div class="well well-sm">'+data.groceryname+'</div>'
+'      </div>'
+'      <div class="col-sm-3">'
+'           <div class="well well-sm">'+data.quantity+'&nbsp</div>'//&nbsp is because moziila make problem with empty div
+'      </div>'
+'      <input type="hidden" name="groceries[]" value="'+data.groceryname+'">'
+'      <input type="hidden" name="quantity[]" value="'+data.quantity+'">'
+'      <div class="cm_button col-sm-2">'
+'          <button class="delete_grocery btn btn-danger ">'
+'              <span class="glyphicon glyphicon-trash"></span>'
+'          </button>'
+'      </div>'
 +'</div>';
 
return grocery_template ;
}//add grocery
    
    
    
    
    
    
    
    
});//$(document).ready