<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <style>

    ul li {
        display:inline;
        margin: 10px;

    }
    #menu
    {
        width: 400px;
        height: 50px;
        position: absolute;
        top: 50px;
        left: 100px;
        border-style: solid;
        border-color: black;
    }

    </style>

</head>
<body>
    <ul id="menu">
        <li><a href=" <?php echo base_url(); ?>index.php/Auth_c/login">Login</a></li>
        <li><a href = "<?php echo base_url();?>index.php/Auth_c/register_new_user">Register</a></li>
        <li><a href = "<?php echo base_url();?>index.php/Auth_c/send_password_verify_code">Forgot password</a></li>
        <li><a href = "<?php echo base_url();?>index.php/Auth_c/site_info">Site informations </a></li>

    </ul>
</body>
