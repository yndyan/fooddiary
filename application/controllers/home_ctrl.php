<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_ctrl extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users','',TRUE);

    }

    function index()
    {

        $session_data = $this->session->userdata('logged_in');

        if($session_data)
        {

            $this->load->view('homeCtrl/homeViewHeader',$session_data);
        }
        else
        {
            redirect('auth_ctrl/login','refresh');
        }

    }


}