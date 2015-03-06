<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reasons_c extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('users_m');
        $this->load->model('user_reasons_m');
        $session_data = $this->session->userdata('logged_in');
        if($session_data){
            $this->load->view('home_c/header_v',$session_data);
        }
        
    }//construct
//----------------------------------------------------------------------------

    
    
    
    function show_reasons(){//mydo add sort by name,  usage
        $page_number = ($this->input->get('page')!=null) ? $this->input->get('page') : 1;
        $items_per_page = 5;
        
        if($this->users_m->check_Login_Status()){
            $data['user_reasons'] =  $this->user_reasons_m->getSinglePageReasons($items_per_page,$page_number);
            $data['number_of_pages'] = $this->user_reasons_m->getReasonsPageCount($items_per_page);
            $data['current_page'] = $page_number;
            $this->load->view('reasons_c/show_reasons_v',$data);
        }//if
        else{
            redirect('Auth_c/login','refresh');
        }//else
    }//show_reasons_old
//----------------------------------------------------------------------------
   
    public function add_reason(){
        if($this->input->post('new_reason')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('new_reason', 'new reason', 'trim|required|min_length[2]');
            //mydo add unique chack for user reason
            if($this->form_validation->run()==FALSE){
                $this->load->view('reasons_c/add_reason_v');
            } else {
                $this->user_reasons_m->addReason($this->input->post('new_reason'));
                $this->session->set_flashdata('reason_messages',"Reason sucessfully added");
                redirect('reasons_c/show_reasons','refresh');
                return;
            }//else
                
        } else {
            $this->load->view('reasons_c/add_reason_v');
            return;
        }//else
        
    }//add_reason
//----------------------------------------------------------------------------

    function update_reason(){
        
        if($this->input->post('update_reason')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('update_reason', 'updated reason', 'trim|required|min_length[2]');
            
            if($this->form_validation->run()==FALSE){
                $data['reasonname'] = $this->input->post('update_reason');
                $data['reason_id'] = $this->input->post('reason_id');
                $this->load->view('reasons_c/update_reason_v',$data);
            } else {
                $this->user_reasons_m->updateReason($this->input->post('update_reason'),$this->input->post('reason_id'));
                
                $this->session->set_flashdata('reason_messages',"reason sucessfully updated");
                redirect('reasons_c/show_reasons','refresh');
                return;
            }//else
                
        } else {
            $reason_id = trim($this->input->get('reason_id',TRUE));
            $data_content = 'reasonname';
            $reasonname = $this->user_reasons_m->getOneBySingleValue('reason_id',$reason_id,$data_content)[$data_content];
            if($reasonname) {
                $data['reasonname'] = $reasonname;
                $data['reason_id'] = $reason_id;
                $this->load->view('reasons_c/update_reason_v',$data);
            } else {
                $this->session->set_flashdata('reason_messages',"error finding reason");
                redirect('reasons_c/show_reasons','refresh');
            } 
                
            return;
        }//else
    }//update reason

//----------------------------------------------------------------------------
    
    
    public function delete_reason(){
        $reason_id = trim($this->input->get('reason_id',TRUE));
        if($this->user_reasons_m->deleteReason($reason_id)){
            $this->session->set_flashdata('reason_messages',"Reason successfully deleted");
            redirect('reasons_c/show_reasons','refresh');
        } else {
            $this->session->set_flashdata('reason_messages',"Error deleting reason");
            redirect('reasons_c/show_reasons','refresh');
        }
    }//delete_reaosn
    
}//class
