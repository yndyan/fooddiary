<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diary_ctrl extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('userModel','',TRUE);
        $this->load->model('diaryModel','',TRUE);

    }


function add_food()
{
    if($this->userModel->check_Login_Status())
    {
        if($this->input->post('foodname'))
        {
            echo ($this->input->post('date'));
            echo '</br>';
            echo ($this->input->post('time'));

        }
        else
        {
            $session_data = $this->session->userdata('logged_in');
            $this->load->view('homeCtrl/homeViewHeader',$session_data);
            $this->load->view('diaryCtrl/addFoodView2');
        }

    }
    else
    {
        $this->session->set_flashdata('verify_warning','Please login to proceed!');
        redirect('auth_ctrl/login','refresh');
    }
}
}