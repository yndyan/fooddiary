<?php
//require_once APPPATH.'models/MY_Model.php';
Class Users_m extends MY_Model
{
    const USER_STATUS_NOT_VERIFIED = '1';
    const USER_STATUS_VERIFIED = '2';
    const VERIFY_CODE_LENGTH = 32;
    const PASS_RESET_CODE_LENGTH = 32;
    const VERIFY_CODE_NOT_EXIST = 'V_error1';
    const PASS_RESET_CODE_EXPIRED = 'P_error1';
    const PASS_RESET_CODE_NOT_EXIST = 'P_error2';
    const PASS_RESET_CODE_OK = 'P_ok';
    const TIMESTAMP_MINUTE = 60;
    const TIMESTAMP_HOUR   = 3600;
    const TIMESTAMP_DAY    = 86400;
    static private $email_config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'rastayndyan@gmail.com',
        'smtp_pass' => 'ipsilon0',
        'mailpath' => 'usr/sbin/sendmail',
        'charset'  => 'iso-8859-1',
        'wordwrap' => TRUE,
    );
    
    CONST table_name = 'users';
    protected $TablePkName = "user_id";
    
//----------------------------------------------------------------------------    
    function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }

//----------------------------------------------------------------------------    
 
    function verifyUserData($username_or_email, $password){
        $this -> db -> select($this->TablePkName.',username,userStatus');
        $this -> db -> from('users');
        $this -> db -> where('username = '."'".$username_or_email."'");
        $this -> db -> where('password = '."'".$password."'");
        $this -> db -> or_where('email = '."'".$username_or_email."'");
        $this -> db -> where('password = '."'".$password."'");
        $this -> db -> limit(1);
        $query= $this -> db -> get();

        if($query -> num_rows() == 1){
            return get_object_vars($query->result()[0]);
        } else {
            return false;
        }//else
    }//verifyUserData
//----------------------------------------------------------------------------

    function checkUserExist($username_or_email)
    {
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('username',$username_or_email);
        $this->db->or_where('email',$username_or_email);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows()==1){
            return $query->result()[0]->email;
        } else {
            return false;
        }//else
    }//checkUserExist
//----------------------------------------------------------------------------

    function sendVerificationEmail($user_email,$email_message){
        $this->email->initialize(self::$email_config);
        $this->email->set_newline("\r\n");
        $this->email->from('rastayndyan@gmail.com','www.mojprvisajt.net');
        $this->email->to($user_email);
        $this->email->subject($email_message['subject']);
        $this->email->message($email_message['message']);
        $this->email->send();
        //show_error($this->email->print_debugger());//mydo keep this for errors
        
    }//sendVerificationEmail
    
//----------------------------------------------------------------------------
    
    function verifyEmailUsingCode($email_verify_code){
        $result = $this->getOneBySingleValue('verifyCode',$email_verify_code,'username,verifyExpTime,userStatus');
        if($result)
        {
            if($result['verifyExpTime']>time()){
                $this->updateData(['verifyCode'=>$email_verify_code],array('userStatus' => self::USER_STATUS_VERIFIED,
                                                                        'verifyCode' => NULL,
                                                                        'verifyExpTime' => NULL));
                $result['userStatus'] = self::USER_STATUS_VERIFIED;
                return $result;
            }//if
            else{
                return $result;
            }//else 
        }//if
        else{
            return self::VERIFY_CODE_NOT_EXIST;
        }//else
    }//verifyEmailUsingCode

//----------------------------------------------------------------------------
    
    function checkPassResetCodeStatus($password_reset_code){
        $result = $this->getOneBySingleValue('passResetCode',$password_reset_code,'passResetExpTime');

        if($result){
            return ($result > time())? self::PASS_RESET_CODE_OK : self::PASS_RESET_CODE_EXPIRED;
        }//if
        else{
            return self::PASS_RESET_CODE_NOT_EXIST;
        }//else
    }//checkPassResetCodeStatus
    


}//class