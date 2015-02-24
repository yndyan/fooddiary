<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reasons_c extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('users');
        $this->load->model('users_reasons');
        $this->load->library('table');
        $this->load->library('pagination');
        
        
        $session_data = $this->session->userdata('logged_in');
        $this->load->view('homeCtrl/homeViewHeader',$session_data);

        
    }//construct
    
    function show_reasons_old(){
        $page_number = isset($_GET['page']) ? $_GET['page'] : 1;
        $items_per_page = 5;
        if($this->users->check_Login_Status()){
            $data['user_reasons'] =  $this->users_reasons->getAllUserReasons($items_per_page,$page_number);
            //$data['number_of_pages'] = $this->users_reasons->getReasonsPageCount($items_per_page);
            //$data['current_page'] = $page_number;
       echo $this->table->generate($data); die(); //MYTODO brisi
            $this->load->view('reasonsCtrl/reasonsView',$data);
        }//if
        else{
            
            redirect('Auth_c/login','refresh');
        }//else
        
            
    }//show_reasons_old
    
    function show_reasons(){
        
    }//show_reasons
    
    
}//class
