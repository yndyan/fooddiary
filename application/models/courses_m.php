<?php

class Courses_m extends MY_Model 
{
    CONST table_name = 'courses';
    protected $TablePkName = "course_id";
    
    function __construct() {
        parent::__construct();
    }
    
    function add_course($course_data,$groceries_array,$quantity_array){
        
        $course_data['user_id'] = $this->user_id;
        $course_id = $this->addDataToDb($course_data);
        $data_content = 'grocery_id';
        $limit = 1;
        $this->load->model('courses_groceries_m');
        if($course_id && $groceries_array){
            foreach ($groceries_array as $key => $grocery) {
                $where = ['groceryname'=>$grocery,
                          'user_id'=> $this->user_id];
                $grocery_id = $this->user_groceries_m->geLikeWhere($data_content,null,$where,$limit)[0]['grocery_id'];
                $grocery_course_data = ['course_id'=>$course_id,
                                        'grocery_id'=>$grocery_id,
                                        'quantity' => $quantity_array[$key]];

                $this->courses_groceries_m->addDataToDb($grocery_course_data);
            }//foreach
        }//if
        //mydo delete some kind of protection when some inerts dont work
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
        
        $subquery = "(";
            $subquery .= "SELECT * FROM ".$this->courses_m->getTableName();
            $subquery .=" WHERE courses.user_id = '".$this->user_id."'";
            $subquery .=" LIMIT ".$items_per_page ;
            $subquery .=" OFFSET ".$offset;
        $subquery .= ")";
        $subquery .= " AS subcourses";
        
        //$course_data_content = 'course_id,coursename,coursedescription,calories';
        //$this->db->select('subcourses.course_id,subcourses.coursename,user_groceries.groceryname,user_groceries.grocery_id');
        $this->db->select('*');
        $this->db->from($subquery);
        $this->db->join('courses_groceries', 'subcourses.course_id = courses_groceries.course_id');
        $this->db->join('user_groceries', 'user_groceries.grocery_id = courses_groceries.grocery_id' );
        $query_data = $this->db->get()->result_array();
        $courses_ids = array_unique(array_column($query_data, 'course_id'));
        
        //$course_needed_keys =  [ "course_id" => '',"coursename"=> '',"coursedescription"=>'', "calories" => '', "quantity"  =>''];
        $course_needed_keys =  [ "course_id" => '',"coursename"=> '',"coursedescription"=>'', "calories" => ''];
        //$grocery_needed_keys =['groceryname' =>'','grocery_id'=>'', "quantity"  =>''];
        $grocery_needed_keys =['groceryname' =>'',   "quantity"  =>''];
           
        foreach ($courses_ids as $course_key =>$course_id) {
            $grocery_cnt = 0;
            foreach ($query_data as $single_query_data) {
                if($course_id == $single_query_data['course_id']){
                    if($grocery_cnt==0){
                        $return_course_data[$course_key] = array_intersect_key($single_query_data, $course_needed_keys);   
                    }//if2 
                    $return_course_data[$course_key]['groceries'][$grocery_cnt] = array_intersect_key($single_query_data, $grocery_needed_keys);   
                $grocery_cnt++;  
                }//if
            }//foreach2
           
        }//foreach 
        
        return $return_course_data;    
    }//getSinglePageCourses
    
    
    
    
}//class