<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groceries_c extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('groceries_m');  
    }//construct
    
//----------------------------------------------------------------------------    
    
    function show_groceries(){
        $page_number = ($this->input->get('page')!=null) ? $this->input->get('page') : 1;
        $data = $this->groceries_m->getSinglePageGroceries($page_number); 
        $this->load->view('groceries_c/show_groceries_v',$data);
    }//show_groceries
    //
//----------------------------------------------------------------------------    
     public function add_grocery(){
        if($this->input->post('new_grocery')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('new_grocery', 'new grocery', 'trim|required|min_length[2]|FV_CheckGroceryNotExist');
            if($this->form_validation->run()==FALSE){
                $this->load->view('groceries_c/add_grocery_v');
            } else {
                $this->groceries_m->addGrocery($this->input->post('new_grocery'));
                $this->session->set_flashdata('grocery_messages',"Grocery sucessfully added");
                redirect('groceries_c/show_groceries','refresh');
                return;
            }//else
        } else {
            $this->load->view('groceries_c/add_grocery_v');
            return;
        }//else
    }//add_grocery
//----------------------------------------------------------------------------    
    function update_grocery(){
        
        $grocery_id = trim($this->input->get('grocery_id',TRUE));
        if($this->input->post('update_groceryname')){ 
                $this->form_validation->set_error_delimiters('<font color="red">','</font>');
                $this->form_validation->set_rules('update_groceryname', 'updated grocery', 'trim|required|min_length[2]');

                if($this->form_validation->run()==FALSE){
                    $data['groceryname'] = $this->input->post('update_groceryname');
                $data['grocery_id'] = $grocery_id;
                    $this->load->view('groceries_c/update_grocery_v',$data);
                } else {
                
                $this->groceries_m->updateGrocery($this->input->post('update_groceryname'),$grocery_id);
                    $this->session->set_flashdata('grocery_messages',"Grocery sucessfully updated");
                    redirect('groceries_c/show_groceries','refresh');
                    return;
                }//else if form_validation->run()==FALSE
  
        } else {
            $data_content = 'groceryname';
            $groceryname = $this->groceries_m->getOneBySingleValue('grocery_id',$grocery_id,$data_content)[$data_content];
            if($groceryname) {
                $data['groceryname'] = $groceryname;
                $data['grocery_id'] = $grocery_id;
                $this->load->view('groceries_c/update_grocery_v',$data);
            } else {
                $this->session->set_flashdata('grocery_messages',"Error finding grocery");
                redirect('groceries_c/show_groceries','refresh');
            } 
                
            return;
        }//else
    }//update grocery
//----------------------------------------------------------------------------    
    public function delete_grocery(){
        $grocery_id = trim($this->input->get('grocery_id',TRUE));
        if($this->groceries_m->deleteGrocery($grocery_id)){
            $this->session->set_flashdata('grocery_messages',"Grocery successfully deleted");
        } else {
            $this->session->set_flashdata('grocery_messages',"Error deleting grocery");
        }
        redirect('groceries_c/show_groceries','refresh');
    }//delete_grocery
    
    
}