<?php
class debug_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_reasons');
        $this->load->model('default_reasons_m');
        
    }
    function index()//mydo delete this later
    {
    $this->load->library('migration');
		if (! $this->migration->latest()) {
			show_error($this->migration->error_string());
		}
		else {
			echo 'Migration worked!';
		}
       

    }
   
    
    function help(){

    }//help


}