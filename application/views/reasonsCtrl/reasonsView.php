<head>
    <link rel = "stylesheet" href = "<?php echo base_url();?>public/css/fooddiary.css">

</head>
<body>
    <div class ="content">
    <?php    
        foreach($reasons as $reason) {
            echo ($reason->reason);
            echo '</br>';
            }
    ?>
    </div>
</body>