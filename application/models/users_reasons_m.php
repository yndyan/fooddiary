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
        
        $data_content = 'reason as value';
        
        //$user_id = $this->session->userdata('logged_in')['user_id'];
        $this->db->select($data_content);
        
        $this->db->from(SELF::table_name);
        $this->db->where('user_id',  $this->user_id);
        $this->db->like('reason',$like_value);
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
    
    function getAllUserReasons($items_per_page=2,$page_number = 1){
              
        $offset = $items_per_page * ($page_number-1);
        
        //$user_id = $this->session->userdata('logged_in')['user_id'];
        $data_content = 'reason';    
        $this->db->select($data_content);
        $this->db->from(SELF::table_name);
        $this->db->where('user_id',  $this->user_id);
       
        $this->db->limit($items_per_page,$offset);
        
        $query = $this->db->get();
        $result_array = array();
        foreach ($query->result() as $value){
            array_push($result_array,$value->reason);    
            }//foreach
        return $result_array;
        
        
    }//getallUserReasons
    
    function copyDefaultReasonsToNewUser($user_id){
        
        $this->load->model('default_reasons_m'); 
        $default_reasons = $this->default_reasons_m->getDefaultReasons();
        foreach($default_reasons as $key => $reason){
            $default_reasons[$key] += ['user_id'=> $user_id]; 
        }//foreach

        $this->db->insert_batch(self::table_name,$default_reasons);
    }//copyDefaultreasonsToNewUser
} 