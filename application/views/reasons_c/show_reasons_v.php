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
            <?php 
                $data['action_url']= ("index.php/reasons_c/show_reasons");
                $data['number_of_pages']= $number_of_pages;
                $data['current_page']= $current_page;
                echo $this->load->view('help/pagination_v',$data);
            ?>    
            </ul>
        </div>
    </div>
