<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_c extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('user_reasons_m');
        $this->load->model('user_groceries_m');
        $this->load->model('courses_m');
        $this->load->model('user_groceries_m');
    }//__construct
            
    function getAutocompleteReasons(){
        //check login status
        //mydo add form validatio
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->user_reasons_m->api_searchReasons($like_value);
        echo json_encode($result);//TODO vrati
        
    }//getAutocompleteReasons
    
    function getAutocompleteGroceries(){
        //check login status
        //mydo add form validatio
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->user_groceries_m->api_searchGroceries($like_value);
        echo json_encode($result);//TODO vrati
        
    }//    function getAutocompleteGroceries(){

    
    function addCourse(){
        $this->form_validation->set_rules('coursename', 'course name','xss_clean|trim|required|min_length[2]');//mydo add unique, |is_unique[courses.coursename] not working
        $this->form_validation->set_rules('coursedescription', 'description','xss_clean|trim');
        
        for($i = 0; $i< sizeof($this->input->post('groceries'));$i++){
            $this->form_validation->set_rules("groceries[".$i."]", 'groceries','xss_clean|checkGroceryExist');//mydo add chech grocery tabe
        }//for 
        
        $this->form_validation->set_rules('quantity[]', 'quantity','xss_clean|trim');//mydo add chech grocery tabe
        $this->form_validation->set_rules('calories', 'calories','xss_clean|trim');
        if($this->form_validation->run() == FALSE ){
             $this->output->set_output(json_encode(['success' => false, 'errors'=>$this->form_validation->form_validation_errors()]));
        } else {
            $course_data = ['coursename' => ucfirst($this->input->post('coursename')),
                     'coursedescription'=>$this->input->post('coursedescription'),
                     'calories' =>$this->input->post('calories')
                    ];
            $groceries_array = $this->input->post('groceries');
            $quantity_array = $this->input->post('quantity');
            
            $course_id = $this->courses_m->add_course($course_data,$groceries_array,$quantity_array);
            $this->session->set_flashdata('course_messages',"Course sucessfully added");
            $this->output->set_output(json_encode(['success' => true,'course_id'=>$course_id]));
            
        }

    }//addCourse
    
    

    
    function addGrocery(){
            $this->form_validation->set_rules('groceryname', 'new grocery', 'trim|required|min_length[2]');
            if($this->form_validation->run()==FALSE){
                $this->output->set_output(json_encode(['success' => false, 'errors'=>$this->form_validation->form_validation_errors()]));
            } else {
              $grocery_id = $this->user_groceries_m->addGrocery($this->input->post('grocery')); //mydo return 
                $this->output->set_output(json_encode(['success' => true,'grocery_id'=>$grocery_id]));
                return;
            }//else
    }//addGrocery
    
    
    function getCourseData(){
        $course_id = trim($this->input->post('course_id',TRUE));
        if($course_id){
        $data = $this->courses_m->getSingleCourse($course_id);
        //var_dump($data); //mydo delete this
        $data['success'] = true;
        $this->output->set_output(json_encode($data));
        } else { 
        $this->output->set_output(json_encode(['success' => false]));
        }
    }//getExpandedCourse
    
    function deleteGroceryFromCourse(){
        $course_grocery_id = trim($this->input->post('course_grocery_id',TRUE));
        if($course_grocery_id){
            if($this->courses_m->deleteSingleGroceryFromCourse($course_grocery_id)){
                $this->output->set_output(json_encode(['success' => true]));
            } else {
                $this->output->set_output(json_encode(['success' => false]));
            }//if
        }//if $course_grocery_id
    }//deleteGroceryFromCourse
    
    function checkGroceryExist(){//mydo finish this function
        $groceryname = trim($this->input->post('groceryname',TRUE));
        
        //var_dump($groceryname); die();//mydo delete this
        $result = $this->user_groceries_m->checkGroceryExist($groceryname);
        $this->output->set_output(json_encode(['exist' => $result]));
    }//checkGroceryExist
    

    function addGroceryToCourse(){
        $groceryname = trim($this->input->post('groceryname',TRUE));
        $course_id = trim($this->input->post('course_id',TRUE));
        $quantity = trim($this->input->post('quantity',TRUE));
        
        var_dump($course_id);
    }//addGroceryToCourse
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}//class

