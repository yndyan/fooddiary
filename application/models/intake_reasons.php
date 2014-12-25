<?php
require_once APPPATH.'models/MY_Model.php';

class Intake_reasons extends MY_Model
{
    CONST table_name = 'intake_reasons';

    function getTableName()
    {
        return self::table_name;
    }
    
    function getUserReasons($like_value){
        
        $data_content = 'reason as value';
        $user_id = $this->session->userdata('logged_in')['id'];
        $this->db->select($data_content);
        $this->db->from('intake_reasons');
        $this->db->where('user_id',$user_id);
        $this->db->like('reason',$like_value);
        $this->db-> limit(10);

        $query = $this->db->get();
        return $query->result();
    }
    
    function getOthersPublicReasons(){
    //like and (user_ide or public = true)    
    //tabela usera koji umJU PUBLIC reasons  presek sa Reasons tabelom + like
    //jpin toga i     
    }
} 