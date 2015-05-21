$(document).ready(function() {
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
var baseUrl =window.location.origin + "/" + window.location.pathname.split('/')[1];
    
//-----------------------------------------------------------------------------------
    
    
$("#coursename" ).autocomplete({//mydo js base_url
      source: baseUrl +"/index.php/api_c/getAutocompleteCourses",
      minLength: 2
    });// coursename autocomplete     

    
//-----------------------------------------------------------------------------------
$("#add_course_to_diary").click(function(e){
    e.preventDefault();
    console.log('ola');
    var data = {};
    data.coursename = $("#coursename").val();
    data.quantity    = $("#quantity").val();
    checkCourseExistUrl = baseUrl + '/index.php/api_c/checkCourseExist';
    $.post(checkCourseExistUrl,data,function(e){
        if(e.exist === true){
            
            $('.courses_list').append(add_course_template(data));
            $("#coursename").val('');
            $("#quantity").val('');
            $(".course_data").find(".delete_course").click(function(e){
                e.preventDefault();
                $(this).parents('.course_data').remove();
            });//delete_button.click
        } else {
             if(confirm('No such course! \n Add course?')){
                addCourseUrl = baseUrl + '/index.php/api_c/addCourse';

                $.post(addCourseUrl,data,function(e){
                    if(e.success === true){
                        console.log('aleluja');
                        $('.courses_list').append(add_course_template(data));
                        $("#coursename").val('');
                        $("#quantity").val('');
                        $(".course_data").find(".delete_course").click(function(e){
                            e.preventDefault();
                            $(this).parents('.course_data').remove();
                        });//delete_button.click
                    } else {
                        console.log('error writing in database');
                    }
                },'json');

            } else {
                console.log('cancel adding course');
            }
            
        }
    },'json');
    
    
});// $("#add_course_to_diary")

function add_course_template(data){
    
var course_template = 
 '<div class="course_data">'
+'      <div class="col-sm-6">'
+'          <div class="well well-sm">'+data.coursename+'</div>'
+'      </div>'
+'      <div class="col-sm-4">'
+'           <div class="well well-sm">'+data.quantity+'&nbsp</div>'//&nbsp is because moziila make problem with empty div
+'      </div>'
+'      <input type="hidden" name="courses[]" value="'+data.coursename+'">'
+'      <input type="hidden" name="quantity[]" value="'+data.quantity+'">'
+'      <div class="cm_button col-sm-2">'
+'          <button class="delete_course btn btn-danger ">'
+'              <span class="glyphicon glyphicon-trash"></span>'
+'          </button>'
+'      </div>'
+'</div>';

return course_template ;
}//add_course_template
    
//-----------------------------------------------------------------------------------
$( "#datepicker" ).datepicker();
$( "#timepicker" ).timepicker();
//-----------------------------------------------------------------------------------

$( "#reason" ).autocomplete({
      source: baseUrl +"/index.php/api_c/getAutocompleteReasons",
      minLength: 2
      
    });  




});









/*
$(document).ready(function() {
    var list = $('#food_list');
    //var button_delete = $('#button_delete');
    
    
    $('#add').click(function(e) {
       

        if ($('#food_in').val()) {
                var list_row = $('<tr><td width="90%" >'+$('#food_in').val()+ '</td>');
                list_row.append('<input type="hidden" value="'+$('#food_in').val()+'" name="niz[]" /> ');

                var delete_row = $('<td  width="10%"> <span class="glyphicon glyphicon-remove"></span></td></tr>');
                list_row.append(delete_row);    
                delete_row.click(function(e) {
                        e.preventDefault();
                        $(this).parent().remove();

                });

                

                list.append(list_row);
                $('#food_in').val('');
        } else {
                alert('Please enter data');
        } // else if
    });

    $( "#datepicker" ).datepicker();
    $( "#timepicker" ).timepicker();
    $( "#why" ).autocomplete({//mydo js base_url
      source: "http://localhost/fooddiary/index.php/api_c/getAutocompleteReasons",
      minLength: 2
      
    });    
        
        
});
    
*/