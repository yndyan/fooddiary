<?php

class Groceries_m extends MY_Model
{   
    CONST table_name = 'groceries';
    protected $TablePkName = "groceries_id";
    
    function getTableName()
    {
        return self::table_name;
    }
    function __construct() {
        parent::__construct();
    }
     function copyDefaultGroceriesToNewUser(){
        $user_id = $this->user_id = $this->session->userdata('logged_in')['user_id'];
        $this->load->model('default_groceries_m'); 
        $default_groceries = $this->default_groceries_m->getDefaultGroceries();
        foreach($default_groceries as $key => $grocerie){
            $default_groceries[$key] += ['user_id'=> $user_id]; 
        }//foreach

        $this->db->insert_batch(self::table_name,$default_groceries);
    }//copyDefaultreasonsToNewUser
    
}