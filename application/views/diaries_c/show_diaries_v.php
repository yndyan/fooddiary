<div class="container" >
        <div class="row">
            <h3 class="text-warning text-center"><?php echo $this->session->flashdata('diary_messages');?></h3>
        </div>
             <ul class="list-group ">
                
                <li class="list-group-item clearfix">
                    <span >User diaries </span>
                    <a  href =  "<?php echo base_url("index.php/diaries_c/show_add_diary");?>" class="btn btn-success col-md-offset-5 pull-right"> 
                        <h5><span class="glyphicon glyphicon-plus"></span> Add new diary</h5> 
                    </a>
                </li>     
                <li class="list-group-item clearfix cm_fake_label">
                
                    <div class="col-sm-1">
                        Time <span class="glyphicon glyphicon-time"></span>
                    </div>

                    <div class="col-sm-2 "> 
                        Reason <span class="glyphicon glyphicon-question-sign"></span>
                    </div>

                    <div class="col-sm-5 col-md-offset-1">
                     Course name <span class="glyphicon glyphicon-list"></span>
                     </div>

                    <div class="col-sm-2 ">
                     Quantity <span class = "glyphicon glyphicon-scale"></span>
                    </div>
                 
                </li>
            <?php
                if($diaries){
                    foreach($diaries as $data) {
                        echo $this->load->view('diaries_c/diary_template_v', $data, true);
                    }//foreach
                }//if
            ?>
            <?php 
                $data['action_url']= ("index.php/Diaries_c/show_diaries");
                $data['number_of_pages']= $number_of_pages;
                $data['current_page']= $current_page;
                echo $this->load->view('templates/pagination_v',$data);
            ?>    
            </ul>
    
        </div>
    </div>
</body>