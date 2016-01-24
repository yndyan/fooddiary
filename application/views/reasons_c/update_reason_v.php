<body>
<div class="container" >
    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
        <h3 class ="text-center "> Update reason </h3>
        <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/reasons_c/update_reason?reason_id=<?php echo $reason_id?>" method = "post" >
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="update_reason">Reason:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="update_reason" name="update_reason" required = "true" value = "<?php  echo $reasonname; ?>">
            </div>
            <h4 class="text-center col-sm-8 col-md-offset-3">
            <?php echo form_error('update_reason'); ?>
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
