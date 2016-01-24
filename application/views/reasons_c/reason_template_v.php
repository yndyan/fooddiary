<?php
$reason_template = <<<EOD
	<li class="list-group-item cm_fake_label">
	    <span class="cm_row_title"> {$reasonname}</span>  
	    <div class="pull-right">
	        <a href = "{$controler_url}/update_reason?reason_id={$reason_id}" class="btn btn-default ">
	        	<span class="glyphicon glyphicon-edit"></span> 
	        	Edit
        	</a>
	        <a href = "{$controler_url}/delete_reason?reason_id={$reason_id}" class="confirm_delete btn btn-danger ">
	        	<span class="glyphicon glyphicon-trash"></span> 
	        	Delete
	        </a>
	    <div>
	</li> 
EOD;
echo $reason_template;



    
