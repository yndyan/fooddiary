<body>
<div class="container" >
    <div class="row">
        <div class="col-sm-8">
        <h3 class ="text-center "> Add new grocery </h3>
        <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/reasons_c/add_reason" method = "post" >
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="new_grocery">Grocery:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="new_grocery" name="new_grocery" required = "true" placeholder="Enter new grocery">
            </div>
            <h4 class="text-center col-sm-8 col-md-offset-3">
            <?php echo form_error('new_grocery'); ?>
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
</body>