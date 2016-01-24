<div class="container" >
    <div class="row">
        <h2 class ="text-center"> User data page </h2>
        <h3 class ="text-warning text-center"><?php echo $this->session->flashdata('grocery_messages');?></h3>
        
        <div class="row  col-sm-9 col-md-offset-2">
             
            <div class="form-group">
                <label class="control-label col-sm-3" >Username:*</label>
                <div class="well well-sm col-sm-6 "><?php echo $username; ?></div>
            </div>
            
            </br>
            </br>
            </br>
            
            <div class="form-group">
                <label class="control-label col-sm-3" >Email:</label>
                <div class="well well-sm col-sm-6 "><?php echo $email,$userstatus === users_m:: USER_STATUS_VERIFIED ? ' (verified)':' (not verified)';?></div>
            </div>
            
            </br>
            </br>
            </br>
            
            <div class="form-group">
                <label class="control-label col-sm-3" >Full name:</label>
                <div class="well well-sm col-sm-6 "><?php echo $fullname; ?></div>
            </div>
            
            </br>
            </br>
            </br>
            
            <div class="form-group col-md-offset-3">
            <label class="control-label col-sm-6" > <?php echo "<a href = ".base_url()."index.php/user_c/Send_new_verify_code> Send new verify code (delete this)</a>";//mydo delete this ?>:</label>
            
            </div>
           
            </br>
            </br>
            <div class="form-group col-md-offset-3">
            <label class="control-label col-sm-6" > <a href = "<?php echo base_url();?>index.php/user_c/change_user_password">Change password</a></label>
            
            </div>
           
            </br>
            </br>
            <div class="form-group col-md-offset-3">
            <label class="control-label col-sm-6" > <a href = "<?php echo base_url();?>index.php/user_c/change_user_data">Change user data</a></label>
            
            </div>
          
        
        </div>
        
    </div>
</div>


