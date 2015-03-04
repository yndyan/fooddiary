<body>
<div class="container" >
    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
        <h3 class ="text-center "> Update grocery </h3>
        <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/groceries_c/update_grocery" method = "post" >
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="update_grocery">Grocery:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="update_grocery" name="update_grocery" required = "true" value = "<?php  echo $groceryname; ?>">
                <input type="hidden" name ="grocery_id" value ="<?php echo $grocery_id;?>">
            </div>
            <h4 class="text-center col-sm-8 col-md-offset-3">
            <?php echo form_error('update_grocery'); ?>
            </h4>
        </div>
            
        <div class="form-group">    
           
            <div class="col-sm-8 col-md-offset-3" >
                <button type="submit" class="btn btn-default " value = "Accept" >Submit</button> 
                
            </div>
        </div>    
        </form>
        </div>
    </div>
</div>
</body><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

