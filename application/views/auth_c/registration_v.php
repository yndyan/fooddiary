<body>
<div class="container" >
    <div class="row">
        <div class="col-sm-9">
        <h2 class ="text-center"> Registration page </h2>    
        <form class="form-horizontal" role="form" action = "<?php echo base_url(); ?>index.php/auth_c/register_new_user" method = "post">

           <div class="form-group">
                <label class="control-label col-sm-3" for="username">Username:*</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" required = "true" placeholder="Insert username">
                </div>
                <?php echo form_error('username'); ?>
            </div>
            
           <div class="form-group">
                <label class="control-label col-sm-3" for="password">Password:*</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="password" required = "true" placeholder="Insert password">
                </div>
                <?php echo form_error('password'); ?>
            </div>
            
           <div class="form-group">
                <label class="control-label col-sm-3" for="confpass">Password confirm:*:*</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="confpass" name="confpass" required = "true" placeholder="Confirm password">
                </div>
                <?php echo form_error('confpass'); ?>
            </div>
            
           <div class="form-group">
                <label class="control-label col-sm-3" for="email">Email:*</label>
                
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" name="email" required = "true" placeholder="Insert email">
                </div>
                <?php echo form_error('email'); ?>
            </div>
            
           <div class="form-group">
                <label class="control-label col-sm-3" for="fullname">Full name:</label>
                
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="fullname" name="fullname"  placeholder="Insert full name">
                </div>
            </div>
            
            <div class="form-group">    
                
                <div class="col-sm-6 col-md-offset-3" >
                    <button type="submit" class="btn btn-default" value = "Accept">Submit</button>
                </div>
            </div>    
            
            <div class="form-group">    
               
                <div class="col-sm-6 col-md-offset-3" >
                    <h4>* - this fields are required for registration</h4>
                </div>
            </div> 
        </form>
        </div>
    </div>
</div>