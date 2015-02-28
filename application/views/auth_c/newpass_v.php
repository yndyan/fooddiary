<style>
    #content
    {
        width: 600px;
        height: 400px;
        position: absolute;
        top: 400px;
        left: 100px;
        border-style: solid;
        border-color: black;
        padding-left :10px;

    }

</style>
<div class="container" >
    <div class="row">
        <div class="col-sm-9">
        <h2 class ="text-center">Please insert new password</h2>    
        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>index.php/Auth_c/reset_password/<?php  echo $pass_code; ?>" method = "post">
                      
           <div class="form-group">
                <label class="control-label col-sm-3" for="new_password">Password:*</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="new_password" name="new_password" required = "true" placeholder="Insert password">
                </div>
                <?php echo form_error('new_password'); ?>
            </div>
            
           <div class="form-group">
                <label class="control-label col-sm-3" for="new_confpass">Password confirm:*:*</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="new_confpass" name="new_confpass" required = "true" placeholder="Confirm password">
                </div>
                <?php echo form_error('new_confpass'); ?>
            </div>
            
           
            
            <div class="form-group">    
                <div class="col-sm-3"></div>
                <div class="col-sm-6" >
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>    
            
       
        </form>
        </div>
    </div>
</div>












<body>
<div id ="content">
    <h3>Please insert and confirm new password </h3>
    <form action="<?php echo base_url(); ?>index.php/Auth_c/reset_password/<?php  echo $pass_code; ?>" method = "post">
        <h4>
            New password:
            <input type = "password" name = "new_password"  required = "true" />
            <?php echo form_error("new_password");?>
        </h4>

        <h4>
            Confirm password:
            <input type ="password"  name = "new_confpass"  required = "true" />
            <?php echo form_error ("new_confpass");?>
        </h4>
        <h4>
            <button type = "submit"> Accept</button>
        </h4>
    </form>
</div>
</body>