<?php
$grocery_template = <<<EOD
<li class="list-group-item cm_fake_label" >
    <span class="cm_row_title"> 
    	{$groceryname} 
	</span>
    <div class=" pull-right">
        <a  href="{$controler_url}/update_grocery?grocery_id={$grocery_id}" class="btn btn-default ">
            <span class="glyphicon glyphicon-edit"></span> 
            Edit
        </a>
        <a  href="{$controler_url}/delete_grocery?grocery_id={$grocery_id}" class="confirm_delete btn btn-danger ">
            <span class="glyphicon glyphicon-trash"></span> 
            Delete
        </a>
    <div>
</li> 
EOD;
echo $grocery_template;
    