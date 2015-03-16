<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_c extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('user_reasons_m');
        $this->load->model('user_groceries_m');
        $this->load->model('courses_m');
    }
            
    function getAutocompleteReasons(){
        //check login status
        //mydo add form validatio
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->user_reasons_m->api_searchReasons($like_value);
        echo json_encode($result);//TODO vrati
        
    }
    function getAutocompleteGroceries(){
        //check login status
        //mydo add form validatio
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->user_groceries_m->api_searchGroceries($like_value);
        echo json_encode($result);//TODO vrati
        
    }
    
    function addCourse(){
        $this->form_validation->set_rules('coursename', 'course name','xss_clean|trim|required|min_length[2]|is_unique[courses.coursename]');//mydo add unique
        $this->form_validation->set_rules('coursedescription', 'description','xss_clean|trim');
        for($i = 0; $i< sizeof($this->input->post('groceries'));$i++){
            $this->form_validation->set_rules("groceries[".$i."]", 'groceries','xss_clean|checkGroceryExist');//mydo add chech grocery tabe
        }//for 
        $this->form_validation->set_rules('quantity[]', 'quantity','xss_clean|trim');//mydo add chech grocery tabe
        $this->form_validation->set_rules('calories', 'calories','xss_clean|trim');
        if($this->form_validation->run() == FALSE ){
             $this->output->set_output(json_encode(['success' => false, 'errors'=>$this->form_validation->form_validation_errors()]));
        } else {
            $course_data = ['coursename' => $this->input->post('coursename'),
                     'coursedescription'=>$this->input->post('coursedescription'),
                     'calories' =>$this->input->post('calories')
                    ];
            $groceries_array = $this->input->post('groceries');
            $quantity_array = $this->input->post('quantity');
            
            $course_id = $this->courses_m->add_course($course_data,$groceries_array,$quantity_array);
            
            $this->output->set_output(json_encode(['success' => true,'course_id'=>$course_id]));
        }

    }//addCourse
}

