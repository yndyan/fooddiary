<?php
class debug_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_reasons_m');
        $this->load->model('user_groceries_m');
    }
    
    function index(){
        //$this->output->enable_profiler(TRUE);
        echo $this->user_groceries_m->getTableName();
        echo $this->user_groceries_m->getTableName();
    }
    
   
    
    function copy_default_tables(){
        $this->user_reasons_m->copyDefaultReasonsToNewUser();
        $this->user_groceries_m->copyDefaultGroceriesToNewUser();
    }//reasons
    
 
            
    function migration()//mydo delete this later
    {
    $this->load->library('migration');
		if (! $this->migration->latest()) {
			show_error($this->migration->error_string());
		}
		else {
			echo 'Migration worked!';
		}
       

    }

}