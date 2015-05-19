<li id= "course_id_<?php echo $course_id?>" class="course list-group-item col-sm-12">
		<div class = 'clearfix'>
			<div class="col-sm-6 ">
				<div class="coursename well well-sm"><?php  echo $coursename;?> </div>	
			</div>
	    
	            
	    <div class="buttons pull-right"> 
	        <a href="<?php echo base_url();?>index.php/courses_c/update_course?course_id=<?php echo $course_id?>" class=" btn btn-success "><span class="glyphicon glyphicon-edit"></span> Edit</a>
	        <a href="<?php echo base_url();?>index.php/courses_c/delete_course?course_id=<?php echo $course_id?>" class=" btn btn-danger "><span class="glyphicon glyphicon-remove"></span> Delete</a>
	        <button type="submit" class="expand_course btn btn-info " ><span class=" glyphicon glyphicon-collapse-down"></span> expand </button> 
	    </div> 
    </div> 
</li> 