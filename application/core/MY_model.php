<?php
class MY_Model extends CI_Model
{
    protected $TablePkName = "id";
    protected $user_id = '';
    CONST table_name = '';
    
    function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('logged_in')['user_id'];
    }
    function getTableName()
    {
        return static::table_name;
    }


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
        
    function getPageCount($items_per_page = 2){
        $this->db->where('user_id',  $this->user_id);
        $this->db->from($this->getTableName());//mydo change to getTablename
        return (int)ceil($this->db->count_all_results()/$items_per_page);
        
    }//
 
    function getSinglePageData($items_per_page=2,$page_number = 1,$data_content = null){
        
        $offset = $items_per_page * ($page_number-1);
        $this->db->select($data_content);
        $this->db->from($this->getTableName());
        $this->db->where('user_id',  $this->user_id);
        $this->db->limit($items_per_page,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }//getSinglePageData

    
    
    function getOneBySingleValue($key,$value,$data_content){//mydo replace this function wit getLikeWhere
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

    
    function chechValueExistsInDb($what)
    {
        $this->db->where($what);// probaj i probaj obrnuto!!
        $this->db->from($this->getTableName());
        return ($this->db->count_all_results() > 0);
    }    
    
    function deleteByKey($key = NULL, $value= NULL){
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
        return $this->db->insert_id();
    }


    function updateData($where,$update_data)
    {
        $this->db->where($where);
        $this->db->update($this->getTableName(),$update_data);
        return $this->db->affected_rows();
    }//updateData
    
  
    
    function geLikeWhere($data_content,$like = null,$where = null,$limit = 10){
        $this->db->select($data_content);
        $this->db->from($this->getTableName());
        if($where){
            $this->db->where($where);
        }
        if($like){
            $this->db->like($like);
        }
        $this->db-> limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }//geLikeWhere
    
}
