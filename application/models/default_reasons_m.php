<?php

//require_once APPPATH.'models/MY_Model.php';

class Default_reasons_m extends MY_Model{
    CONST table_name = 'default_reasons';
    protected $TablePkName = "reason_id";

    function getTableName()
    {
        return self::table_name;
    }
    
    function getDefaultReasons(){
       $this->db->select('reasonname');
       $this->db->from(self::table_name);
       $query =  $this->db->get();
       return $query->result_array();
    }//
    
}
