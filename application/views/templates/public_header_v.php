<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel = "stylesheet" href = "<?php echo base_url();?>public/css/bootstrap.min.css">
</head>
    
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/Auth_c/login">Food Diary</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li <?php if($this->uri->segment(2)=='login') {echo 'class="active"';}?>>
                <a href = "<?php echo base_url();?>index.php/Auth_c/login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
            </li>
            <li <?php if($this->uri->segment(2)=='register_new_user') {echo 'class="active"';}?>><a href = "<?php echo base_url();?>index.php/Auth_c/register_new_user"><span class="glyphicon glyphicon-registration-mark"></span> Register</a></li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right"> 
            <li <?php if($this->uri->segment(2)=='about') {echo 'class="active"';}?>><a href = "<?php echo base_url();?>index.php/Auth_c/about"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
        </ul>
    </div>
  </div>
</nav>

