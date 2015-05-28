<?php

class Courses_groceries_m extends MY_Model 
{
    CONST table_name = 'courses_groceries';
    protected $TablePkName = "course_grocery_id";
    
    
    function __construct() {
        parent::__construct();
    }
    
    function addGroceryToCourse($course_id, $groceryname, $quantity){
        $this->load->model('groceries_m');
        
        $where = ['groceryname'=>$groceryname,
                  'user_id'=> $this->user_id];
        
        $data_content = 'grocery_id';
        $like = null;
        $limit = 1;
         
        $grocery_id = $this->groceries_m->getLikeWhere($data_content,$like,$where,$limit)[0]['grocery_id'];
        $grocery_course_data = ['course_id'=>$course_id,
                                'grocery_id'=>$grocery_id,
                                'quantity' => $quantity ];

        return $this->courses_groceries_m->addDataToDb($grocery_course_data);
    }//addGroceryToCourse
}

