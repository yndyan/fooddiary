<?php
//require_once APPPATH.'models/MY_Model.php';

class User_reasons_m extends MY_Model
{
    CONST table_name = 'user_reasons';
    protected $TablePkName = "reason_id";
    function __construct() {
        parent::__construct();
    }
    
    function api_searchReasons($like_value){
        
        $data_content = 'reasonname as value';
        $like = ['reasonname' => $like_value];
        $where = ['user_id'  => $this->user_id];
        
        return $this->geLikeWhere($data_content,$like,$where);
    }
    
    
    function getSinglePageReasons($items_per_page=2,$page_number = 1,$like_value = null){
        
        $offset = $items_per_page * ($page_number-1);
        $data_content = 'reasonname,reason_id';    
        $this->db->select($data_content);
        $this->db->from($this->getTableName());
        $this->db->where('user_id',  $this->user_id);
        if($like_value){
            $this->db->like('reasonname',$like_value);
        }//if
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

        $this->db->insert_batch($this->getTableName(),$default_reasons);
    }//copyDefaultreasonsToNewUser
    
    
    function addReason($new_reason){
         return $this->addDataToDb(['user_id'=>$this->user_id ,'reasonname'=>$new_reason]);
    }//addNewUserReason
    
    
    function updateReason($updated_reason,$reason_id){
        $this->updateData(['reason_id'=>$reason_id],['reasonname'=>$updated_reason]);
    }//update reaosn
    
    
    function deleteReason($reason_id){
        $this->db->limit(1);
        $this->db->delete($this->getTableName(), ['reason_id'=>$reason_id,'user_id'=>  $this->user_id]);
        return $this->db->affected_rows();
    }
} 