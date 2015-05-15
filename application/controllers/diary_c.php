<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diary_c extends MY_Controller
{

    function __construct(){
        parent::__construct();
    }
    function index(){
        //this is main page, it would be changed to add
    }
//------------------------------------------------------------------------------

    function add_food(){//mydo not working 
        
            if($this->input->post('date'))
            {
                echo ($this->input->post('date'));
                echo '</br>';
                echo ($this->input->post('time'));
                echo '</br>';
                $in = ($this->input->post('food_input'));\
                var_dump($in);
            }
            else
            {
                
                $this->load->view('diary_c/addfood_v');
            }
        
    }//add food
    
    
    
}