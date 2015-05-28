<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Form_validation extends CI_Form_validation 
{
    
    function __construct() {
        parent::__construct();
        
    }//__construct
    
//-----------------------------------------------------------------------------   
    function checkDatabase($password,$username_or_email){
        $result = $this->CI->users_m->verifyUserData( $username_or_email,$password);
        
        if($result){
            $this->CI->session->set_userdata('logged_in',$result);
            return TRUE;
        } else {
            $this->set_message('checkDatabase','Username and/or password not valid ');
            return false;
        }//else
    }//checkDatabase
//-----------------------------------------------------------------------------
    function check_old_password($password,$username){
        if($this->CI->users_m->verifyUserData($username,$password)){
            return true;
        } else {
            $this->set_message('check_Old_Password','Old password is not valid ');
            return false;
        }//else
    }//check_old_password
//-----------------------------------------------------------------------------    
    function contain_number($input ){   
        if(preg_match('#[0-9]#',$input)){
            return true;
        } else {
            $this->set_message('contain_number','Must contain at least one number');
            return false;
        }//else 
    }//contain_number
//-----------------------------------------------------------------------------    
    function contain_Upper_Letter($input){
        if(preg_match('#[A-Z]#',$input)){
            return true;
        } else {
            $this->set_message('contain_Upper_Letter','Must contain at least one upper letter');
            return false;
        }//else
    }//contain_Upper_Letter

//-----------------------------------------------------------------------------    
//-----------------------------------------------------------------------------    
    function FV_CheckGroceryExist($groceryname){
        if ($this->CI->groceries_m->checkGroceryExist($groceryname)) {
            return TRUE;
        } else {
            $this->set_message('FV_CheckGroceryExist','No such grocery');
            return false;
        }
    }//FormCheckGroceryExist

//-----------   
    
    function FV_CheckGroceryNotExist($groceryname){
        if ($this->CI->groceries_m->checkGroceryExist($groceryname)) {
            $this->set_message('FV_CheckGroceryNotExist','Grocery already exist');
            return false;
        } else {
            return TRUE;
        }
    }//FV_CheckGroceryNotExist

//-----------------------------------------------------------------------------    
//-----------------------------------------------------------------------------    
    function FV_CheckReasonNotExist($reasonname){
        if ($this->CI->reasons_m->checkReasonExist($reasonname)) {
            $this->set_message('FV_CheckReasonNotExist','Reason already exist');
            return false;
        } else {
            return TRUE;
        }
    }//FormCheckGroceryExist

//-----------   
    
    function FV_CheckReasonExist($reasonname){
        if ($this->CI->reasons_m->checkReasonExist($reasonname)) {
            
            return true;
        } else {
            $this->set_message('FV_CheckReasonExist','No such reason');
            return false;
        }
    }//FormCheckGroceryExist

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
    function FV_CheckCourseExist($coursename){
        if ($this->CI->courses_m->checkCourseExist($coursename)) {
            return TRUE;
        } else {
            $this->set_message('FV_CheckCourseExist','No such course');
            return false;
        }//FormCheckCourseExist
    }//FV_CheckCourseExist
//--------
    function FV_CheckCourseNotExist($coursename){
        if ($this->CI->courses_m->checkCourseExist($coursename)) {
            $this->set_message('FV_CheckCourseNotExist','Course already exist');
            return false;
        } else {
            
            return true;
        }
    }//FV_CheckCourseNotExist
//----------------------------------------------------------------------------------
    function FV_date($date){
        $date_array = explode('-',$date);
        if((count($date_array) === 3) 
            && is_numeric($date_array[0])
            && is_numeric($date_array[1]) 
            && is_numeric($date_array[2])
            && $this->in_between($date_array[2],2000,2100)
            && checkdate ($date_array[1],$date_array[0],$date_array[2]))
        {
            return true;
        } else {
            $this->set_message('FV_date','Date not valid, dd-mm-yyyy');
            return false;
        }
    }//FV_date

//-----------------------------------------------------------------------------
    function FV_time($time){
        $time_array = explode(':',$time);
        if((count($time_array) === 2) 
            && is_numeric($time_array[0])
            && is_numeric($time_array[1]) 
            && $this->in_between($time_array[0],0,23)
            && $this->in_between($time_array[1],0,59))
        {
            return true;
        } else {
            $this->set_message('FV_time','Time not valid, hh:mm, 24hour');
            return false;
        }
    }//FV_time

//-----------------------------------------------------------------------------
    function form_validation_errors(){//mydo  delete this
      if (count($this->_error_array) === 0){
        return FALSE;
      } else {
        return $this->_error_array;
      }  
    }//error_array

//-----------------------------------------------------------------------------    

    private function in_between($input,$floor,$ceil){
        
        if(is_numeric($input) &&  is_numeric($floor) && is_numeric($ceil)){

            if(($input >= $floor)&&($input <= $ceil)){
                return true;
            } else {
                return false;
            }
        } else {
            return null;
        }

    }//in_between
}//class
