<head>
    <script src="<?php echo base_url("public/js/jquery-2.1.1.min.js");?>"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui.min.css">
    <script src="<?php echo base_url();?>public/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url("public/js/add_course.js");?>"></script>
</head>
<body>
<div class="container" >
    <div class="row col-sm-12">
            <h3 class ="text-center "> Add new course </h3>
            <form class="form-horizontal" role="form" id = "add_course_form" >

            <div class="form-group">
                <label class="control-label col-sm-2" for="coursename">Name:*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="coursename" name="coursename" required = "true" placeholder="Enter course name">
                </div>
            </div>
                
            <div class="form-group">
                <label class="control-label col-sm-2" for="coursedescription">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="5" id="coursedescription" name="coursedescription"  placeholder="Enter description"></textarea>
                </div>
                <h4 class="text-center col-sm-8 col-md-offset-3">

                </h4>
            </div>

                <div class="form-group clearfix">
                        <label class="control-label col-sm-2" for="groceryname">Groceries:*</label>
			<div class="col-sm-5">
				<label class="control-label" for="groceryname">Grocery name: </label>
				<input id="groceryname" class="form-control ui-widget ui-autocomplet-input" type="text" name="groceryname" placeholder="Enter grocery name" autocomplete="off">
			</div>

			<div class="col-sm-3">
				<label class="control-label" for="quantity">Quantity: </label>
				<input id="quantity" class="form-control ui-widget" type="text" name="quantity" placeholder="Enter quantity">
			</div>

			<div class="col-sm-2 cm_fake_label">
				<button id="add_grocery_to_course" class="btn btn-success" type="submit">
				   <span class="glyphicon glyphicon-plus"></span>
				   <span>Add grocery</span>
				</button>
			</div>
		</div>

            
            <div class="form-group " id = "grocery_list"> 
<!--                <div class="col-sm-10 col-md-offset-3">
                    <div class="grocery_data ">
                    
                        <div class="well well-sm col-sm-4 ">Item 1</div>
                        <div class="well well-sm col-sm-2 col-md-offset-1 ">3000</div>
                        
                        <button class="btn btn-danger col-md-offset-1">
                                <span class="glyphicon glyphicon-remove"></span> 
                                Delete
                        </button>
                    </div> 
                    </br>  
                    </br>  
                    
                    <div class="grocery_error">
                    
                        <div class="well well-sm col-sm-4 ">no such grocery</div>
                        
                        <button class="btn btn-success col-md-offset-2">
                                <span class="glyphicon glyphicon-plus"></span> 
                                Add
                        </button>
                        <button class="btn btn-danger col-md-offset-1">
                                <span class="glyphicon glyphicon-edit"></span> 
                                Edit
                        </button>
                    </div>    
                </div> -->
            </div>   
                
                
                     
            <div class="form-group">
                <label class="control-label col-sm-2" for="calories">Calories:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="calories" name="calories"  placeholder="Enter course calories">
                </div>

            </div>    
            <div class="form-group">    

                <div class="col-sm-8 col-md-offset-2" >
                    <button type="submit" class="btn btn-default " id = "add_course" >Submit</button> 

                </div>
            </div>    
            </form>
    </div>
</div>
</body>


                