<li class="list-group-item "  id = "grocery_id<?php echo $grocery_id?>">
       
<?php 
    echo $groceryname;
?>  
    
    <div class=" pull-right">
        <a  href="<?php echo base_url();?>index.php/groceries_c/update_grocery?grocery_id=<?php echo $grocery_id?>" class="btn btn-default "><span class="glyphicon glyphicon-edit"></span></a>
        <a  href="<?php echo base_url();?>index.php/groceries_c/delete_grocery?grocery_id=<?php echo $grocery_id?>" class="btn btn-danger "><span class="glyphicon glyphicon-remove"></span></a>
    <div>
</li> 

    