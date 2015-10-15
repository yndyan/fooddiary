<body>
 
<div class="container" >
    <div class="row">
        <div class="col-sm-9">
        <h2 class ="text-center"> Login page </h2>
        <h3 class="text-warning text-center"><?php echo $this->session->flashdata('verify_warning');?></h3>
        
        
        
        <form class="form-horizontal" role="form" action = "<?php echo base_url();?>index.php/auth_c/login" method = "post">
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Username or email:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="email" name="username_or_email" required="true" placeholder="Enter username or email">
                </div>
                <?php echo form_error('username_or_email'); ?>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Password: </label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="pwd" name="password"  required="true" placeholder="Enter password">
                </div>
                <?php echo form_error('password'); ?>
            </div>
            <div class="form-group">    
                <div class="col-sm-6 col-md-offset-3" >
                    <label><a href = "<?php echo base_url();?>index.php/auth_c/send_password_verify_code">Forgot password?</a></label>
                </div>
            </div>   
            <div class="form-group">
                <div class="col-sm-6 col-md-offset-3" class="checkbox">
                    
                    <label><input type="checkbox"> Remember me</label>
                </div>
            </div>    
            <div class="form-group">    
                <div class="col-sm-6 col-md-offset-3" >
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>    
 
        </form>
        <h3 class="text-warning" ><?php  //echo $auth_message; ?></font></h3>
        </div> 
    </div> 
</div>    
 


