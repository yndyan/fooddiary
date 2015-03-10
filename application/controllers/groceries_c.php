<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groceries_c extends CI_Controller
{
    
    function __construct(){
        parent::__construct();
        $this->load->model('users_m');
        $this->load->model('user_groceries_m');
        $session_data = $this->session->userdata('logged_in');
        if($session_data){
            $this->load->view('home_c/header_v',$session_data);
        }
        
    }//construct
    function show_groceries(){
        
        $page_number = ($this->input->get('page')!=null) ? $this->input->get('page') : 1;
        $items_per_page = 5;
        
        if($this->users_m->check_Login_Status()){
            $data['user_groceries'] =  $this->user_groceries_m->getSinglePageGroceries($items_per_page,$page_number);
            $data['number_of_pages'] = $this->user_groceries_m->getPageCount($items_per_page);
            $data['current_page'] = $page_number;
            $this->load->view('groceries_c/show_groceries_v',$data);
        }//if
        else{
            redirect('Auth_c/login','refresh');
        }//else
    }//show_groceries_old
     public function add_grocery(){
        if($this->input->post('new_grocery')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('new_grocery', 'new grocery', 'trim|required|min_length[2]');
            //mydo add unique chack for user grocery
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
    
    function update_grocery(){
        
        if($this->input->post('update_grocery')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('update_grocery', 'updated grocery', 'trim|required|min_length[2]');
            
            if($this->form_validation->run()==FALSE){
                $data['groceryname'] = $this->input->post('update_grocery');
                $data['grocery_id'] = $this->input->post('grocery_id');
                $this->load->view('groceries_c/update_grocery_v',$data);
            } else {
                $this->user_groceries_m->updateGrocery($this->input->post('update_grocery'),$this->input->post('grocery_id'));
                
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