<head>
    <link rel = "stylesheet" href = "<?php echo base_url();?>public/css/fooddiary.css">

</head>
<body>
    <div class ="content">
    <?php    
        foreach($user_reasons as $reason) {
            echo ($reason);
            echo '</br>';
        }//foreach
        echo 'user_reasons';
    ?>
    <?php  for($i=0;$i<$number_of_pages;$i++){ ?>
        <?php if ($i+1 == $current_page) { ?>
            <?php echo $i+1 ?>
        <?php } else { ?>
        <a href="<?php echo base_url()?>index.php/Reasons_c/show_reasons?page=<?php echo $i+1?>"><?php echo $i+1?></a>
        <?php } ?>
    <?php }//for ?>   
        
    </div>
</body>