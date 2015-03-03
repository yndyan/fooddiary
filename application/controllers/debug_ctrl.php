<?php
class debug_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users_reasons_m');
        $this->load->model('groceries_m');
       
        
    }
    
    
   
    
    function reasons(){
        $this->users_reasons_m->copyDefaultReasonsToNewUser();
          
    }//reasons
    
    function groceries(){
                $this->groceries_m->copyDefaultGroceriesToNewUser();

    }//groceries
            
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