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
        if($course_id){
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
    
}