<body>
<div class="container" >
    <div class="row">
        <div class="col-sm-10 ">
            <h3 class ="text-center "> Add new course </h3>
            <form class="form-horizontal" role="form" action = "<?php echo base_url(); ?>index.php/user_c/change_User_Data"  method = "post">
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Email adress:*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="email" name="email" required = "true" value="<?php echo (set_value('email')?set_value('email'):$email);?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="fullname">Full name::*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="fullname" name="fullname" required = "true" value="<?php echo (set_value('fullname')?set_value('fullname'):$fullName); ?>"/>
                </div>
            </div>
                
   
            <div class="form-group">    

                <div class="col-sm-8 col-md-offset-3" >
                    <button type="submit" class="btn btn-default " value = "Accept"    >Submit</button> 

                </div>
            </div>    
            </form>
        </div>
    </div>
</div>

