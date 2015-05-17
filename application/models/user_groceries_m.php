<?php

class User_groceries_m extends MY_Model
{   
    CONST table_name = 'user_groceries';
    protected $TablePkName = "grocery_id";
//    function getTableName()
//    {
//        return $this->getTableName();
//    }
    function __construct() {
        parent::__construct();
    }
    
    function api_searchGroceries($groceryname){
        
        $data_content = 'groceryname as value';
        $like = ['groceryname' => $groceryname];
        $where = ['user_id'  => $this->user_id];
        
        return $this->geLikeWhere($data_content,$like,$where);
    }
    
//    function getSinglePageGroceries($items_per_page=2,$page_number = 1){
//        
//        $offset = $items_per_page * ($page_number-1);
//           
//        $this->db->select($data_content);
//        $this->db->from($this->getTableName());
//        $this->db->where('user_id',  $this->user_id);
//        $this->db->limit($items_per_page,$offset);
//        $query = $this->db->get();
//        return $query->result_array();
//    }//getallUserReasons
    
     function copyDefaultGroceriesToNewUser(){
        $user_id = $this->user_id = $this->session->userdata('logged_in')['user_id'];
        $this->load->model('default_groceries_m'); 
        $default_groceries = $this->default_groceries_m->getDefaultGroceries();
        foreach($default_groceries as $key => $grocerie){
            $default_groceries[$key] += ['user_id'=> $user_id]; 
        }//foreach

        $this->db->insert_batch($this->getTableName(),$default_groceries);
    }//copyDefaultreasonsToNewUser
    
    function addGrocery($new_grocery){
         return $this->addDataToDb(['user_id'=>$this->user_id ,'groceryname'=>$new_grocery]);
    }//addGrocery
    
    function updateGrocery($updated_grocery,$grocery_id){
        $this->updateData(['grocery_id'=>$grocery_id],['groceryname'=>$updated_grocery]);
    }//updateGrocery
    
    function deleteGrocery($grocery_id){
        $this->db->limit(1);
        $this->db->delete($this->getTableName(), ['grocery_id'=>$grocery_id,'user_id'=>$this->user_id]);
        //mydo must find tables where this grocery is used and delete them all, maybe warning before
        return $this->db->affected_rows();
    }//deleteGrocery
    
    function checkGroceryExist($groceryname){
        return $this->chechValueExistsInDb(['groceryname'=>$groceryname,'user_id'=>$this->user_id]);    
    }//checkGroceryExist
}