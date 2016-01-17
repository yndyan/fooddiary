<?php

class groceries_m extends MY_Model
{   
    CONST table_name = 'user_groceries';
    protected $TablePkName = "grocery_id";

    function __construct() {
        parent::__construct();
    }//construct

//-----------------------------------------------------------------------------    
    
    function api_searchGroceries($groceryname){
        $data_content = 'groceryname as value';
        $like = ['groceryname' => $groceryname];
        $where = ['user_id'  => $this->user_id];
        return $this->getLikeWhere($data_content,$like,$where);
    }//api_searchGroceries
    
//-----------------------------------------------------------------------------
    
    function getSinglePageGroceries($page_number = 1,$items_per_page=5,$like = null){
        $data_content = 'groceryname,grocery_id';  
        $data['user_groceries'] =  $this->getSinglePageData($items_per_page,$page_number,$data_content,$like);
        $data['number_of_pages'] = $this->getPageCount($items_per_page,$like);
        $data['current_page'] = $page_number;
        return $data;
    }//getallUserReasons 
    
//-----------------------------------------------------------------------------
    
    
     function copyDefaultGroceriesToNewUser(){
        $user_id = $this->user_id = $this->session->userdata('logged_in')['user_id'];
        $this->load->model('default_groceries_m'); 
        $default_groceries = $this->default_groceries_m->getDefaultGroceries();
        foreach($default_groceries as $key => $grocerie){
            $default_groceries[$key] += ['user_id'=> $user_id]; 
        }//foreach
        $this->db->insert_batch($this->getTableName(),$default_groceries);
    }//copyDefaultreasonsToNewUser
    
//-----------------------------------------------------------------------------
    
    function addGrocery($new_grocery){
         return $this->addDataToDb(['user_id'=>$this->user_id ,'groceryname'=>$new_grocery]);
    }//addGrocery
    
//-----------------------------------------------------------------------------
    
    function updateGrocery($updated_grocery,$grocery_id){
        $where['grocery_id'] = $grocery_id;
        $where['user_id'] = $this->user_id;
        $data['groceryname']=$updated_grocery;
        $this->updateData($where,$data);
    }//updateGrocery
    
//-----------------------------------------------------------------------------
    
    function deleteGrocery($grocery_id){//mydo add soft delete
        $this->db->limit(1);
        $this->db->delete($this->getTableName(), ['grocery_id'=>$grocery_id,'user_id'=>$this->user_id]);
        return $this->db->affected_rows();
    }//deleteGrocery
    
//-----------------------------------------------------------------------------
    
    function checkGroceryExist($groceryname){
        return $this->chechValueExistsInDb(['groceryname'=>$groceryname,'user_id'=>$this->user_id]);    
    }//checkGroceryExist
    
//-----------------------------------------------------------------------------
    
}//class