<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_c extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users');
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
            redirect('Auth_c/login','refresh');
        }

    }


}