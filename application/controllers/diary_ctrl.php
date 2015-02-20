<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diary_ctrl extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users');
        $this->load->model('meals_diary');
        $this->load->model('users_reasons');
        $session_data = $this->session->userdata('logged_in');
        $this->load->view('homeCtrl/homeViewHeader',$session_data);
    }


    function add_food(){
        if($this->users->check_Login_Status())
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
                
                $this->load->view('diaryCtrl/addFoodView');
            }
        }
        else
        {
            $this->session->set_flashdata('verify_warning','Please login to proceed!');
            redirect('auth_ctrl/login','refresh');
        }
    }
    
    function getAutocompleteReasons(){
        $like_value = strtolower($this->input->get('term'));
        $result = $this->users_reasons->searchUserReasons($like_value);
        echo json_encode($result);//TODO vrati
        die();
        }
    
}