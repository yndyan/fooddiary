<?php

class Default_groceries_m extends MY_Model
{   
    
    CONST table_name = 'default_groceries';
    protected $TablePkName = "grocery_id";

    function getTableName()
    {
        return self::table_name;
    }
    function __construct() {
        parent::__construct();
    }
    
    function getDefaultGroceries(){
       $this->db->select('groceryname');
       $this->db->from(self::table_name);
       $query =  $this->db->get();
       return $query->result_array();
    }//
}