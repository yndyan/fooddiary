<body>
<div class="container" >
    <div class="row">
        <div class="col-sm-10 ">
            <h3 class ="text-center "> Edit course </h3>
            <form class="form-horizontal" role="form" id = "edit_course_form"action="<?php echo base_url();?>index.php/courses_c/update_course?course_id=<?php echo $course_id?>" method = "post" >

            <div class="form-group">
                <label class="control-label col-sm-3" for="coursename">Name:*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="new_coursename" name="new_coursename" required = "true" value="<?php echo $coursename?>">
                    <?php echo form_error('new_coursename'); ?>
                </div>
            </div>
                
            <div class="form-group">
                <label class="control-label col-sm-3" for="new_coursedescription">Description:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="5" id="new_coursedescription" name="new_coursedescription" ><?php echo $coursedescription ?></textarea>
                </div>
                <h4 class="text-center col-sm-8 col-md-offset-3">

                </h4>
            </div>
                
            </br>        
            </br>  
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="new_calories">Calories:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="new_calories" name="new_calories"  value = "<?php echo $calories ?>">
                </div>

            </div>    
            <div class="form-group">    

                <div class="col-sm-8 col-md-offset-3" >
                    <button type="submit" class="btn btn-default " id = "update_course" >Submit</button> 

                </div>
            </div>    
            </form>
        </div>
    </div>
</div>
</body>