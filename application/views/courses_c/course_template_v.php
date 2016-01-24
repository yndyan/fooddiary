<?php
$course_template = <<<EOD
<li id= "course_id_{$course_id}" class="course list-group-item col-sm-12 cm_fake_label">
		<div class = 'clearfix'>
			<div class="col-sm-6 ">
				<div class="coursename well well-sm">
					{$coursename} 
				</div>	
			</div>
	    <div class="buttons pull-right"> 
	        <a href="{$controler_url}/update_course?course_id={$course_id}" class=" btn btn-success ">
	        	<span class="glyphicon glyphicon-edit"></span> 	
	        	Edit
        	</a>
	        <a href="{$controler_url}/delete_course?course_id={$course_id}" class="confirm_delete btn btn-danger ">
	        	<span class="glyphicon glyphicon-trash"></span> 	
	        	Delete
    	</a>
	        <button type="submit" class="expand_course btn btn-info " >
	        	<span class=" glyphicon glyphicon-collapse-down"></span> 
	        	expand 
	        </button> 
	    </div> 
    </div> 
</li> 
EOD;
echo $course_template;
