<?php


class Default_reasons_m extends MY_Model{
    CONST table_name = 'default_reasons';
    protected $TablePkName = "reason_id";

    function __construct() {
        parent::__construct();
    }//constuct
 
//--------------------------------------------------------------------------    

    
    function getDefaultReasons(){
       $this->db->select('reasonname');
       $this->db->from($this->getTableName());
       $query =  $this->db->get();
       return $query->result_array();
    }//getDefaultReasons
    
//--------------------------------------------------------------------------    
   
    
}//class
