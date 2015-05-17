<div class ="expanded_course">
    <button type="submit" class="collapse_course btn btn-info pull-right "   ><span class="expand_course glyphicon glyphicon-collapse-up"></span> collapse </button>         
    </br>
    </br>
    </br>

    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title ">Description</h3>
        </div>
        <div class="panel-body">
            <?php echo $coursedescription ?> 
        </div>
    </div>
    
    <div class="form-group">
       
        <div class="col-sm-5  ">
            <label class="control-label" for="groceryname">Grocery name:*</label>
            <input type="text" class="form-control ui-widget" id="groceryname" name="groceryname"  placeholder="Enter grocery name">
        </div>

        <div class="col-sm-3 col-md-offset-1">
            <label class="control-label  " for="quantity">Quantity: </label>
            <input type="text" class="form-control" id="quantity" name="quantity"  placeholder="Enter quantity">
        </div>
        <div class="col-sm-2  ">
            <label class="control-label"> Kakooo???</label>
            <button type="submit" class="btn btn-success" id = "add_grocery_to_course"  ><span class="glyphicon glyphicon-plus"></span> Add grocery</button> 
         </div>   
    </div>
    </br>  
    </br>  
     </br>  
   
    </br>
        <div class="grocery col-sm-12">
            <?php foreach($groceries as $key => $grocery){ ?>
                <div class="grocery_data">
                    <div class="well well-sm col-sm-5 "> <?php echo $grocery['groceryname']; ?></div>
                    <div class="well well-sm col-sm-3 col-md-offset-1 "><?php echo $grocery['quantity'];?></div>
                    <button class="btn btn-danger col-md-offset-1">
                        <span class="glyphicon glyphicon-remove"></span> 
                        Delete
                    </button>
                </div>

                </br>  
                </br>  
            <?php } ?>        
        </div>
   

    <div class="col-sm-12 ">
        <p> Calories </p>
        <div class="well well-sm col-sm-5"><?php echo $calories;?></div>
        
        <div class="pull-right"> 
            <a  href="<?php echo base_url();?>index.php/courses_c/update_course?course_id=<?php echo $course_id?>" class=" btn btn-success "><span class="glyphicon glyphicon-edit"></span> Edit course</a>
            <a  href="<?php echo base_url();?>index.php/courses_c/delete_course?course_id=<?php echo $course_id?>" class=" btn btn-danger "><span class="glyphicon glyphicon-remove"></span> Delete course</a>
        </div>  
    </div>
            
  
</div>
