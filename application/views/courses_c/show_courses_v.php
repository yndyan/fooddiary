<body>
    <div class="container" >
        <div class="row">
            <h2 class ="text-center"> User courses </h2>
            <h3 class="text-warning text-center"><?php echo $this->session->flashdata('course_messages');?></h3>
            <ul class="list-group col-sm-8 col-md-offset-2">
                
                <li class="list-group-item ">
                    <a  href =  "<?php echo base_url("index.php/courses_c/show_add_course");?>" class="btn btn-success col-md-offset-5"> 
                        <h5><span class="glyphicon glyphicon-plus"></span> Add new course</h5> 
                    </a>
                </li>     
                <?php
                //var_dump($courses);
                foreach ($courses as $key => $data){
                    //var_dump($data);
                    echo $this->load->view('courses_c/course_template_v', $data, true);
                }
                ?>
                <?php 
                $data['action_url']= ("index.php/courses_c/show_courses");
                $data['number_of_pages']= $number_of_pages;
                $data['current_page']= $current_page;
                echo $this->load->view('help/pagination_v',$data);
                ?>
             </ul>
        </div>
    </div>
</body>