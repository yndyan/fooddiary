<?php

class diary_course_m extends MY_Model 
{
    CONST table_name = 'diary_course';
    protected $TablePkName = "diary_course_id";
    
    
    function __construct() {
        parent::__construct();
    }//construct
//-----------------------------------------------------------------------------    
    function addCourseToDiary($diary_id, $coursename,$quantity){
        $this->load->model('courses_m');
        $where = ['coursename'=>$coursename,
                  'user_id'=> $this->user_id];
        
        $data_content = 'course_id';
        $like = null;
        $limit = 1;
         
        $course_id = $this->courses_m->getLikeWhere($data_content,$like,$where,$limit)[0]['course_id'];

        $diary_course_data = [  'diary_id'=>$diary_id,
                                'course_id'=>$course_id,
                                'quantity' => $quantity];

        return $this->addDataToDb($diary_course_data );
    }//addGroceryToCourse
//-----------------------------------------------------------------------------    

}//class
