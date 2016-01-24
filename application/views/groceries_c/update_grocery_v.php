<body>
<div class="container" >
    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
        <h3 class ="text-center "> Update grocery </h3>
        <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/groceries_c/update_grocery?grocery_id=<?php echo $grocery_id?>" method = "post" >
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="update_groceryname">Grocery:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="update_groceryname" name="update_groceryname" required = "true" value = "<?php  echo $groceryname; ?>">
            </div>
            <h4 class="text-center col-sm-8">
                <?php echo form_error('update_groceryname'); ?>
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
