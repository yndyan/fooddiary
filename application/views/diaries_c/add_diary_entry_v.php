<head>
    
    <script src="<?php echo base_url();?>public/js/jquery-ui-timepicker-addon.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui-timepicker-addon.css">
    
    <script src="<?php echo base_url(); ?>public/js/add_diary.js"></script>

</head>

<body>

<div class="container" >
    <div class="row col-sm-12">
        <h2 class ="text-center"> Add courses to diary</h2>  
        <form class="form-horizontal" role="form" id = "add_diary_form">  
            <div class="form-group clearfix">
                <div class="col-sm-6">
                        <label class="control-label" for="course">Course name <span class="glyphicon glyphicon-list"></span></label>
                        <input id="coursenameinput" class="form-control ui-widget ui-autocomplet-input" type="text" name="coursename" placeholder="Enter course name" autocomplete="off">
                </div>

                <div class="col-sm-4">
                        <label class="control-label" for="quantity">Quantity <span class = "glyphicon glyphicon-scale"></span></label>
                        <input id="quantity" class="form-control" type="text" name="quantity" placeholder="Enter quantity">
                </div>

                <div class="col-sm-2 cm_fake_label">
                        <button id="add_course_to_diary" class="btn btn-success" type="submit">
                           <span class="glyphicon glyphicon-plus"></span>
                           <span>Add course</span>
                        </button>
                </div>
            </div>

            <div class="form-group courses_list">
            <!--   here you add courses with JQ      -->
            </div>

            <div class="diary_details form-group clearfix">
                <div class="col-sm-6">
                    <label class="control-label" for="reason">Reason <span class="glyphicon glyphicon-question-sign"></span></label>
                    <input id="reason" class="form-control ui-widget ui-autocomplet-input" type="text" name="reasonname" placeholder="Enter reason" autocomplete="off">

                </div>

                <div class="col-sm-3">
                    <label class="control-label" for="date">Date <span class="glyphicon glyphicon-calendar"></span></label>
                    <input id="datepicker" class="picker form-control" type="text" name="date" placeholder="Enter date dd-mm-yyyy">
                </div>

                <div class="col-sm-3">
                    <label class="control-label" for="time">Time <span class="glyphicon glyphicon-time"></span></label>
                    <input id="timepicker" class="picker form-control" type="text" name="time" placeholder="Enter time hh:mm, 24 hour">
                </div>
            </div>

            <div class="form-group">    
                <div class="col-sm-7 col-md-offset-5" >
                    <button type="submit" class="btn btn-default btn-lg" id = "add_diary" >Submit</button> 

                </div>
            </div>  
        </form> 
    </div>
</div>

        

    
    
</body>        
        
        
        
        
        
        
        
  
    

