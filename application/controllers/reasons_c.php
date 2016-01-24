<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reasons_c extends MY_Controller
{
    //private $controler_name = '';
    private $controler_url  = '';
    function __construct(){
        parent::__construct();
        $this->load->model('reasons_m');
        $controler_name = $this->router->fetch_class();
        $this->controler_url = site_url($controler_name);
      
    }//construct
//----------------------------------------------------------------------------
    
    
    
    function show_reasons(){//mydo add sort by name,  usage
        $page_number = ($this->input->get('page')!=null) ? $this->input->get('page') : 1;
        $items_per_page = ($this->input->get('items_per_page')!=null) ? $this->input->get('items_per_page') : 5;
        $sr_data = $this->reasons_m->getSinglePageReasons($page_number,$items_per_page); 
        $sr_data['controler_url'] = $this->controler_url;;
        $this->load->view('reasons_c/show_reasons_v',$sr_data);
        
    }//show_reasons_old
//----------------------------------------------------------------------------
   
    public function add_reason(){
        if($this->input->post('new_reason')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('new_reason', 'new reason', 'trim|required|min_length[2]|FV_CheckReasonNotExist');
            if($this->form_validation->run()==FALSE){
                $this->load->view('reasons_c/add_reason_v');
            } else {
                $this->reasons_m->addReason($this->input->post('new_reason'));
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
        $reason_id = trim($this->input->get('reason_id',TRUE));

        if($this->input->post('update_reason')){ 
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('update_reason', 'updated reason', 'trim|required|min_length[2]|FV_CheckReasonNotExist');

                if($this->form_validation->run()==FALSE){
                    $data['reasonname'] = $this->input->post('update_reason');
                    $data['reason_id'] = $reason_id;
                    $this->load->view('reasons_c/update_reason_v',$data);
                } else {
                    $this->reasons_m->updateReason($this->input->post('update_reason'),$reason_id);
                    $this->session->set_flashdata('reason_messages',"Reason successfully updated");
                    redirect('reasons_c/show_reasons','refresh');
                    return;
                }//else form_validation->run()==FALSE
        } else {
            $data_content = 'reasonname';
            $reasonname = $this->reasons_m->getOneBySingleValue('reason_id',$reason_id,$data_content)[$data_content];
            if($reasonname) {
                $data['reasonname'] = $reasonname;
                $data['reason_id'] = $reason_id;
                $this->load->view('reasons_c/update_reason_v',$data);
            } else {
                $this->session->set_flashdata('reason_messages',"Error finding reason");
                redirect('reasons_c/show_reasons','refresh');
            } 
                
            return;
        }//else
    }//update reason

//----------------------------------------------------------------------------
    
    
    public function delete_reason(){
        $reason_id = trim($this->input->get('reason_id',TRUE));
        $this->reasons_m->deleteReason($reason_id) ? $this->session->set_flashdata('reason_messages',"Reason successfully deleted")
                                                   : $this->session->set_flashdata('reason_messages',"Error deleting reason");
        redirect('reasons_c/show_reasons','refresh');
    }//delete_reason
//----------------------------------------------------------------------------
    
    
}//class
