<div class="container" >
    <div class="row">
        <div class="col-sm-9">
        <h2 class ="text-center"> Password reset page </h2>
        
        <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/Auth_c/send_password_verify_code" method = "post" >
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="email">Username or email:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="email" name="username_or_email" required="true" placeholder="Enter username or email">
            </div>
            <?php echo form_error('username_or_email'); ?>
        </div>
            
        <div class="form-group">    
            <div class="col-sm-3"></div>
            <div class="col-sm-6" >
                <button type="submit" class="btn btn-default" value = "Accept" >Submit</button> 
                <label class="text-warning"> <?php echo $this->session->flashdata('verify_warning');?> </label>
            </div>
        </div>    
        </form>
        </div>
    </div>
</div>