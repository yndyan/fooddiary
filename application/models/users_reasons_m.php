<?php
//require_once APPPATH.'models/MY_Model.php';

class Users_reasons_m extends MY_Model
{
    CONST table_name = 'user_reasons';
    protected $TablePkName = "reason_id";
    private $user_id = '';
    function __construct() {
        parent::__construct();
        
        $this->user_id = $this->session->userdata('logged_in')['user_id'];
    }
            function getTableName()
    {
        return self::table_name;
    }
    
    function searchUserReasons($like_value){
        
        $data_content = 'reasonname as value';
        $this->db->select($data_content);
        
        $this->db->from(SELF::table_name);
        $this->db->where('user_id',  $this->user_id);
        $this->db->like('reasonname',$like_value);
        $this->db-> limit(10);

        $query = $this->db->get();
        return $query->result();
    }
    
    
    function getReasonsPageCount($items_per_page = 2){
        //$user_id = $this->session->userdata('logged_in')['user_id'];
        $this->db->where('user_id',  $this->user_id);
        $this->db->from(SELF::table_name);
        return (int)ceil($this->db->count_all_results()/$items_per_page);
        
    }//
    
    function getSinglePageReasons($items_per_page=2,$page_number = 1){
        
        $offset = $items_per_page * ($page_number-1);
        $data_content = 'reasonname,reason_id';    
        $this->db->select($data_content);
        $this->db->from(SELF::table_name);
        $this->db->where('user_id',  $this->user_id);
       
        $this->db->limit($items_per_page,$offset);
        
        $query = $this->db->get();
        
        return $query->result_array();
        
        
    }//getallUserReasons
    
    function copyDefaultReasonsToNewUser(){
        $user_id = $this->user_id = $this->session->userdata('logged_in')['user_id'];
        $this->load->model('default_reasons_m'); 
        $default_reasons = $this->default_reasons_m->getDefaultReasons();
        foreach($default_reasons as $key => $reason){
            $default_reasons[$key] += ['user_id'=> $user_id]; 
        }//foreach

        $this->db->insert_batch(self::table_name,$default_reasons);
    }//copyDefaultreasonsToNewUser
    
    
    function addReason($new_reason){
         return $this->addDataToDb(['user_id'=>$this->user_id ,'reasonname'=>$new_reason]);
    }//addNewUserReason
    
    function deleteReason($reason_id){
        $this->db->limit(1);
        $this->db->delete(self::table_name, ['reason_id'=>$reason_id,'user_id'=>  $this->user_id]);
        return $this->db->affected_rows();
    }
} 