<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses_c extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('users_m');
        $session_data = $this->session->userdata('logged_in');
        if($session_data){
            $this->load->view('home_c/header_v',$session_data);
        }
    }
    
    function show_courses(){
        $this->load->view('courses_c/show_courses_v');
    }//show_courses
    
    function add_course(){
        $coursename = $this->input->post('coursename');
        if($coursename){
            //form validation for input
            $coursedescription = $this->input->post('coursedescription');
            $calories = $this->input->post('calories');
            $groceries = $this->input->post('groceries');
            $quantity = $this->input->post('quantity');
            //$this->user_courses_m->insert();
           //spakovati u bazu
            
            
            
        }  else {
            $this->load->view('courses_c/add_course_v');
        }
    }//add_course

}