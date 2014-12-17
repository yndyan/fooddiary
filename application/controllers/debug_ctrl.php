<?php
class debug_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users','',TRUE);
        $this->load->model('food_types','',TRUE);
        $this->load->model('meals_diary','',TRUE);
        
    }
    function index()
    {
          echo "ola";  
         //$this->load->view('debugCtrl/debug_view');   

       

    }


}