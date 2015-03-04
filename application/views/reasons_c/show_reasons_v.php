<body>
    <div class="container" >
        <div class="row">
            <h2 class ="text-center"> User reasons </h2>
            <h3 class="text-warning text-center"><?php echo $this->session->flashdata('reason_messages');?></h3>
            <ul class="list-group col-sm-8 col-md-offset-2">
                
                <li class="list-group-item ">
                    <a  href =  "<?php echo base_url("index.php/reasons_c/add_reason");?>" class="btn btn-success col-md-offset-5"> 
                        <h5><span class="glyphicon glyphicon-plus"></span> Add new reason</h5> 
                    </a>
                </li>     
                
            <?php    
                foreach($user_reasons as $data) {
                    echo $this->load->view('reasons_c/reason_template_v', $data, true);
                }//foreach
            ?>
                <ul class="pagination ">
                    <?php  for($i=1;$i<($number_of_pages+1);$i++){  ?>
                            <li><a href="<?php  echo ($i!= $current_page)? base_url("index.php/reasons_c/show_reasons?page=".$i) : '#'; ?>"><?php echo $i;?></a></li>
                    <?php  }//for   ?>   
                 </ul>
             </ul>
        </div>
    </div>
</body>