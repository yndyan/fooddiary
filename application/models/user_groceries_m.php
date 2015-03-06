<?php

class User_groceries_m extends MY_Model
{   
    CONST table_name = 'user_groceries';
    protected $TablePkName = "grocery_id";
    private $user_id = '';
    function getTableName()
    {
        return self::table_name;
    }
    function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('logged_in')['user_id'];
    }
    
    function api_searchGroceries($like_value){
        
        $data_content = 'groceryname as value';
        $like = ['groceryname' => $like_value];
        $where = ['user_id'  => $this->user_id];
        
        return $this->searchWhere($data_content,$like,$where);
    }
    function getGroceriesPageCount($items_per_page = 2){
        
        $this->db->where('user_id',  $this->user_id);
        $this->db->from(SELF::table_name);
        return (int)ceil($this->db->count_all_results()/$items_per_page);
        
    }//
    
    function getSinglePageGroceries($items_per_page=2,$page_number = 1){
        
        $offset = $items_per_page * ($page_number-1);
        $data_content = 'groceryname,grocery_id';    
        $this->db->select($data_content);
        $this->db->from(SELF::table_name);
        $this->db->where('user_id',  $this->user_id);
        $this->db->limit($items_per_page,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }//getallUserReasons
    
     function copyDefaultGroceriesToNewUser(){
        $user_id = $this->user_id = $this->session->userdata('logged_in')['user_id'];
        $this->load->model('default_groceries_m'); 
        $default_groceries = $this->default_groceries_m->getDefaultGroceries();
        foreach($default_groceries as $key => $grocerie){
            $default_groceries[$key] += ['user_id'=> $user_id]; 
        }//foreach

        $this->db->insert_batch(self::table_name,$default_groceries);
    }//copyDefaultreasonsToNewUser
    
    function addGrocery($new_grocery){
         return $this->addDataToDb(['user_id'=>$this->user_id ,'groceryname'=>$new_grocery]);
    }//addGrocery
    
    function updateGrocery($updated_grocery,$grocery_id){
        $this->updateData('grocery_id',$grocery_id,['groceryname'=>$updated_grocery]);
    }//updateGrocery
    
    function deleteGrocery($grocery_id){
        $this->db->limit(1);
        $this->db->delete(self::table_name, ['grocery_id'=>$grocery_id,'user_id'=>$this->user_id]);
        return $this->db->affected_rows();
    }//deleteGrocery
}