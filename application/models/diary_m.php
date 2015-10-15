<?php

class Diary_m extends MY_Model
{

	CONST table_name = 'diary';
    protected $TablePkName = "diary_id";

    function __construct() {
        parent::__construct();
    }//construct

//--------------------------------------------------------------------------    
    
    function addDiary($diary_data,$courses_array,$quantity_array){
    	$this->load->model('diary_course_m');

        $reason_id = $this->reasons_m->getReasonId($diary_data['reasonname']);
        $input_date = $diary_data['date'];
        $date_object = DateTime::createFromFormat('d-m-Y', $input_date);
        $sql_date = $date_object->format('Y-m-d');
        $prepared_diary_data = ["diary_date"=>"$sql_date",
                                "diary_time"=>$diary_data['time'],
                                "reason_id"=>$reason_id,
                                "user_id"=>$this->user_id,
                                ];
    	$diary_id = $this->addDataToDb($prepared_diary_data);
    	if($diary_id && $courses_array){
            foreach ($courses_array as $key => $coursename) {
                $this->diary_course_m->addCourseToDiary($diary_id, $coursename, $quantity_array[$key]);
            }//foreach
        }//if
    	return $diary_id;						
    }//addDiary
    
//--------------------------------------------------------------------------    
    
    function deleteDiary($diary_id){
        $this->load->model('diary_course_m');
        $this->db->delete($this->diary_course_m->getTableName(), ['diary_id'=>$diary_id]);
             
        $this->db->limit(1);
        $this->db->delete($this->getTableName(), ['diary_id'=>$diary_id,'user_id'=>$this->user_id]);
        
        //mydo when finish diary must add deleting in-between table
        return $this->db->affected_rows();
        
        //$this->db->affected_rows();
        
    }//deleteDiary
    
//--------------------------------------------------------------------------    
    

//SELECT * FROM 
//(SELECT * FROM diaries WHERE diary.user_id = '1' LIMIT 1 OFFSET 0) AS subcourses 
//INNER JOIN diary_course ON subcourses.diary_id = diary_course.diary_id
//INNER JOIN courses ON courses.course_id =  diary_course.course_id
//;         $query = $this->db->query('YOUR QUERY HERE');

    
    
    
    function getSinglePageDiaries($page_number = 1,$items_per_page=5,$like = null) {
        $this->load->model('diary_course_m');
        $this->load->model('courses_m');
        $this->load->model('reasons_m');
        $offset = $items_per_page * ($page_number-1);
        $like_query = '';
        
        if(is_array($like)){
            $like_query = '';
            foreach ($like as $key => $value) {
                $like_query .=  " AND diary.".$key." LIKE '%".$value."%' ";
            }//foreach
        }//if($like)
        
        
        $timeformat = "TIME_FORMAT(subcourses.diary_time ,'%H:%i') AS formated_diary_time ";
        $subquery = "(";
            $subquery .= "SELECT * FROM ".$this->diary_m->getTableName();
            $subquery .=" WHERE diary.user_id = '".$this->user_id."'";
            $subquery .=  $like_query; 
            $subquery .=" LIMIT ".$items_per_page ;
            $subquery .=" OFFSET ".$offset;
            
        $subquery .= ")";
        $subquery .= " AS subcourses";
         
        //$course_data_content = 'course_id,coursename,coursedescription,calories';
        //$this->db->select('subcourses.course_id,subcourses.coursename,user_groceries.groceryname,user_groceries.grocery_id');
        $this->db->select("*, $timeformat",false);
        $this->db->from($subquery);
        $this->db->join('diary_course', 'subcourses.diary_id = diary_course.diary_id');
        $this->db->join('courses', 'courses.course_id = diary_course.course_id' );
        $this->db->join('reasons', 'subcourses.reason_id = reasons.reason_id' );
        $query_data = $this->db->get()->result_array();
        //var_dump($query_data);
        $diaries_ids = array_unique(array_column($query_data, 'diary_id'));
          
        $diary_needed_keys =  [ 'diary_id' => '','diary_date'=> '','formated_diary_time'=>'','reasonname'=>''];
        $course_needed_keys =['coursename' =>'','course_id' =>'','quantity' => ''];
        
        $diary_key = 0;
        $return_diary_data = [];
        foreach ($diaries_ids as $diary_id) {
            $course_cnt = 0;
            foreach ($query_data as $single_query_data) {
                if($diary_id == $single_query_data['diary_id']){
                    if($course_cnt==0){
                        $return_diary_data[$diary_key] = array_intersect_key($single_query_data, $diary_needed_keys);   
                    }//if2 
                    $return_diary_data[$diary_key]['courses'][$course_cnt] = array_intersect_key($single_query_data, $course_needed_keys);   
                $course_cnt++;  
                }//if
            }//foreach2
            $diary_key++;
        }//foreach 
        $data['diaries'] = $return_diary_data;
        $data['number_of_pages'] = $this->getPageCount($items_per_page,$like);
        $data['current_page'] = $page_number; 
        
        return $data ; //$return_course_data;    
    }//getSinglePageCourses
    
//--------------------------------------------------------------------------
    
}//class

