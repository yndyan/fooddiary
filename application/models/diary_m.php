<?php

class diary_m extends MY_Model
{

	CONST table_name = 'diary';
    protected $TablePkName = "diary_id";

    function __construct() {
        parent::__construct();
    }
    
    function addDiary($diary_data,$courses_array,$quantity_array){
    	$this->load->model('diary_course_m');

        $reason_id = $this->reasons_m->getReasonId($diary_data['reasonname']);
        $input_date = $diary_data['date'];
        $date_object = DateTime::createFromFormat('d-m-Y', $input_date);
        $sql_date = $date_object->format('Y-m-d');
        $prepared_diary_data = ["date"=>"$sql_date",
        						"time"=>$diary_data['time'],
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
    
     function getSinglePageDiaries($page_number = 1,$items_per_page=5,$like = null) {
       
        $data_content = 'diary_id,date,time';         
        $data['diaries'] =  $this->getSinglePageData($items_per_page,$page_number,$data_content,$like);
        $data['number_of_pages'] = $this->getPageCount($items_per_page,$like);
        $data['current_page'] = $page_number; 
        return $data;
    }//getSinglePageCourses
    
    function deleteDiary($diary_id){
        $this->load->model('diary_course_m');
        $this->db->delete($this->diary_course_m->getTableName(), ['diary_id'=>$diary_id]);
             
        $this->db->limit(1);
        $this->db->delete($this->getTableName(), ['diary_id'=>$diary_id,'user_id'=>$this->user_id]);
        
        //mydo when finish diary must add deleting in-between table
        return $this->db->affected_rows();
        
        //$this->db->affected_rows();
        
    }//deleteDiary
}

