<head>
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
        <!--   here you add groceries with JQ        -->
        </div>   
                     
        <div class="form-group">
            <label class="control-label col-sm-2" for="calories">Calories:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="calories" name="calories"  placeholder="Enter course calories">
            </div>

        </div>   

        <div class="form-group">    
            <div class="col-sm-8 col-md-offset-2" >
                <button type="submit" class="btn btn-default btn-lg" id = "add_course" >Submit</button> 
            </div>
        </div>   
         
        </form>
    </div>
</div>
</body>


                