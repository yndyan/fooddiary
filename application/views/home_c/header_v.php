<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    
<head>
    <link rel = "stylesheet" href = "<?php echo base_url();?>public/css/bootstrap.min.css">
</head>
    
    
<body>
    
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url();?>index.php/diary_c/add_food">Food Diary</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li><a href = "<?php echo base_url();?>index.php/diary_c/add_food">Add meal</a></li>

            <li><a href = "<?php echo base_url();?>index.php/"><span class="glyphicon glyphicon-calendar"></span> Diary</a></li>
            <li><a href = "<?php echo base_url();?>index.php/"><span class="glyphicon glyphicon-list"></span> Course</a></li>    
            <li><a href = "<?php echo base_url();?>index.php/"><span class="glyphicon glyphicon-apple"></span> Groceries</a></li>
            <li><a href = "<?php echo base_url();?>index.php/Reasons_c/show_reasons"><span class="glyphicon glyphicon-question-sign"></span> Reasons</a></li>
         
        </ul>
        <ul class="nav navbar-nav navbar-right">
           <?php if($userStatus===  Users_m::USER_STATUS_NOT_VERIFIED){
            echo " <li><a href = ".base_url()."index.php/user_c/Send_new_verify_code> Send new verify code </a></li>";
           }?>
            <li><a href = "<?php echo base_url();?>index.php/user_c/display_user_data"><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?></a></li>
            <li><a href = "<?php echo base_url();?>index.php/Auth_c/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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



