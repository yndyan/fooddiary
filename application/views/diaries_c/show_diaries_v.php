<head>
    
    <script src="<?php echo base_url();?>public/js/jquery-ui-timepicker-addon.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui-timepicker-addon.css">
    <script src="<?php echo base_url(); ?>public/js/show_diaries.js"></script>
</head>
<body>
<?php $base_url_index = base_url("index.php"); ?>   
<div class="container" >
        <div class="row">
            <h3 class="text-warning text-center"><?php echo $this->session->flashdata('diary_messages');?></h3>
        </div>
        <ul class="list-group ">        
     <li class="list-group-item clearfix">
    <div class="btn-toolbar " role="toolbar" aria-label="...">
            
            <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default">
                    <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                 </a>
                    
                </button>
            </div>
            <div class="btn-group" role="group" aria-label="...">
<?php foreach ($day_dates as $day => $date) { ?>
        <button type="button" class="btn btn-default">
            <a href="<?php echo $base_url_index.'/diaries_c/show_diaries?date='.$date;?>"> 
             <?php 

             echo $day." ".date("d/m", strtotime($date));;

             ?>  
             </a> 
        </button>    
<?php }?>
            </div>
        <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default">
        <span aria-hidden="true">&raquo;</span>
      </a></button>
            </div>
        <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default"><a href="<?php echo $base_url_index?>/diaries_c/show_diaries?date=<?php echo date('Y-m-d');?>" >Today </a></button>
            </div>
                <div class="col-sm-3">
                    <input id="datepicker" class="picker form-control" type="text" name="date" placeholder="Enter date dd-mm-yyyy">
                </div>
            </div>
 
            </li> 
                <li class="list-group-item clearfix cm_fake_label">
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
                        //var_dump($data);
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