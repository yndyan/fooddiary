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
        $sg_data = $this->groceries_m->getSinglePageGroceries($page_number); 
        $sg_data['controler_url'] = $this->controler_url;;
        $this->load->view('groceries_c/show_groceries_v',$sg_data);
    }//show_groceries
    
//----------------------------------------------------------------------------    
    function add_grocery(){
        $is_ajax = is_ajax_request();
        if($this->input->post('new_grocery')){
            $this->form_validation->set_rules('new_grocery', 'new grocery', 'trim|required|min_length[2]|FV_CheckGroceryNotExist');
            $form_validated = !($this->form_validation->run()==FALSE);
            if($form_validated){
                $grocery_id = $this->groceries_m->addGrocery($this->input->post('new_grocery'));
                if($is_ajax){
                    $this->output->set_output(json_encode(['success' => true,'grocery_id'=>$grocery_id]));
                } else {
                    $this->session->set_flashdata('grocery_messages',"Grocery sucessfully added");
                    redirect('groceries_c/show_groceries','refresh');
                }
            } else {
                if($is_ajax){
                    $this->output->set_output(json_encode(['success' => false, 'errors'=>$this->form_validation->form_validation_errors()]));
                } else {
                    $this->form_validation->set_error_delimiters('<font color="red">','</font>');
                    $this->load->view('groceries_c/add_grocery_v');
                }//else if($is_ajax
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
    function delete_grocery(){
        $grocery_id = trim($this->input->get('grocery_id',TRUE));
        if($this->groceries_m->deleteGrocery($grocery_id)){
            $this->session->set_flashdata('grocery_messages',"Grocery successfully deleted");
        } else {
            $this->session->set_flashdata('grocery_messages',"Error deleting grocery");
        }
        redirect('groceries_c/show_groceries','refresh');
    }//delete_grocery
//--------------------------------------------------------------------------------------
    function ajaxGetAutocompleteGroceries(){
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->groceries_m->api_searchGroceries($like_value);
        echo json_encode($result);//TODO vrati
        
    }//    function getAutocompleteGroceries(){
//--------------------------------------------------------------------------------------
    function ajaxCheckGroceryExist(){//mydo finish this function
        $groceryname = trim($this->input->post('groceryname',TRUE));
        //var_dump($groceryname); die();//mydo delete this
        $result = $this->groceries_m->checkGroceryExist($groceryname);
        $this->output->set_output(json_encode(['exist' => $result]));
    }//checkGroceryExist
//--------------------------------------------------------------------------------------

}//class