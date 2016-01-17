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
console.log(baseUrl);

var input_grocery_template = 
 '<li class="list-group-item cm_fake_label clearfix">'
+'	<form class="form-horizontal" role="form" action="#" method = "post" >'
+'  	<div class="col-sm-9">'
+'      	<input type="text" class="form-control col-sm-3" id="new_grocery" name="new_grocery" required = "true" placeholder="Enter new grocery">'
+'    	</div>'
+'    	<button type="submit" id = "add_grocery_button" class="btn btn-default col-md-offset-1 " value = "Accept" >Submit</button>'
+'  </form>'
+'</li> ';


<li class="list-group-item cm_fake_label" >
    <span class="cm_row_title"> <?php echo $groceryname; ?>  </span>
    <div class=" pull-right">
        <a  href="<?php echo base_url();?>index.php/groceries_c/update_grocery?grocery_id=<?php echo $grocery_id?>" class="btn btn-default ">
            <span class="glyphicon glyphicon-edit"></span> Edit
        </a>
        <a  href="<?php echo base_url();?>index.php/groceries_c/delete_grocery?grocery_id=<?php echo $grocery_id?>" class="confirm_delete btn btn-danger ">
            <span class="glyphicon glyphicon-trash"></span> Delete
        </a>
    <div>
</li> 


$("#add_grocery_form").click(function(e){
    e.preventDefault();
	$("#grocery_list li:eq(0)").after(input_grocery_template);
	$("#add_grocery_button").click(function(e){
    	e.preventDefault();
		var data = {};
    	data.groceryname = $("#new_grocery").val();
		var addGroceryUrl = baseUrl + '/index.php/api_c/addGrocery';//appearing on multiple places, should be moved to function
        $.post(addGroceryUrl,data,function(e){
            if(e.success === true){
                //$('#grocery_list').append(add_grocery_template(data));
                $("#new_grocery").val('');

                // $(".grocery_data").find(".delete_grocery").click(function(e){
                //     e.preventDefault();
                //     $(this).parents('.grocery_data').remove();
                // });//delete_button.click
            } else {
                console.log('error writing in database');
            }
        },'json');

		
	});// $("#add_grocery_button")



});// $("#add_grocery_form")




});//$(document).ready
