<div class="container" >
    <div class="row">
        <h2 class ="text-center"> User groceries </h2>
        <h3 class ="text-warning text-center">
            <?php echo $this->session->flashdata('grocery_messages');?> 
        </h3>
        <ul class ="list-group col-sm-8 col-md-offset-2">
            
            <li class="list-group-item ">
                <a  href =  "<?=$controler_url?>/add_grocery" class="btn btn-success col-md-offset-5"> 
                    <h5>
                        <span class="glyphicon glyphicon-plus"></span> 
                        Add new grocery
                    </h5> 
                </a>
            </li>     
            
        <?php    
            foreach($user_groceries as $tp_data) {
                $tp_data['controler_url'] = $controler_url;
                echo $this->load->view('groceries_c/grocery_template_v', $tp_data, true);
            }//foreach

            $pg_data = compact('number_of_pages','current_page');
            echo $this->load->view('templates/pagination_v',$pg_data);
        ?>
         </ul>
    </div>
</div>
