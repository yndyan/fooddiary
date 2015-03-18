<head>
    <script src="<?php echo base_url("public/js/jquery-2.1.1.min.js");?>"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui.min.css">
    <script src="<?php echo base_url();?>public/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url("public/js/courses_input.js");?>"></script>
</head>
<body>
<div class="container" >
    <div class="row">
        <div class="col-sm-10 ">
            <h3 class ="text-center "> Add new course </h3>
            <form class="form-horizontal" role="form" id = "add_course_form"action="<?php echo base_url();?>index.php/api_c/addCourse" method = "post" >

            <div class="form-group">
                <label class="control-label col-sm-3" for="coursename">Name:*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="coursename" name="coursename" required = "true" placeholder="Enter course name">
                </div>
            </div>
                
            <div class="form-group">
                <label class="control-label col-sm-3" for="coursedescription">Description:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="5" id="coursedescription" name="coursedescription"  placeholder="Enter description"></textarea>
                </div>
                <h4 class="text-center col-sm-8 col-md-offset-3">

                </h4>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="groceryname">Groceries:*</label>
                <div class="col-sm-4">
                    <label class="control-label" for="groceryname">Grocery name:*</label>
                    <input type="text" class="form-control ui-widget" id="groceryname" name="groceryname"  placeholder="Enter grocery name">
                </div>

                <div class="col-sm-2">
                    <label class="control-label  " for="quantity">Quantity: </label>
                    <input type="text" class="form-control" id="quantity" name="quantity"  placeholder="Enter quantity">
                </div>
                <div class="col-sm-2  ">
                    <label class="control-label"> Kakooo???</label>
                    <button type="submit" class="btn btn-success" id = "add_grocery_to_course"  ><span class="glyphicon glyphicon-plus"></span> Add grocery</button> 
                 </div>   
            </div>    

            <div class="form-group" id = "grocery_list"> 
<!--                <div class="col-sm-10 col-md-offset-3">
                    <div class="grocery_data">
                    
                        <p class="list-group-item col-sm-4 ">Item 1</p>
                        <p class="list-group-item col-sm-2 col-md-offset-1 ">3000</p>
                        <button class="btn btn-danger col-md-offset-1">
                                <span class="glyphicon glyphicon-remove"></span> 
                                Delete
                        </button>
                    </div> 
                    </br>
                    <div class="grocery_error">
                    
                        <p class="list-group-item col-sm-4 ">no such grocery</p>
                        
                        <button class="btn btn-success col-md-offset-2">
                                <span class="glyphicon glyphicon-plus"></span> 
                                Add
                        </button>
                        <button class="btn btn-danger col-md-offset-1">
                                <span class="glyphicon glyphicon-edit"></span> 
                                Edit
                        </button>
                    </div>    
                     
                </div>  -->
            </div>    
                </br>        
                </br>        
            <div class="form-group">
                <label class="control-label col-sm-3" for="calories">Calories:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="calories" name="calories"  placeholder="Enter course calories">
                </div>

            </div>    
            <div class="form-group">    

                <div class="col-sm-8 col-md-offset-3" >
                    <button type="submit" class="btn btn-default " id = "add_course" >Submit</button> 

                </div>
            </div>    
            </form>
        </div>
    </div>
</div>
</body>


                