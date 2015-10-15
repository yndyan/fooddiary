<li class="list-group-item cm_fake_label" >
    <span class="cm_row_title"> <?php echo $groceryname; ?>  </span>
    <div class=" pull-right">
        <a  href="<?php echo base_url();?>index.php/groceries_c/update_grocery?grocery_id=<?php echo $grocery_id?>" class="btn btn-default ">
            <span class="glyphicon glyphicon-edit"></span> Edit
        </a>
        <a  href="<?php echo base_url();?>index.php/groceries_c/delete_grocery?grocery_id=<?php echo $grocery_id?>" class="confirm_delete btn btn-danger ">
            <span class="glyphicon glyphicon-trash"></span> Delete
        </a>
    <div>
</li> 

    