<?php
//require_once APPPATH.'models/MY_Model.php';

class reasons_m extends MY_Model
{
    CONST table_name = 'reasons';
    protected $TablePkName = "reason_id";
    function __construct() {
        parent::__construct();
    }
    
//--------------------------------------------------------------------------------

    
    function api_searchReasons($like_value){
        
        $data_content = 'reasonname as value';
        $like = ['reasonname' => $like_value];
        $where = ['user_id'  => $this->user_id];
        
        return $this->getLikeWhere($data_content,$like,$where);
    }//api_searchReasons
    
//--------------------------------------------------------------------------------

    
    function getSinglePageReasons($page_number = 1,$items_per_page=5,$like = null){
        
        $data_content = 'reasonname,reason_id';         
        $data['reasons'] =  $this->getSinglePageData($items_per_page,$page_number,$data_content,$like);
        $data['number_of_pages'] = $this->getPageCount($items_per_page,$like);
        $data['current_page'] = $page_number;   
        return $data;
    }//getallUserReasons 
    
//--------------------------------------------------------------------------------


    function copyDefaultReasonsToNewUser(){
        $user_id = $this->user_id = $this->session->userdata('logged_in')['user_id'];
        $this->load->model('default_reasons_m'); 
        $default_reasons = $this->default_reasons_m->getDefaultReasons();
        foreach($default_reasons as $key => $reason){
            $default_reasons[$key] += ['user_id'=> $user_id]; 
        }//foreach

        $this->db->insert_batch($this->getTableName(),$default_reasons);
    }//copyDefaultreasonsToNewUser
    
//--------------------------------------------------------------------------------

    
    function addReason($new_reason){
         return $this->addDataToDb(['user_id'=>$this->user_id ,'reasonname'=>$new_reason]);
    }//addNewUserReason
//--------------------------------------------------------------------------------

    
    function updateReason($updated_reason,$reason_id){
        $this->updateData(['reason_id'=>$reason_id],['reasonname'=>$updated_reason]);
    }//update reaosn
    
//--------------------------------------------------------------------------------

    
    function deleteReason($reason_id){//mydo add soft delete
        $this->db->limit(1);
        $this->db->delete($this->getTableName(), ['reason_id'=>$reason_id,'user_id'=>  $this->user_id]);
        return $this->db->affected_rows();
    }//deleteReason
    
//--------------------------------------------------------------------------------

    function checkReasonExist($reasonname){
        return $this->chechValueExistsInDb(['reasonname'=>$reasonname,'user_id'=>$this->user_id]);    
    }//checkGroceryExist
    
//--------------------------------------------------------------------------------
    
    function getReasonId($reasonname){
        $where =  ['reasonname'=>$reasonname,
                   'user_id'=> $this->user_id];
        $data_content = 'reason_id';
        $like = null;
        $limit = 1;
        return $this->getLikeWhere($data_content,$like,$where,$limit)[0]['reason_id'];
    }//getReasonId
    
//--------------------------------------------------------------------------------

}//class
 