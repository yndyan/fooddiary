<body>
<div class="container" >
        <div class="row">
            <h2 class ="text-center"> User diaries</h2>
            <h3 class="text-warning text-center"><?php echo $this->session->flashdata('diary_messages');?></h3>
        </div>
             <ul class="list-group col-sm-12">
                
                <li class="list-group-item ">
                    <a  href =  "<?php echo base_url("index.php/diaries_c/show_add_diary");?>" class="btn btn-success col-md-offset-5"> 
                        <h5><span class="glyphicon glyphicon-plus"></span> Add new diary</h5> 
                    </a>
                </li>     
                
            <?php
                if($diaries){
                    foreach($diaries as $data) {
                        echo $this->load->view('diaries_c/diary_template_v', $data, true);
                    }//foreach
                }//if
            ?>
            <?php 
                $data['action_url']= ("index.php/diaries_c/show_diaries");
                $data['number_of_pages']= $number_of_pages;
                $data['current_page']= $current_page;
                echo $this->load->view('templates/pagination_v',$data);
            ?>    
            </ul>
    
        </div>
    </div>
</body>