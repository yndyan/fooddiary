<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_c extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_m');
    }

    function index()
    {
        $session_data = $this->session->userdata('logged_in');
        if($session_data)
        {
            $this->load->view('home_c/header_v',$session_data);
            //$this->output->enable_profiler(TRUE);
        }
        else
        {
            redirect('Auth_c/login','refresh');
        }
    }
}