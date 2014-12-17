<?php
abstract class MY_Model extends CI_Model
{
    abstract protected function getTableName();
    
    
    function getSingleData($key,$value,$data_content)
        {
            $this->db-> select($data_content);
            $this->db-> from($this->getTableName());
            $this->db-> where($key,$value);
            $this->db-> limit(1);
            $query = $this->db->get();
            if($query->num_rows() == 1)
                {
                return get_object_vars($query->result()[0]);
                }
            else
                {
                return false;
                }
        }

    
    function chechValueExistsInDb($what,$value)
    {
        $this->db->where($what,$value);// probaj i probaj obrnuto!!
        $this->db->from($this->getTableName());
        return ($this->db->count_all_results() > 0);
    }    
    
    function deleteByKey($key = NULL, $value= NULL)
    {
        // zastita je rako stigne prazno obrisace celu tabelu
        if(($key!==NULL)AND($value!==NULL))
        {
        $this->db->where($key,$value);
        $this->db->delete($this->getTableName());
        }
    }
    
//    protected function setData($SELECT_CMD,$data)
//    {
//
//    }
//    protected function getData($SELECT_CMD)
//    {
//
//    }
//
//    protected function updateData($SELECT_CMD,$data)
//    {
//
//    }
//
//    protected function deleteData($SELECT_CMD)
//    {
//
//    }
}
