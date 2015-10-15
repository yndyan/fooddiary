<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_c extends MY_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('reasons_m');
        $this->load->model('groceries_m');
        $this->load->model('courses_m');
        $this->load->model('groceries_m');
        $this->load->model('diary_m');
    }//__construct
            
    function getAutocompleteReasons(){
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->reasons_m->api_searchReasons($like_value);
        echo json_encode($result);//TODO vrati
        
    }//getAutocompleteReasons
    
    function getAutocompleteGroceries(){
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->groceries_m->api_searchGroceries($like_value);
        echo json_encode($result);//TODO vrati
        
    }//    function getAutocompleteGroceries(){
    
    function getAutocompleteCourses(){
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->courses_m->api_searchCourses($like_value);
        echo json_encode($result);//TODO vrati
    }//    function getAutocompleteCourses(){

    
    function addCourse(){
        $this->form_validation->set_rules('coursename', 'course name','xss_clean|trim|required|min_length[2]|FV_CheckCourseNotExist');
        $this->form_validation->set_rules('coursedescription', 'description','xss_clean|trim');
        
        for($i = 0; $i< sizeof($this->input->post('groceries'));$i++){
            $this->form_validation->set_rules("groceries[".$i."]", 'groceries','xss_clean');
        }//for 
        
        $this->form_validation->set_rules('quantity[]', 'quantity','xss_clean|trim');//mydo add chech grocery tabe
        $this->form_validation->set_rules('calories', 'calories','xss_clean|trim|integer');
        if($this->form_validation->run() == FALSE ){
             $this->output->set_output(json_encode(['success' => false, 'errors'=>$this->form_validation->form_validation_errors()]));
        } else {
            $course_data =  ['coursename' => $this->input->post('coursename'),
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
            $this->form_validation->set_rules('groceryname', 'new grocery', 'trim|required|min_length[2]|FV_CheckGroceryNotExist');
            if($this->form_validation->run()==FALSE){
                $this->output->set_output(json_encode(['success' => false, 'errors'=>$this->form_validation->form_validation_errors()]));
            } else {
                $grocery_id = $this->groceries_m->addGrocery($this->input->post('groceryname')); //mydo return 
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
        $result = $this->groceries_m->checkGroceryExist($groceryname);
        $this->output->set_output(json_encode(['exist' => $result]));
    }//checkGroceryExist
    
    function checkCourseExist(){//mydo finish this function
        $coursename = trim($this->input->post('coursename',TRUE));
        //var_dump($coursename); die();//mydo delete this
        $result = $this->courses_m->checkCourseExist($coursename);
        $this->output->set_output(json_encode(['exist' => $result]));
    }//checkGroceryExist
    

    function addGroceryToCourse(){
        $groceryname = trim($this->input->post('groceryname',TRUE));
        $course_id = trim($this->input->post('course_id',TRUE));
        $quantity = trim($this->input->post('quantity',TRUE));
        $this->load->model('courses_groceries_m');
        $course_grocery_id = $this->courses_groceries_m->addGroceryToCourse($course_id, $groceryname,$quantity);
        if($course_grocery_id){
            $this->output->set_output(json_encode(['success' => true, 'course_grocery_id' => $course_grocery_id]));
        } else {
            $this->output->set_output(json_encode(['success' => false]));
        }//else if course_grocery_id
    }//addGroceryToCourse
    
    
    function addDiary(){
        for($i = 0; $i< sizeof($this->input->post('courses'));$i++){
            $this->form_validation->set_rules("courses[".$i."]", 'course','xss_clean|required');//mydo add at least one course is reqired
        }//for 
        $this->form_validation->set_rules('quantity[]', 'quantity','xss_clean|trim');//mydo add chech grocery tabe
        
        $this->form_validation->set_rules('reasonname', 'reason','xss_clean|trim|required|min_length[2]|FV_CheckReasonExist');
        $this->form_validation->set_rules('date', 'date','xss_clean|trim|required|FV_date');//mydo add FV_date function
        $this->form_validation->set_rules('time', 'time','xss_clean|trim|FV_time');//mydo add FV_time function
        if($this->form_validation->run() == FALSE ){
             $this->output->set_output(json_encode(['success' => false, 'errors'=>$this->form_validation->form_validation_errors()]));
        } else {
            $courses_array = $this->input->post('courses');
            $quantity_array = $this->input->post('quantity');
            $diary_data =  ['reasonname' => $this->input->post('reasonname'),
                             'date'=>$this->input->post('date'),
                             'time' =>$this->input->post('time')
                            ];
            
            $diary_id = $this->diary_m->addDiary($diary_data,$courses_array,$quantity_array);
            $this->session->set_flashdata('diary_messages',"Diary sucessfully added");
            $this->output->set_output(json_encode(['success' => true,'diary_id'=>$diary_id]));
        }

    }//addCourse
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}//class

