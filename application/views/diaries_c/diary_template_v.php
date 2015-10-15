<li id= "diary_id_<?php echo $diary_id?>" class="diaries list-group-item  clearfix">
    
     
    <div class="col-sm-1 ">
       
        <div class="diary well well-sm"><?php  echo $formated_diary_time;?> </div>	
    </div>
    <div class="col-sm-2 ">
       
        <div class="diary well well-sm"><?php  echo $reasonname;?> </div>	
    </div>
    <div class=" col-sm-1">
        <a href="<?php echo base_url();?>index.php/diaries_c/update_diary?diary_id=<?php echo $diary_id?>" class=" btn btn-success "><span class="glyphicon glyphicon-edit"></span></a>
        <a href="<?php echo base_url();?>index.php/diaries_c/delete_diary?diary_id=<?php echo $diary_id?>" class=" btn btn-danger "><span class="glyphicon glyphicon-trash"></span></a>
    </div>
 	    
	            
     
        <?php
        if(is_array($courses)){
            foreach($courses as $key => $data) {
                $data['key'] = $key;
                echo $this->load->view('diaries_c/course_template_v', $data, true);
            }//foreach
        }//if(is_array($courses))
        ?>   
</li>