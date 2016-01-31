<?php

class MY_Controller extends CI_Controller{
    
    protected $template_name = 'user_header_v';
    protected $controler_url  = '';    

    function __construct() {
        parent::__construct();
        $this->load->model('users_m');
        $this->load->helper('misc');  
        $controler_name = $this->router->fetch_class();
        $this->controler_url = site_url($controler_name);
        if($this->users_m->check_Login_Status()){
            $session_data = $this->session->userdata('logged_in');
            if(!is_ajax_request()){
                $this->load->view('templates/'.$this->template_name,$session_data);
            }
        } else {
            if(!is_ajax_request()){
                $this->session->set_flashdata('verify_warning','Please login to proceed!');
                redirect('auth_c/login','refresh');
            } else {
                $this->output->set_output(json_encode(['error' => 'not logged'] ));
                
            }
            
        }//else 
    }//construct
}