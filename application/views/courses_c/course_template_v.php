

<li class="list-group-item "  id = "grocery_id<?php echo $course_id?>">
<div class="form-group">
    <label class="control-label col-sm-3" >Name:*</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="coursename" name="coursename" required = "true" placeholder="Enter course name">
        </div>
    </div>       
<?php 
    echo $coursename;
?>  
    
    <div class=" pull-right">
        <a  href="<?php echo base_url();?>index.php/groceries_c/update_grocery?grocery_id=<?php echo $course_id?>" class="btn btn-default "><span class="glyphicon glyphicon-edit"></span> Edit</a>
        <a  href="<?php echo base_url();?>index.php/groceries_c/delete_grocery?grocery_id=<?php echo $course_id?>" class="btn btn-danger "><span class="glyphicon glyphicon-remove"></span> Delete</a>
    <div>
</li> 


