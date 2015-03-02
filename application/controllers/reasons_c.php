<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reasons_c extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('users_m');
        $this->load->model('users_reasons_m');
        $session_data = $this->session->userdata('logged_in');
        $this->load->view('home_c/header_v',$session_data);

        
    }//construct
    
    function show_reasons(){
        $page_number = isset($_GET['page']) ? $_GET['page'] : 1;
        $items_per_page = 10;
        
        if($this->users_m->check_Login_Status()){
            $data['user_reasons'] =  $this->users_reasons_m->getSinglePageReasons($items_per_page,$page_number);
            $data['number_of_pages'] = $this->users_reasons_m->getReasonsPageCount($items_per_page);
            $data['current_page'] = $page_number;
            $this->load->view('reasons_c/show_reasons_v',$data);
        }//if
        else{
            redirect('Auth_c/login','refresh');
        }//else
    }//show_reasons_old
    
    public function add_reason(){
        
        
        if($this->input->post('new_reason')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('new_reason', 'new reason', 'trim|required|min_length[2]');
            //mydo add unique chack for user reason
            if($this->form_validation->run()==FALSE){
                $this->load->view('reasons_c/add_reason_v');
            } else {
                $new_reason = $this->input->post('new_reason');
                $this->users_reasons_m->addReason($new_reason);
                //mydo add notification that
                $this->session->set_flashdata('reason_messages',"Reason sucessfully added");
                redirect('reasons_c/show_reasons','refresh');
                return;
            }//else
                
        } else {
            $this->load->view('reasons_c/add_reason_v');
        }//else
        
    }//add_reason

    
    
    
    
    public function delete_reason(){
        $reason_id = trim($this->input->get('reason_id',TRUE));
        if($this->users_reasons_m->deleteReason($reason_id)){
            $this->session->set_flashdata('reason_messages',"Reason sucessfully deleted");
            redirect('reasons_c/show_reasons','refresh');
        } else {
            $this->session->set_flashdata('reason_messages',"Error deleting");
            redirect('reasons_c/show_reasons','refresh');
        }
    }//delete_reaosn
    
}//class
