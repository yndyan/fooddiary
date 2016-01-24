<body>
<div class="container" >
        <div class="row">
            <h2 class ="text-center"> User courses </h2>
            <h3 class="text-warning text-center"><?php echo $this->session->flashdata('course_messages');?></h3>
        </div>
             <ul class="list-group col-sm-12">
                
                <li class="list-group-item ">
                    <a  href =  "<?php echo base_url("index.php/courses_c/show_add_course");?>" class="btn btn-success col-md-offset-5"> 
                        <h5><span class="glyphicon glyphicon-plus"></span> Add new course</h5> 
                    </a>
                </li>     
                
            <?php
                if($courses){
                    foreach($courses as $data) {
                        echo $this->load->view('courses_c/course_template_v', $data, true);
                    }//foreach
                }//if
            ?>
            <?php 
                $data['action_url']= ("index.php/Courses_c/show_courses");
                $data['number_of_pages']= $number_of_pages;
                $data['current_page']= $current_page;
                echo $this->load->view('templates/pagination_v',$data);
            ?>    
            </ul>
    
        </div>
    </div>
</body>