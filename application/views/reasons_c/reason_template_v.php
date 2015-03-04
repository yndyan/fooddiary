<li class="list-group-item "  id = "reason_id_<?php echo $reason_id?>">
       
<?php 
    echo $reasonname;
?>  
    
    <div class=" pull-right">
        <a  href="<?php echo base_url();?>index.php/reasons_c/update_reason?reason_id=<?php echo $reason_id?>" class="btn btn-default "><span class="glyphicon glyphicon-edit"></span></a>
        <a  href="<?php echo base_url();?>index.php/reasons_c/delete_reason?reason_id=<?php echo $reason_id?>" class="btn btn-danger "><span class="glyphicon glyphicon-remove"></span></a>
    <div>
</li> 

    
