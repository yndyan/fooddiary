<?php
class debug_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        
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
    function del(){
    }
    
    function help(){

    }//help


}