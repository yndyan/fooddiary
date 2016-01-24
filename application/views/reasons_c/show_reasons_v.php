<div class="container" >
    <div class="row">
        <h2 class ="text-center"> User reasons </h2>
        <h3 class="text-warning text-center"><?php echo $this->session->flashdata('reason_messages');?></h3>
        <ul class="list-group col-sm-8 col-md-offset-2">
            
            <li class="list-group-item ">
                <a  href =  "<?= $controler_url?>/add_reason" class="btn btn-success col-md-offset-5"> 
                    <h5><span class="glyphicon glyphicon-plus"></span> Add new reason</h5> 
                </a>
            </li>     
            
        <?php    
            foreach($reasons as $tp_data) {
                $tp_data['controler_url'] = $controler_url;
                echo $this->load->view('reasons_c/reason_template_v', $tp_data, true);
            }//foreach
   
            $pg_data = compact('number_of_pages','current_page');
            echo $this->load->view('templates/pagination_v',$pg_data);
        ?>    
        </ul>
    </div>
</div>
