<?php

class MY_Controller extends CI_Controller{
    
    protected $template_name = 'user_header_v';
            
    function __construct() {
        parent::__construct();
        $this->load->model('users_m');
        
        if($this->users_m->check_Login_Status()){
            $session_data = $this->session->userdata('logged_in');
            if($this->uri->segment(1)!=='api_c'){
                $this->load->view('templates/'.$this->template_name,$session_data);
            }
        } else {
            if($this->uri->segment(1)!=='api_c'){
                $this->session->set_flashdata('verify_warning','Please login to proceed!');
                redirect('Auth_c/login','refresh');
            } else {
                $this->output->set_output(json_encode(['error' => 'not logged'] ));
                
            }
            
        }//else 
    }//construct
}