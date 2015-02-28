<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diary_c extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_m');
        
        $this->load->model('users_reasons_m');
        $session_data = $this->session->userdata('logged_in');
        $this->load->view('home_c/header_v',$session_data);
    }


    function add_food(){
        if($this->users_m->check_Login_Status())
        {
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
        }
        else
        {
            $this->session->set_flashdata('verify_warning','Please login to proceed!');
            redirect('Auth_c/login','refresh');
        }
    }
    
    function getAutocompleteReasons(){
        $like_value = strtolower($this->input->get('term'));
        $result = $this->users_reasons_m->searchUserReasons($like_value);
        echo json_encode($result);//TODO vrati
        die();
        }
    
}