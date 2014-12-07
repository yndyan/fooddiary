<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Auth_ctrl extends CI_Controller
//{
//    function __construct()
//    {
//        parent::__construct();
//        $this->load->helper('registration');
 //       $this->load->model('users','',TRUE);
//        $this->load->view('authCtrl/authViewHeader');
 //   }

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



        $this->food_types->tabela();

    }


}