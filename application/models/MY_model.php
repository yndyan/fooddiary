<?php
abstract class MY_Model extends CI_Model
{
    protected $TablePkName = "id";
    abstract protected function getTableName();

    protected function getByPk($pk_value){
        $this->db->select("*");
        $this->db->from($this->getTableName());
        $this->db->where($this->TablePkName,$pk_value );
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows()== 1){
            return get_object_vars($query->result()[0]);
        }//if
        else{
            return FALSE;
        }//else
    }//getByPk
        
    
    
    
    
    function getBySingleValue($key,$value,$data_content){
            $this->db-> select($data_content);
            $this->db-> from($this->getTableName());
            $this->db-> where($key,$value);
            $this->db-> limit(1);
            $query = $this->db->get();
            if($query->num_rows() == 1){
                return get_object_vars($query->result()[0]);
                }//if
            else{
                return false;
                }//else
    }//getSingleData

    
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
    
    function check_Login_Status()
    {
        return ($this->session->userdata('logged_in'))? TRUE : FALSE;
    }
    
    
    
    function addDataToDb($new_data)
    {
        $this->db->insert($this->getTableName(),$new_data);
    }


    function updateData($key,$value,$update_data)
    {
        $this->db->where($key,$value);
        $this->db->update($this->getTableName(),$update_data);
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
