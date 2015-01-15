<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('registration');
        $this->load->model('users','',TRUE);
        $this->load->view('authCtrl/authViewHeader');
    }


    function site_info()
    {
        $this->load->view('siteInfoView');
    }

    function login()
    {
        if($this->input->post('username_or_email'))
        {
            $username_or_email = trim($this->input->post('username_or_email',TRUE));//XSS_CLEAN
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('username_or_email', 'username or email', 'trim|required');
            $this->form_validation->set_rules('password','password',"trim|required|xss_clean|callback_checkDatabase[$username_or_email]");
            if($this->form_validation->run()==FALSE)
            {
                $this->load->view('authCtrl/loginView');
            }
            else
            {
                if($this->session->userdata('logged_in')['userStatus'] === users::USER_STATUS_NOT_VERIFIED)
                {
                    $this->session->set_flashdata('verify_warning',"Please verify email address ");
                }
                redirect('home_ctrl','refresh');
            }
        }
        else
        {
            $this->load->view('authCtrl/loginView');
        }

    }

    function checkDatabase($password,$username_or_email)
    {
        $result = $this->users->verifyUserData( $username_or_email,$password);
        if($result)
        {
            $this->session->set_userdata('logged_in',$result);
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('checkDatabase','Username and/or password not valid ');
            return false;
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        redirect('home_ctrl','refresh');
    }

    function register_new_user()
    {
        if($this->input->post('username'))
            {
            $password = trim($this->input->post('password',TRUE));//ovo mora xss clean i trim!!
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|callback_contain_number|callback_contain_Upper_Letter');//mora trim 2 puta
            $this->form_validation->set_rules('confpass','confirm password',"trim|xss_clean|required|callback_compare_pass[$password]");
            $this->form_validation->set_rules('email','email',"trim|xss_clean|required|valid_email|is_unique[users.email]");
            $this->form_validation->set_rules('fullname','full name','xss_clean|trim');

            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('authCtrl/registrationView');
            }
            else
            {
                do
                {
                    $verify_code = Generate_random_string(users::VERIFY_CODE_LENGTH);
                }while($this->users->chechValueExistsInDb('verifyCode',$verify_code));

                $new_user_data = [
                    'username'=>$this->input->post('username'),
                    'password'=>$password,
                    'verifycode' => $verify_code,
                    'email'=>$this->input->post('email'),
                    'fullname'=>$this->input->post('fullname'),
                    'userStatus'=> users::USER_STATUS_NOT_VERIFIED,
                    'verifyExpTime'=> time()+ users::TIMESTAMP_HOUR
                ];

                $this->users->addDataToDb($new_user_data);
                $this->session->set_flashdata('verify_warning',"Email is sent to you, please verify ");
                $this->session->set_userdata('logged_in',array('username' => $this->input->post('username'),'userStatus'=>users::USER_STATUS_NOT_VERIFIED));
                $email_message = array('subject' => 'Verification email', 'message' => 'Go to '.base_url().'index.php/user_ctrl/verify_email/'.$verify_code.'');
                $this->users->sendVerificationEmail($new_user_data['email'],$email_message);
                //TODO functon that add food reasons to new 
                redirect('home_ctrl','refresh');
            }
        }
        else
        {
            $this->load->view('authCtrl/registrationView');
        }

    }

    function send_password_verify_code()
    {
        if($this->input->post('username_or_email'))
            {

            $username_or_email = trim($this->input->post('username_or_email',TRUE));
            if($username_or_email)
            {
                $email = $this->users->checkUserExist($username_or_email );

                if($email)
                {
                    do
                    {
                        $password_reset_code = Generate_random_string(users::PASS_RESET_CODE_LENGTH);
                    }while ($this->users->chechValueExistsInDb('passResetCode',$password_reset_code));

                    $this->users->updateData('email',$email,array('passResetCode' => $password_reset_code,'passResetExpTime'=> (time() + users::TIMESTAMP_MINUTE )));
                    $email_message = array('subject' => 'Password reset email', 'message' => 'Go to '.base_url().'index.php/auth_ctrl/reset_password/'.$password_reset_code.'');
                    $this->users->sendVerificationEmail($email,$email_message);
                    $this->session->set_flashdata('verify_warning','Email with link sent');
                    redirect('auth_ctrl/login','refresh');
                }
                else
                {
                    $this->session->set_flashdata('verify_warning','There is no such user');
                    redirect('auth_ctrl/send_password_verify_code','refresh');
                }
            }
            else
            {
                $this->session->set_flashdata('verify_warning','Username/Email field is required');
                redirect('auth_ctrl/send_password_verify_code','refresh');

            }
        }
        else
        {
            $this->load->view('authCtrl/passResetView');
        }

    }

    function reset_password($reset_pass_verify_code = NULL)
    {
        if(strlen($reset_pass_verify_code)=== users::PASS_RESET_CODE_LENGTH)
        {
            $pass_reset_code_status = $this->users->checkPassResetCodeStatus($reset_pass_verify_code);
            switch($pass_reset_code_status)
            {
                case users::PASS_RESET_CODE_OK:
                {
                    $new_password = trim($this->input->post('new_password',TRUE));//xss clean + trim
                    if($new_password)
                    {
                        $this->form_validation->set_error_delimiters('<font color = "#ff4500">','</font>');
                        $this->form_validation->set_rules('new_password','nova sifra','trim|required|min_length[6]|callback_contain_number|callback_contain_Upper_Letter');// dodaj da sadrzi Veliko slovo i Broj!!
                        $this->form_validation->set_rules('new_confpass','potvrdica',"trim|xss_clean|required|callback_compare_pass[$new_password]");

                        if($this->form_validation->run() == FALSE)
                        {
                            $data = array('pass_code' =>  $reset_pass_verify_code);
                            $this->load->view('authCtrl/passResetView',$data);
                        }
                        else
                        {
                            $this->users->updateUserData('passResetCode',$reset_pass_verify_code,array('password' => $new_password,
                                                                                                           'passResetCode'   => NULL,
                                                                                                           'passResetExpTime'=> NULL));
                            //$data = array('auth_message' =>  'Password successfully changed, please login');
                            //$this->load->view('auth_view/login',$data);
                            $this->session->set_flashdata('verify_warning','Password successfully changed, please login');
                            redirect('auth_ctrl/login','refresh');
                        }
                    }
                    else
                    {
                        $data = array('pass_code' =>  $reset_pass_verify_code);
                        $this->load->view('authCtrl/newPassView',$data);
                    }
                }
                    break;

                case users::PASS_RESET_CODE_EXPIRED:
                {
                    //$data = array('auth_message' =>  'Password reset code expired, enter mail or username and press "forget" button');
                    //$this->load->view('auth_view',$data);
                    $this->session->set_flashdata('verify_warning','Password reset code expired!');
                    redirect('auth_ctrl/send_password_verify_code','refresh');
                }
                    break;

                case users::PASS_RESET_CODE_NOT_EXIST:
                {
                    //$data = array('auth_message' =>  'Password reset code not exist!');
                    //$this->load->view('auth_view',$data);
                    $this->session->set_flashdata('verify_warning','Password reset code not exist!');
                    redirect('auth_ctrl/send_password_verify_code','refresh');
                }
                    break;
            }
        }
        else
        {
            //$data = array('auth_message' =>  'Password reset code is not correct length');
            //$this->load->view('auth_view',$data);
            $this->session->set_flashdata('verify_warning','Password reset code is not correct length');
            redirect('auth_ctrl/send_password_verify_code','refresh');
        }
    }


    function contain_Upper_Letter($input)
    {
        if(preg_match('#[A-Z]#',$input))
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('contain_Upper_Letter','Must contain at least one upper letter');
            return false;
        }
    }

    function compare_pass($confpass,$password)
    {

        if($password===$confpass)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('compare_pass','Password and confirm password must be the same');
            return false;
        }
    }

    function contain_number($input)
    {
        if(preg_match('#[0-9]#',$input))
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('contain_number','Must contain at least one number');
            return false;
        }
    }


}