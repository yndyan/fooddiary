<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Form_validation extends CI_Form_validation
{
    
    function __construct() {
        parent::__construct();
    }
    
//    function __construct( $config = array() ){
//        parent::__construct($config);       
//    }//__construct
   
    function checkDatabase($password,$username_or_email)
    {
        $result = $this->CI->users_m->verifyUserData( $username_or_email,$password);
        
        if($result)
        {
            $this->CI->session->set_userdata('logged_in',$result);
            return TRUE;
        }
        else
        {
            $this->set_message('checkDatabase','Username and/or password not valid ');
            return false;
        }//else
    }//checkDatabase
    
    function check_old_password($password,$username)
    {
        if($this->CI->users_m->verifyUserData($username,$password)){
            return true;
        } else {
            $this->set_message('check_Old_Password','Old password is not valid ');
            return false;
        }//else
    }//check_old_password
    
    function contain_number($input )
    {   
        if(preg_match('#[0-9]#',$input)){
            return true;
        } else {
            $this->set_message('contain_number','Must contain at least one number');
            return false;
        }//else 
    }//contain_number
    
    function contain_Upper_Letter($input){
        if(preg_match('#[A-Z]#',$input)){
            return true;
        } else {
            $this->set_message('contain_Upper_Letter','Must contain at least one upper letter');
            return false;
        }//else
    }//contain_Upper_Letter
    
    function checkGroceryExist($groceryname){
        $user_id = $this->CI->session->userdata('logged_in')['user_id'];
        $what = ['groceryname'=>$groceryname, 'user_id'=>$user_id];
        
        $result =  $this->CI->user_groceries_m->chechValueExistsInDb($what);
        if ($result) {
            return TRUE;
        } else {
            $this->set_message('checkGroceryExist','No such grocery');
            return false;
        }
            
    }
    
    function form_validation_errors(){//mydo  delete this
      if (count($this->_error_array) === 0){
        return FALSE;
      } else {
        return $this->_error_array;
      }  
    }//error_array
}
