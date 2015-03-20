

  <div class="panel panel-default" id = "course_id_<?php echo $course_id?>">
  <div class="panel-heading">
    <h3 class="panel-title">
        <label >Course name: </label> 
        <?php echo $coursename; //mydo add protection from user html?>  
    </h3>
  </div>
  <div class="panel-body">
    
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title ">Description</h3>
        </div>
        <div class="panel-body">
            <?php echo $coursedescription; //mydo add protection from user html?>  
        </div>
    </div>
                
               
    <div class="col-sm-12 ">
        <p class="col-sm-6 "> Grocery </p>
        <p class="col-sm-3 col-md-offset-1 ">Quantity</p> 
        <?php  foreach($groceries as $grocery){ ?>
                <div class="well well-sm col-sm-6 "><?php  echo $grocery['groceryname'];?></div>
                <div class="well well-sm col-sm-3 col-md-offset-1 "><?php echo $grocery['quantity'];?></div>
        <?php }//foreach ?>  
        
                     

    </div>   
      <div class="well well-sm col-sm-5 col-md-offset-1"><?php  echo $calories;?></div> 
       
      <div class="col-sm-4 col-md-offset-1"> 
        <a  href="<?php echo base_url();?>index.php/groceries_c/update_grocery?grocery_id=<?php echo $course_id?>" class="btn btn-default "><span class="glyphicon glyphicon-edit"></span> Edit</a>
        <a  href="<?php echo base_url();?>index.php/groceries_c/delete_grocery?grocery_id=<?php echo $course_id?>" class="btn btn-danger "><span class="glyphicon glyphicon-remove"></span> Delete</a>
    </div>
 </div>
 </div>
