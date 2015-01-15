<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reasons_ctrl extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('users','',TRUE);
        $this->load->model('intake_reasons','',TRUE);
        $session_data = $this->session->userdata('logged_in');
        $this->load->view('homeCtrl/homeViewHeader',$session_data);

        
    }//construct
    
    function show_reasons(){
        if($this->users->check_Login_Status()){
            
            $data['reasons'] = $this->intake_reasons->getAllUserReasons();
            //var_dump($result);
            //die();
            
            
            
            $this->load->view('reasonsCtrl/reasonsView',$data);
        }//if
        else{
            
            redirect('auth_ctrl/login','refresh');
        }//else
        
            
    }//show_reasons
    
    function add_common_reasons(){
        
        
    }//add_common_reasons
    
    
}//class
