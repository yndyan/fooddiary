<head>

<script src="<?php echo base_url("public/js/jquery-2.1.1.min.js");?>"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui.min.css">
<script src="<?php echo base_url();?>public/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery-ui-timepicker-addon.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui-timepicker-addon.min.css">

<script src="<?php echo base_url(); ?>public/js/input.js"></script>



<style>

    
    div.ui-datepicker {
    font-size: 80%;
    }
</style>
</head>

<body>

    
    <h2> Add food</h2>
    
       <p> What:* </p>  
        <input  id = "food_in" > 
        <button id = "add">add</button>
        <form id = "add_form"action = "<?php echo base_url(); ?>index.php/diary_c/add_food" method = "post">
            <table style="width:100%" id = "food_list" > </table>
          
   
            <p>When?</p>
            <p>Date: <input type="text" id="datepicker" size="12px"></p>
            <p>Time: <input type="text" id="timepicker" size="12px"></p>
           
        </br>
            <div class="ui-widget">
            <label for="why">Why? </label>
            <input id="why">
            </div>

        <h4>* - this fields are required </h4>
    
    </form>
        
    




</body>