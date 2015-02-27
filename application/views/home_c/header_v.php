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
    <link rel = "stylesheet" href = "<?php echo base_url();?>public/css/home_header.css">
</head>
    
    
<body>
<div id="menu">
<ul class = "header">
    <li><a href = "<?php echo base_url();?>index.php/diary_c/add_food">Add meal</a></li>
    <li><a href = "<?php echo base_url();?>index.php/">Edit data</a></li>
    <li><a href = "<?php echo base_url();?>index.php/">food diary</a></li>
    <li><a href = "<?php echo base_url();?>index.php/Reasons_c/show_reasons_old">Reasons old</a></li>
    <li><a href = "<?php echo base_url();?>index.php/Reasons_c/show_reasons?page=5">Reasons</a></li>

    <li><a href = "<?php echo base_url();?>index.php/user_c/display_user_data">User data</a></li>
    <li><a href = "<?php echo base_url();?>index.php/user_c/change_user_password">Change password</a></li>
    <li><a href = "<?php echo base_url();?>index.php/user_c/change_user_data">Change user data</a></li>
</ul>

</div>
<div id = 'user'>
    <h3><?php echo $username; ?></h3>

    <h3><a href = "<?php echo base_url();?>index.php/Auth_c/logout"> Logout </a> </h3>


    <h4><?php if($userStatus===  Users_m::USER_STATUS_NOT_VERIFIED)
        {

            echo "<a href = ".base_url()."index.php/user_c/Send_new_verify_code> Send new verify code </a>";
        }
        ?>
    </h4>
    <h4><?php echo $this->session->flashdata('verify_warning');?></h4>
    </br>
</div>
</body>



