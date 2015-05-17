<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groceries_c extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('user_groceries_m');  
    }//construct
    
//----------------------------------------------------------------------------    
    
    function show_groceries(){
       
        $page_number = ($this->input->get('page')!=null) ? $this->input->get('page') : 1;
        $items_per_page = 5;
        $data_content = 'groceryname,grocery_id'; 
        $data['user_groceries'] =  $this->user_groceries_m->getSinglePageData($items_per_page,$page_number,$data_content);
        $data['number_of_pages'] = $this->user_groceries_m->getPageCount($items_per_page);
        $data['current_page'] = $page_number;
        $this->load->view('groceries_c/show_groceries_v',$data);
        
    }//show_groceries
    //
//----------------------------------------------------------------------------    
     public function add_grocery(){
        if($this->input->post('new_grocery')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('new_grocery', 'new grocery', 'trim|required|min_length[2]');//mydo add unique chack for user grocery, is_unigue not useable
            if($this->form_validation->run()==FALSE){
                $this->load->view('groceries_c/add_grocery_v');
            } else {
                $this->user_groceries_m->addGrocery($this->input->post('new_grocery'));
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
        
        if($this->input->post('update_groceryname')){//bug, on submit empty input doesn't respond requred
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('update_groceryname', 'updated grocery', 'trim|required|min_length[2]|is_unique[user_groceries.groceryname]');
            
            if($this->form_validation->run()==FALSE){
                $data['groceryname'] = $this->input->post('update_groceryname');
                $data['grocery_id'] = $this->input->post('grocery_id');
                $this->load->view('groceries_c/update_grocery_v',$data);
            } else {
                $this->user_groceries_m->updateGrocery($this->input->post('update_groceryname'),$this->input->post('grocery_id'));
                $this->session->set_flashdata('grocery_messages',"Grocery sucessfully updated");
                redirect('groceries_c/show_groceries','refresh');
                return;
            }//else
                
        } else {
            $grocery_id = trim($this->input->get('grocery_id',TRUE));
            $data_content = 'groceryname';
            $groceryname = $this->user_groceries_m->getOneBySingleValue('grocery_id',$grocery_id,$data_content)[$data_content];
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
        if($this->user_groceries_m->deleteGrocery($grocery_id)){
            $this->session->set_flashdata('grocery_messages',"Grocery successfully deleted");
            redirect('groceries_c/show_groceries','refresh');
        } else {
            $this->session->set_flashdata('grocery_messages',"Error deleting grocery");
            redirect('groceries_c/show_groceries','refresh');
        }
    }//delete_grocery
    
    
}