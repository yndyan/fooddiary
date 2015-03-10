<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses_c extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('users_m');
        $this->load->model('courses_m');
        $session_data = $this->session->userdata('logged_in');
        if($session_data){
            $this->load->view('home_c/header_v',$session_data);
        }
    }
    
    function show_courses(){
        
        $page_number = ($this->input->get('page')!=null) ? $this->input->get('page') : 1;
        $items_per_page = 5;
        
        if($this->users_m->check_Login_Status()){
            $data['courses'] =  $this->courses_m->getSinglePageCourses($items_per_page,$page_number);
            $data['number_of_pages'] = $this->courses_m->getPageCount($items_per_page);
            $data['current_page'] = $page_number;
            $this->load->view('courses_c/show_courses_v',$data);
        }//if
        else{
            redirect('Auth_c/login','refresh');
        }//else
        
        //get courses
        //send as data
        
    }//show_courses
    
    function show_add_course(){
        $this->load->view('courses_c/add_course_v');
    }//add_course

}