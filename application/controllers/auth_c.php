<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_c extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('registration');
        $this->load->model('users_m');
        $this->load->model('user_reasons_m');
        $this->load->model('user_groceries_m');
        $this->load->view('templates/public_header_v');
    }   

    function login()
    {
        if($this->input->post('username_or_email'))
        {
            $username_or_email = trim($this->input->post('username_or_email',TRUE));//XSS_CLEAN
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('username_or_email', 'username or email', 'trim|required');
            $this->form_validation->set_rules('password','password',"trim|required|xss_clean|checkDatabase[$username_or_email]");
            if($this->form_validation->run()==FALSE)
            {
                $this->load->view('auth_c/login_v');
            }
            else
            {
                if($this->session->userdata('logged_in')['userStatus'] === users_m::USER_STATUS_NOT_VERIFIED)
                {
                    $this->session->set_flashdata('verify_warning',"Please verify email address ");
                }
                redirect('Diary_c/add_food','refresh');
            }
        }
        else
        {
            $this->load->view('auth_c/login_v');
        }

    }


    function logout()
    {
        $this->session->unset_userdata('logged_in');
        redirect('auth_c/login','refresh');//mydo change this to login
    }

    function register_new_user()
    {
        if($this->input->post('username'))
            {
            //ovo mora xss clean i trim!!
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            
            $this->form_validation->set_rules('username', 'username', 'trim|xss_clean|required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'password', 'trim|xss_clean|required|min_length[6]|contain_number|contain_Upper_Letter');//mora trim 2 puta
            $this->form_validation->set_rules('confpass','confirm password',"trim|xss_clean|required|matches[password]");
            $this->form_validation->set_rules('email','email',"trim|xss_clean|required|valid_email|is_unique[users.email]");
            $this->form_validation->set_rules('fullname','full name','xss_clean|trim');

            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('auth_c/registration_v');
            }
            else
            {
                do{
                    $verify_code = Generate_random_string(users_m::VERIFY_CODE_LENGTH);
                } while($this->users_m->chechValueExistsInDb(['verifyCode'=>$verify_code]));
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $new_user_data = [
                    'username'=> $username,
                    'password'=>$password,//mydo add password hash
                    'verifycode' => $verify_code,
                    'email'=>$this->input->post('email'),
                    'fullname'=>$this->input->post('fullname'),
                    'userStatus'=> users_m::USER_STATUS_NOT_VERIFIED,
                    'verifyExpTime'=> time()+ users_m::TIMESTAMP_HOUR
                ];

                $user_id = $this->users_m->addDataToDb($new_user_data);
                //var_dump($user_id); die(); //mydo delete this
                $this->session->set_flashdata('verify_warning',"Email is sent to you, please verify ");
                $this->session->set_userdata('logged_in',array('user_id'=>$user_id,'username' => $username,'userStatus'=>users_m::USER_STATUS_NOT_VERIFIED));
                $email_message = array('subject' => 'Verification email', 'message' => 'Go to '.base_url().'index.php/user_c/verify_email/'.$verify_code.'');
                $this->users_m->sendVerificationEmail($new_user_data['email'],$email_message);
                
                $this->user_reasons_m->copyDefaultReasonsToNewUser();
                $this->user_groceries_m->copyDefaultGroceriesToNewUser();
                redirect('Diary_c/add_food','refresh');
            }
        }
        else
        {
            $this->load->view('auth_c/registration_v');
        }

    }

    function send_password_verify_code()
    {
        if($this->input->post('username_or_email'))
            {

            $username_or_email = trim($this->input->post('username_or_email',TRUE));
            if($username_or_email)
            {
                $email = $this->users_m->checkUserExist($username_or_email );

                if($email)
                {
                    do{
                        $password_reset_code = Generate_random_string(users_m::PASS_RESET_CODE_LENGTH);
                    }while ($this->users_m->chechValueExistsInDb(['passResetCode'=>$password_reset_code]));

                    $this->users_m->updateData(['email' => $email],['passResetCode' => $password_reset_code,'passResetExpTime'=> (time() + users_m::TIMESTAMP_MINUTE )]);
                    $email_message = array('subject' => 'Password reset email', 'message' => 'Go to '.base_url().'index.php/Auth_c/reset_password/'.$password_reset_code.'');
                    $this->users_m->sendVerificationEmail($email,$email_message);
                    $this->session->set_flashdata('verify_warning','Email with link sent');
                    redirect('Auth_c/login','refresh');
                }
                else
                {
                    $this->session->set_flashdata('verify_warning','There is no such user');
                    redirect('Auth_c/send_password_verify_code','refresh');
                }
            }
            else
            {
                $this->session->set_flashdata('verify_warning','Username/Email field is required');
                redirect('Auth_c/send_password_verify_code','refresh');

            }
        }
        else
        {
            $this->load->view('auth_c/passreset_v');
        }

    }

    function reset_password($reset_pass_verify_code = NULL)
    {
        if(strlen($reset_pass_verify_code)=== users_m::PASS_RESET_CODE_LENGTH)
        {
            $pass_reset_code_status = $this->users_m->checkPassResetCodeStatus($reset_pass_verify_code);
            switch($pass_reset_code_status)
            {
                case users_m::PASS_RESET_CODE_OK:
                {
                    $new_password = trim($this->input->post('new_password',TRUE));//xss clean + trim
                    if($new_password){
                        $this->form_validation->set_error_delimiters('<font color = "#ff4500">','</font>');
                        $this->form_validation->set_rules('new_password','new password','trim|xss_clean|required|min_length[6]|contain_number|contain_Upper_Letter');// dodaj da sadrzi Veliko slovo i Broj!!
                        $this->form_validation->set_rules('new_confpass','confirm password',"trim|xss_clean|required|matches[new_password]");

                        if($this->form_validation->run() == FALSE){
                            $data = array('pass_code' =>  $reset_pass_verify_code);
                            $this->load->view('auth_c/newpass_v',$data);
                        } else {
                            $this->users_m->updateData(['passResetCode'=>$reset_pass_verify_code],array('password' => $new_password,
                                                                                                    'passResetCode'   => NULL,
                                                                                                    'passResetExpTime'=> NULL));
                           
                            $this->session->set_flashdata('verify_warning','Password successfully changed, please login');
                            redirect('Auth_c/login','refresh');
                        }//else $this->form_validation->run() == FALSE
                    } else {
                        $data = array('pass_code' =>  $reset_pass_verify_code);
                        $this->load->view('auth_c/newpass_v',$data);
                    }//else $new_password
                }
                break;

                case users_m::PASS_RESET_CODE_EXPIRED:
                {
                    $this->session->set_flashdata('verify_warning','Password reset code expired!');
                    redirect('Auth_c/send_password_verify_code','refresh');
                }
                break;

                case users_m::PASS_RESET_CODE_NOT_EXIST:
                {
                    $this->session->set_flashdata('verify_warning','Password reset code not exist!');
                    redirect('Auth_c/send_password_verify_code','refresh');
                }
                break;
            }
        }
        else
        {
            
            $this->session->set_flashdata('verify_warning','Password reset code is not correct length');
            redirect('Auth_c/send_password_verify_code','refresh');
        }
    }
    
    function about()
    {
        $this->load->view('about_v');
    }//about()

   
}