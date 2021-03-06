<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
    <?php 
        $method = $this->router->fetch_method();
        $this->load->helper('files_loader');
        $locations_array =  get_needed_locations($method);     
        foreach ($locations_array as $location) { 
            $extension = get_file_extension($location); 
            if($extension === 'css') {
                echo create_css_url($location);
            } else if($extension === 'js') {
                echo create_script_url($location); 
            }     
        } 
        $base_url_index = base_url("index.php"); 
    ?>
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo $base_url_index?>/diaries_c/show_diaries"> Food diary</a>
    </div>
      
    <div>
        <ul class="nav navbar-nav">
            <li <?php if($this->uri->segment(1)=='diaries_c') {echo 'class="active"';}?>>
                <a href = "<?= $base_url_index?>/diaries_c/show_diaries/"><span class="glyphicon glyphicon-calendar"></span> Diary</a>
            </li>
            <li <?php if($this->uri->segment(1)=='courses_c') {echo 'class="active"';}?>>
                <a href = "<?= $base_url_index?>/courses_c/show_courses"><span class="glyphicon glyphicon-list"></span> Courses</a>
            </li>    
            <li <?php if($this->uri->segment(1)=='groceries_c') {echo 'class="active"';}?>>
                <a href = "<?= $base_url_index?>/groceries_c/show_groceries"><span class="glyphicon glyphicon-apple"></span> Groceries</a>
            </li>
            <li <?php if($this->uri->segment(1)=='reasons_c') {echo 'class="active"';}?>>
                <a href = "<?= $base_url_index?>/reasons_c/show_reasons"><span class="glyphicon glyphicon-question-sign"></span> Reasons</a>
            </li>
         
        </ul>
        <ul class="nav navbar-nav navbar-right">
           <?php if($userStatus=== Users_m::USER_STATUS_NOT_VERIFIED){
            echo " <li><a href = ".$base_url_index."/user_c/Send_new_verify_code> Send new verify code </a></li>";
           }?>
            <li <?php if($this->uri->segment(1)=='user_c') {echo 'class="active"';}?>><a href = "<?php echo $base_url_index?>/user_c/display_user_data"><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?></a></li>
            <li><a href = "<?php echo $base_url_index?>/auth_c/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
  </div>
</nav>

<h4><?php echo $this->session->flashdata('verify_warning');?></h4>






