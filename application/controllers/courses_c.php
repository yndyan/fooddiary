<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses_c extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('courses_m');
    }//__construct()
//----------------------------------------------------------------------------    
    function show_courses(){
            
            $page_number = ($this->input->get('page')!=null) ? $this->input->get('page') : 1;
            $items_per_page = 5;
            $data['courses'] =  $this->courses_m->getSinglePageCourses($items_per_page,$page_number);
            $data['number_of_pages'] = $this->courses_m->getPageCount($items_per_page);
            $data['current_page'] = $page_number;
            $this->load->view('courses_c/show_courses_v',$data);
       
    }//show_courses
//----------------------------------------------------------------------------    
    function show_add_course(){
        
        $this->load->view('courses_c/add_course_v');
        
    }//add_course
//----------------------------------------------------------------------------    
    function show_update_course(){
       
            $course_id = trim($this->input->get('course_id',TRUE));
            $data = $this->courses_m->getSingleCourse($course_id);
            //var_dump($data); die();//mydo delete this
            $this->load->view('courses_c/update_course_v',$data);
        
    }//update_course
//----------------------------------------------------------------------------    
    public function delete_course(){
        $course_id = trim($this->input->get('course_id',TRUE));
        if($this->courses_m->deleteCourse($course_id)){
            $this->session->set_flashdata('course_messages',"Course successfully deleted");
            redirect('courses_c/show_courses','refresh');
        } else {
            $this->session->set_flashdata('course_messages',"Error deleting course");
            redirect('courses_c/show_courses','refresh');
        }
    }//delete_grocery
    
//        function updateCourse(){
//        $this->form_validation->set_rules('coursename', 'course name','xss_clean|trim|required|min_length[2]');//mydo update unique check unique
//        $this->form_validation->set_rules('coursedescription', 'description','xss_clean|trim');
//        
//        for($i = 0; $i< sizeof($this->input->post('groceries'));$i++){
//            $this->form_validation->set_rules("groceries[".$i."]", 'groceries','xss_clean|checkGroceryExist');//mydo add chech grocery tabe
//        }//for 
//        
//        $this->form_validation->set_rules('quantity[]', 'quantity','xss_clean|trim');//mydo add chech grocery tabe
//        $this->form_validation->set_rules('calories', 'calories','xss_clean|trim');
//        if($this->form_validation->run() == FALSE ){
//             $this->output->set_output(json_encode(['success' => false, 'errors'=>$this->form_validation->form_validation_errors()]));
//        } else {
//            $course_data = ['coursename' => $this->input->post('coursename'),
//                     'coursedescription'=>$this->input->post('coursedescription'),
//                     'calories' =>$this->input->post('calories')
//                    ];
//            $groceries_array = $this->input->post('groceries');
//            $quantity_array = $this->input->post('quantity');
//            var_dump($course_data); die();//mydo delete this
//            
//            //$course_id = $this->courses_m->add_course($course_data,$groceries_array,$quantity_array);
//            $this->session->set_flashdata('course_messages',"Course sucessfully added");
//            $this->output->set_output(json_encode(['success' => true,'course_id'=>$course_id]));
//            
//        }

//    }//
  

}