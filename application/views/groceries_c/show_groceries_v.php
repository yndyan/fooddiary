<body>
    <div class="container" >
        <div class="row">
            <h2 class ="text-center"> User groceries </h2>
            <h3 class ="text-warning text-center"><?php echo $this->session->flashdata('grocery_messages');?></h3>
            <ul class ="list-group col-sm-8 col-md-offset-2">
                
                <li class="list-group-item ">
                    <a  href =  "<?php echo base_url("index.php/groceries_c/add_grocery");?>" class="btn btn-success col-md-offset-5"> 
                        <h5><span class="glyphicon glyphicon-plus"></span> Add new grocery</h5> 
                    </a>
                </li>     
                
            <?php    
                foreach($user_groceries as $data) {
                    echo $this->load->view('groceries_c/grocery_template_v', $data, true);
                }//foreach
            ?>
            <?php 
                $data['action_url']= ("index.php/groceries_c/show_groceries");
                $data['number_of_pages']= $number_of_pages;
                $data['current_page']= $current_page;
                echo $this->load->view('help/pagination_v',$data);
            ?>
             </ul>
        </div>
    </div>
</body>