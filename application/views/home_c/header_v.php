<?php

$nav_bar = array(
        'diary'=>['add ','history','edit'],
        'meals'=>['add meal','show all meals', 'edit meal'],
        'reasons'=>['add reason','show reasons', 'edit reason'],
        'user'=>['user data','edit data', 'change password'],
);


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    
<head>
    <link rel = "stylesheet" href = "<?php echo base_url();?>public/css/bootstrap.min.css">
</head>
    

    
    
    
<body>
    
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url();?>index.php/diary_c/add_food">FOOD DIARY</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li><a href = "<?php echo base_url();?>index.php/diary_c/add_food">Add meal</a></li>

            <li><a href = "<?php echo base_url();?>index.php/">Food diary</a></li>
            <li><a href = "<?php echo base_url();?>index.php/">Meals</a></li>    
            <li><a href = "<?php echo base_url();?>index.php/">Groseries</a></li>
             <li><a href = "<?php echo base_url();?>index.php/Reasons_c/show_reasons">Reasons</a></li>
         
        </ul>
        <ul class="nav navbar-nav navbar-right">
           <?php if($userStatus===  Users_m::USER_STATUS_NOT_VERIFIED){
            echo " <li><a href = ".base_url()."index.php/user_c/Send_new_verify_code> Send new verify code </a></li>";
           }?>
            <li><a href = "<?php echo base_url();?>index.php/user_c/display_user_data"><?php echo $username; ?></a></li>
            <li><a href = "<?php echo base_url();?>index.php/Auth_c/logout">Logout</a></li>
        </ul>
    </div>
  </div>
</nav>
    
    

<div id = 'user'>
    <h3></h3>

    <h3> </h3>


    <h4>
    </h4>
    <h4><?php echo $this->session->flashdata('verify_warning');?></h4>
    </br>
</div>
</body>



