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
        $sc_data=  $this->courses_m->getSinglePageCourses($page_number);
        $sc_data['controler_url'] = $this->controler_url;
        $this->load->view('courses_c/show_courses_v',$sc_data);
    }//show_courses
//----------------------------------------------------------------------------    
    function show_add_course(){
        
        $this->load->view('courses_c/add_course_v');
        
    }//add_course

//----------------------------------------------------------------------------    
    public function delete_course(){
        $course_id = trim($this->input->get('course_id',TRUE));
        if($this->courses_m->deleteCourse($course_id)){
            $this->session->set_flashdata('course_messages',"Course successfully deleted");
        } else {
            $this->session->set_flashdata('course_messages',"Error deleting course");
        }
        redirect('courses_c/show_courses','refresh');
    }//delete_grocery
//----------------------------------------------------------------------------    
    function update_course(){
        $course_id = trim($this->input->get('course_id',TRUE));

        if($this->input->post('new_coursename')){
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('new_coursename', 'course name','xss_clean|trim|required|min_length[2]|FV_CheckCourseNotExist');
            $this->form_validation->set_rules('coursedescription', 'description','xss_clean|trim');
            $this->form_validation->set_rules('calories', 'calories','xss_clean|trim');

            if($this->form_validation->run() == FALSE ){
                $data['course_id'] = $course_id;
                $data['coursename'] = $this->input->post('new_coursename');
                $data['coursedescription'] = $this->input->post('new_coursedescription');
                $data['calories'] = $this->input->post('new_calories');
                $this->load->view('courses_c/update_course_v',$data);
            } else {
                
                $updated_course_data = ['coursename' => ucfirst($this->input->post('new_coursename')),
                                        'coursedescription'=>$this->input->post('new_coursedescription'),
                                        'calories' =>$this->input->post('new_calories')
                                        ];
                $course_update_success = $this->courses_m->updateCourseData($course_id, $updated_course_data);
                $course_update_success ?  $this->session->set_flashdata('course_messages',"Course sucessfully updated") 
                                       :  $this->session->set_flashdata('course_messages',"Error updating course");
                redirect('courses_c/show_courses','refresh');
            }//else if($this->form_validation->run() == FALSE     
        } else {
            if($course_id){
            $data = $this->courses_m->getSingleCourse($course_id);
            //var_dump($data); die();//mydo delete this
            $this->load->view('courses_c/update_course_v',$data);    
            }
            else {
                $this->session->set_flashdata('course_messages',"Unknown error");
                redirect('courses_c/show_courses','refresh');
            }
            
        }
        
        
        

    }//updateCourse
//----------------------------------------------------------------------------
}