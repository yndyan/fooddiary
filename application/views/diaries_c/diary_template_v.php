<li id= "diary_id_<?php echo $diary_id?>" class="diaries list-group-item col-sm-12">
			
			<div class="col-sm-2 ">
				<div class="diary well well-sm"><?php  echo $date;?> </div>	
			</div>
			<div class="col-sm-2 ">
				<div class="diary well well-sm"><?php  echo $time;?> </div>	
			</div>
	    
	            
	    <div class="buttons pull-right"> 
	        <a href="<?php echo base_url();?>index.php/diaries_c/update_diary?diary_id=<?php echo $diary_id?>" class=" btn btn-success "><span class="glyphicon glyphicon-edit"></span> Edit</a>
	        <a href="<?php echo base_url();?>index.php/diaries_c/delete_diary?diary_id=<?php echo $diary_id?>" class=" btn btn-danger "><span class="glyphicon glyphicon-remove"></span> Delete</a>
	    </div> 
</li> 