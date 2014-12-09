<?php
abstract class BaseModel extends CI_Model
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
