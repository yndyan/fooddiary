<div class="container" >
        <div class="row">
            <h2 class ="text-center"> User courses </h2>
            <h3 class="text-warning text-center"><?php echo $this->session->flashdata('course_messages');?></h3>
        </div>
             <ul class="list-group col-sm-12">
                
                <li class="list-group-item ">
                    <a  href = "<?= $controler_url?>/show_add_course" class="btn btn-success col-md-offset-5"> 
                        <h5><span class="glyphicon glyphicon-plus"></span> Add new course</h5> 
                    </a>
                </li>     
            <?php
                if($courses){
                    foreach($courses as $tp_data) {
                        $tp_data['controler_url'] = $controler_url;
                        echo $this->load->view('courses_c/course_template_v', $tp_data, true);
                    }//foreach
                }//if

                $pg_data = compact('number_of_pages','current_page');
                echo $this->load->view('templates/pagination_v',$pg_data);
            ?>    
            </ul>
    
        </div>
    </div>
</body>