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
    
    
$("#coursenameinput" ).autocomplete({//mydo js base_url
      source: baseUrl +"/index.php/api_c/getAutocompleteCourses",
      minLength: 2
    });// coursename autocomplete     

    
//-----------------------------------------------------------------------------------
$("#add_course_to_diary").click(function(e){
    e.preventDefault();
    console.log('ola');
    var data = {};
    data.coursename = $("#coursenameinput").val();
    data.quantity    = $("#quantity").val();
    checkCourseExistUrl = baseUrl + '/index.php/api_c/checkCourseExist';
    $.post(checkCourseExistUrl,data,function(e){
        if(e.exist === true){
            
            $('.courses_list').append(add_course_template(data));
            $("#coursenameinput").val('');
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
//-------------------------------------------------------------------------------------
$("#add_diary").click(function(e){
    e.preventDefault();
    var addDiaryUrl = baseUrl + '/index.php/api_c/addDiary';
    diaryData = $("#add_diary_form").serializeArray(); 

    $(".course_error").remove();
    $("#reason_error").remove();
    $("#date_error").remove();
    $("#time_error").remove();
    
    $.post(addDiaryUrl,diaryData,function(e){
        if(e.success === false){

            $.each(e.errors,function(key,value){
                if (key.indexOf('courses')>=0){

                    var course_error = $(div).addClass("course_error").addClass("well well-sm alert alert-warning");
                    if(value === 'The course field is required.'){
                        $("#coursenameinput").after(course_error.append(value));
                    } else {
                        position = key.match(/\d+/);
                        var dom_coursename_div = $($("input[name='courses[]']")[position]).parents(".course_data").find(".coursename");
                        dom_coursename_div.append(course_error.append(value)); 
                    }
                } else if (key === 'reasonname'){
                    var reason_error = $(div).attr('id','reason_error').addClass("well well-sm alert alert-warning");//.attr('role','alert');
                    $("#reason").after(reason_error.append(value));
                } else if (key === 'date'){
                    var date_error = $(div).attr('id','date_error').addClass("well well-sm alert alert-warning");//.attr('role','alert');
                    $("#datepicker").after(date_error.append(value));
                }else if (key === 'time'){
                    var time_error = $(div).attr('id','time_error').addClass("well well-sm alert alert-warning");//.attr('role','alert');
                    $("#timepicker").after(time_error.append(value));
                }
            });//each
        } else if(e.success === true){
            window.location.replace(baseUrl +'/index.php/diaries_c/show_add_diary');//mydo change to show_diary
        }//
    },'json');
});//#add_course.click
//-------------------------------------------------------------------------------
function add_course_template(data){
    
var course_template = 
 '<div class="course_data">'
+'      <div class="coursename col-sm-6">'
+'          <div class="well well-sm">'+data.coursename+'</div>'
+'      </div>'
+'      <div class="col-sm-4">'
+'           <div class="well well-sm">'+data.quantity+'&nbsp</div>'//&nbsp is because moziila make problem with empty div
+'      </div>'
+'      <input type="hidden" name="courses[]" value="'+ data.coursename +'">'
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
$( "#datepicker" ).datepicker({
        dateFormat: "dd-mm-yy",
        firstDay: 1,
        }
    );
//-----------------------------------------------------------------------------------
$( "#timepicker" ).timepicker();
//-----------------------------------------------------------------------------------

$( "#reason" ).autocomplete({
      source: baseUrl +"/index.php/api_c/getAutocompleteReasons",
      minLength: 2
    });  
//-----------------------------------------------------------------------------------      




});//$(document).ready(function() {


