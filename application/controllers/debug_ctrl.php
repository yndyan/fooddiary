<?php
class debug_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users_reasons_m');
       
        
    }
    
    
   
    
    function help(){
        $this->users_reasons_m->copyDefaultReasonsToNewUser();
          
    }//help

    
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