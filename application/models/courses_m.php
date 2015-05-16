<?php

class Courses_m extends MY_Model 
{
    CONST table_name = 'courses';
    protected $TablePkName = "course_id";
    
    function __construct() {
        parent::__construct();
    }
    
    function add_course($course_data,$grocerynames_array,$quantity_array){
        
        $course_data['user_id'] = $this->user_id;
        $course_id = $this->addDataToDb($course_data);
        $this->load->model('courses_groceries_m');
        if($course_id && $grocerynames_array){
            foreach ($grocerynames_array as $key => $groceryname) {
                $this->courses_groceries_m->addGroceryToCourse($course_id, $groceryname, $quantity_array[$key]);
            }//foreach
        }//if
        //mydo  some kind of protection when some inerts dont work
        return $course_id;
    }//add course
    
//SELECT * FROM 
//(SELECT * FROM courses WHERE courses.user_id = '1' LIMIT 1 OFFSET 0) AS subcourses 
//INNER JOIN courses_groceries ON subcourses.course_id = courses_groceries.course_id
//INNER JOIN user_groceries ON user_groceries.grocery_id =  courses_groceries.grocery_id
//;         $query = $this->db->query('YOUR QUERY HERE');

    
    
    
    function getSinglePageCourses($items_per_page = 2, $page_number = 1) {
        $this->load->model('courses_groceries_m');
        $this->load->model('user_groceries_m');
        $offset = $items_per_page * ($page_number-1);
        
        $this->db->select('coursename,course_id');
        $this->db->from($this->courses_m->getTableName());
        $this->db->where('user_id',$this->user_id);
        $this->db->limit($items_per_page,$offset);
        $query_data = $this->db->get()->result_array();
        if($query_data){
            return $query_data;  
        } else {
            return false;
        }
    }//getSinglePageCourses
    
    
   /* SELECT * FROM 
    (courses LEFT JOIN courses_groceries ON courses.course_id = courses_groceries.course_id) 
    LEFT JOIN user_groceries ON user_groceries.grocery_id = courses_groceries.grocery_id 
    WHERE courses.course_id = 56;

    */
    
    function getSingleCourse($course_id){
        $this->load->model('courses_groceries_m');
        $this->load->model('user_groceries_m');
        $this->db->select('*');
        $this->db->select('courses.course_id');//mydo without this not returning course_id on course with no groceries  
        $this->db->from($this->courses_m->getTableName());
        $this->db->join('courses_groceries', 'courses.course_id = courses_groceries.course_id','left');
        $this->db->join('user_groceries', 'user_groceries.grocery_id = courses_groceries.grocery_id','left' );
        $this->db->where(['courses.user_id'=> $this->user_id,'courses.course_id' =>$course_id]);
        $query_data = $this->db->get()->result_array();
        //var_dump($query_data); die(); //mydo delte this
        $single_course_data['course_id'] = $query_data[0]['course_id'];
        $single_course_data['coursename'] = $query_data[0]['coursename'];
        $single_course_data['coursedescription'] = $query_data[0]['coursedescription'];
        $single_course_data['calories'] = $query_data[0]['calories'];
        $grocery_needed_keys = ["groceryname" =>'',   
                                "quantity"  =>'',
                                "course_grocery_id"=>''];
        foreach ($query_data as $key => $value){
            $single_course_data['groceries'][$key] = array_intersect_key($value, $grocery_needed_keys); 
        }//foreach
        
        return $single_course_data;
    }//getSingleCourse
    
    function deleteCourse($course_id){
        $this->load->model('courses_groceries_m');
        $this->db->delete($this->courses_groceries_m->getTableName(), ['course_id'=>$course_id]);
             
        $this->db->limit(1);
        $this->db->delete($this->getTableName(), ['course_id'=>$course_id,'user_id'=>$this->user_id]);
        
        //mydo when finish diary must add deleting in-between table
        return $this->db->affected_rows();
        
        //$this->db->affected_rows();
        
    }//
    
    function deleteSingleGroceryFromCourse($course_grocery_id){
        $this->load->model('courses_groceries_m');
        $this->db->limit(1);
        $this->db->delete($this->courses_groceries_m->getTableName(), ['course_grocery_id'=>$course_grocery_id]);
        return $this->db->affected_rows();
    }//deleteSingleGroceryFromCourse
    
}//class