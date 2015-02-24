<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <style>
        ul.header li {
            display:inline;
            margin: 10px;
        }
        #menu
        {
            width: 900px;
            height: 50px;
            position: absolute;
            top: 50px;
            left: 100px;
            border-style: solid;
            border-color: black;
        }
        #user
        {
            width: 200px;
            height:400px;
            position: absolute;
            top: 50px;
            left: 1100px;
            border-style: solid;
            border-color: black;

        }
    </style>
</head>
<body>
<div id="menu">
<ul class = "header">
    <li><a href = "<?php echo base_url();?>index.php/diary_c/add_food">Add data</a></li>
    <li><a href = "<?php echo base_url();?>index.php/">Edit data</a></li>
    <li><a href = "<?php echo base_url();?>index.php/">History</a></li>
    <li><a href = "<?php echo base_url();?>index.php/Reasons_c/show_reasons_old">Reasons old</a></li>
    <li><a href = "<?php echo base_url();?>index.php/Reasons_c/show_reasons">Reasons</a></li>

    <li><a href = "<?php echo base_url();?>index.php/user_c/display_user_data">User data</a></li>
    <li><a href = "<?php echo base_url();?>index.php/user_c/change_user_password">Change password</a></li>
    <li><a href = "<?php echo base_url();?>index.php/user_c/change_user_data">Change user data</a></li>
    <li><a href = "<?php echo base_url();?>index.php/ /choose_content/">User settings</a></li>
</ul>

</div>
<div id = 'user'>
    <h3><?php echo $username; ?></h3>

    <h3><a href = "<?php echo base_url();?>index.php/Auth_c/logout"> Logout </a> </h3>


    <h4><?php if($userStatus===users::USER_STATUS_NOT_VERIFIED)
        {

            echo "<a href = ".base_url()."index.php/user_c/Send_new_verify_code> Send new verify code </a>";
        }
        ?>
    </h4>
    <h4><?php echo $this->session->flashdata('verify_warning');?></h4>
    </br>
</div>
</body>



