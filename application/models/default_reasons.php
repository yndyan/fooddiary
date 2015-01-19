<?php

require_once APPPATH.'models/MY_Model.php';

class default_reasons extends MY_Model{
    CONST table_name = 'default_reasons';

    function getTableName()
    {
        return self::table_name;
    }
    
    function getDefaultReasons(){
       $this->db->select('reason');
       $this->db->from(self::table_name);
       $query =  $this->db->get();
       return $query->result();
    }//
    
}
