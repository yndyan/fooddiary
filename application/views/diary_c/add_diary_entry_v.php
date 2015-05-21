<head>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui.css">
    <script src="<?php echo base_url("public/js/jquery-2.1.1.min.js");?>"></script>
    
    <script src="<?php echo base_url();?>public/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>public/js/jquery-ui-timepicker-addon.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui-timepicker-addon.min.css">
    <script src="<?php echo base_url(); ?>public/js/add_diary.js"></script>

</head>

<body>

<div class="container" >
    <div class="row col-sm-12">
        <h2 class ="text-center"> Add courses to diary</h2>    
        <div class="form-group clearfix">
            <div class="col-sm-6">
                    <label class="control-label" for="course">Course name: </label>
                    <input id="coursename" class="form-control ui-widget ui-autocomplet-input" type="text" name="coursename" placeholder="Enter course name" autocomplete="off">
            </div>

            <div class="col-sm-4">
                    <label class="control-label" for="quantity">Quantity: </label>
                    <input id="quantity" class="form-control" type="text" name="quantity" placeholder="Enter quantity">
            </div>

            <div class="col-sm-2 cm_fake_label">
                    <button id="add_course_to_diary" class="btn btn-success" type="submit">
                       <span class="glyphicon glyphicon-plus"></span>
                       <span>Add course</span>
                    </button>
            </div>
        </div>

        <div class="courses_list">
        </div>

        <div class="diary_details form-group clearfix">
            <div class="col-sm-6">
                <label class="control-label" for="reason">Reason: </label>
                <input id="reason" class="form-control ui-widget ui-autocomplet-input" type="text" name="reason" placeholder="Enter reason" autocomplete="off">
            </div>

            <div class="col-sm-3">
                <label class="control-label" for="date">Date*: </label>
                <input id="datepicker" class="picker form-control" type="text" name="date" placeholder="Enter date">
            </div>

            <div class="col-sm-3">
                <label class="control-label" for="time">Time: </label>
                <input id="timepicker" class="picker form-control" type="text" name="time" placeholder="Enter time">
            </div>
        </div>
    </div>
</div>

        

    
    
</body>        
        
        
        
        
        
        
        
        
        
        
        
<!--    <h2> Add food</h2>
    
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
    
    </form>-->
        
    

