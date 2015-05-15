<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_c extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper('registration');
    }//__construct

    function display_user_data(){
        //mydo change this to get data from database 
        $session_data = $this->session->userdata('logged_in');
        $data = $this->users_m->getOneBySingleValue('username',$session_data['username'],'username,email,fullname,userstatus');
        
        $this->load->view('user_c/show_userdata_v',$data);
    }//function display_user_data()

    function change_user_data(){//mydo edit because my form validation 
    
        $session_data = $this->session->userdata('logged_in');
        $data = $this->users_m->getOneBySingleValue('username',$session_data['username'],'username,email,fullName');
        if($this->input->post('email')){
            
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $email = trim($this->input->post('email',TRUE));//ovo mora xss clean i trim!!
            $fullname = trim($this->input->post('fullname',TRUE));//ovo mora xss clean i trim!!

            if($email!==$data['email']){
                $this->form_validation->set_rules('email','email',"trim|xss_clean|required|valid_email|is_unique[users.email]");
                $new_user_data['email'] = $email;
                $new_user_data['userStatus'] = users_m::USER_STATUS_NOT_VERIFIED;
                }//$email!==$data['email']
                
            if($fullname!== $data['fullName']){
                $this->form_validation->set_rules('fullname','ime','xss_clean|trim');
                $new_user_data['fullName'] = $fullname;
                }//$fullname!== $data['fullName']

            if($this->form_validation->run() == FALSE){
                    $this->load->view('/user_c/change_userdata_v',$data);
            } else {
                $this->users_m->updateData('username',$session_data['username'],$new_user_data);
                $data = $this->users_m->getOneBySingleValue('username',$session_data['username'],'username,email,fullname,userstatus');
                $this->load->view('/user_c/show_userdata_v',$data);
            }//else 
        } else {
            $this->load->view('/user_c/change_userdata_v',$data);
        }//else
    }//change_user_data

    function change_user_password(){

        $session_data = $this->session->userdata('logged_in');
        if($this->input->post('old_password'))
        {
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('old_password', 'old password', "trim|xss_clean|required|check_Old_Password[$session_data[username]]");
            $this->form_validation->set_rules('new_password', 'new password', 'trim|xss_clean|required|min_length[6]|contain_number|contain_Upper_Letter');
            $this->form_validation->set_rules('new_confpass','confirm password',"trim|xss_clean|required|matches[new_password]");

            if($this->form_validation->run() === FALSE)
            {
                $this->load->view('user_c/newpass_v');
            }
            else
            {
                $new_password = $this->input->post('new_password');
                $this->users_m->updateData('username',$session_data['username'],array('password'=> $new_password));
                $data = $this->users_m->getOneBySingleValue('username',$session_data['username'],'username,email,fullname,userstatus');
                $this->load->view('user_c/show_userdata_v',$data);
            }
        } else {
            $this->load->view('user_c/newpass_v');
        }//else
    }//change_user_password

    

    function send_new_verify_code(){
        
        $session_data = $this->session->userdata('logged_in');
        do{
            $new_verify_code = Generate_random_string(users_m::VERIFY_CODE_LENGTH);
        } while($this->users_m->chechValueExistsInDb(['verifyCode'=>$new_verify_code]));

        $this->users_m->updateData('username',$session_data['username'], array('verifyCode' => $new_verify_code,'verifyExpTime'=> time() + users_m::TIMESTAMP_HOUR));
        $email = $this->users_m->getOneBySingleValue('username',$session_data['username'],'email');

        if($email)
        {
            $email_message = array('subject' => 'Verification email', 'message' => 'smekeru klikni na: '.base_url().'index.php/user_c/verify_email/'.$new_verify_code.'');
            $this->users_m->sendVerificationEmail($email,$email_message);
            $this->session->set_flashdata('verify_warning','New validation code sent!');
            redirect('Diary_c','refresh');//mydo return this
        }
        else
        {
            $this->session->set_flashdata('verify_warning','Unknown error!');
            redirect('Auth_c/login','refresh');
        }
        
    }//send_new_verify_code

    function verify_email($email_verify_code = NULL){//mydo check this after creatin base controler
    
        if(strlen($email_verify_code)===users_m::VERIFY_CODE_LENGTH)
        {
            $result = $this->users_m->verifyEmailUsingCode($email_verify_code);

            $session_data = $this->session->userdata('logged_in');

            if($result === users_m::VERIFY_CODE_NOT_EXIST){
                $this->session->set_flashdata('verify_warning','Verify code not exist');
                if($session_data){
                    redirect('Diary_c','refresh');
                } else {
                    redirect('Auth_c/login','refresh');
                }//else
            }
            elseif($result['userStatus'] === users_m::USER_STATUS_NOT_VERIFIED)
            {
                $this->session->set_flashdata('verify_warning','Verify code expired');
                if($session_data){
                    redirect('Diary_c','refresh');
                } else {
                    redirect('Auth_c/login','refresh');
                }//else
            }
            else if($result['userStatus'] === users_m::USER_STATUS_VERIFIED)
            {
                $this->session->set_flashdata('verify_warning','Email successfully verified');

                if($session_data === false){
                    $this->session->set_userdata('logged_in',$result);
                }
                redirect('Diary_c','refresh');
            }
        }
        else
        {
            $this->session->set_flashdata('verify_warning','Validation code length error');
            redirect('Auth_c/login','refresh');
        }
    }//verify_email

}//class