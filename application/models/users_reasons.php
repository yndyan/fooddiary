<?php
require_once APPPATH.'models/MY_Model.php';

class users_reasons extends MY_Model
{
    CONST table_name = 'users_reasons';

    function getTableName()
    {
        return self::table_name;
    }
    
    function searchUserReasons($like_value){
        
        $data_content = 'reason as value';
        $user_id = $this->session->userdata('logged_in')['id'];
        $this->db->select($data_content);
        
        $this->db->from(SELF::table_name);
        $this->db->where('user_id',$user_id);
        $this->db->like('reason',$like_value);
        $this->db-> limit(10);

        $query = $this->db->get();
        return $query->result();
    }
    function getReasonsPageCount($items_per_page = 2){
        $user_id = $this->session->userdata('logged_in')['id'];
        $this->db->where('user_id',$user_id);
        $this->db->from(SELF::table_name);
        return (int)ceil($this->db->count_all_results()/$items_per_page);
        
    }//
    
    function getAllUserReasons($items_per_page=2,$page_number = 1){
              
        $offset = $items_per_page * ($page_number-1);
        
        $user_id = $this->session->userdata('logged_in')['id'];
        $data_content = 'reason';    
        $this->db->select($data_content);
        $this->db->from(SELF::table_name);
        $this->db->where('user_id',$user_id);
       
        $this->db->limit($items_per_page,$offset);
        
        $query = $this->db->get();
        $result_array = array();
        foreach ($query->result() as $value){
            array_push($result_array,$value->reason);    
            }//foreach
        return $result_array;
        
        
    }//getallUserReasons
    
    function copyDefaultReasonsToNewUser($user_id){
    $this->load->model('default_reasons','',TRUE); 
    $this->default_reasons->getTableName();    
    }//copyDefaultreasonsToNewUser
} 