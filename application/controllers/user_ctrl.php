<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users','',TRUE);
        $this->load->helper('registration');

    }



    function display_user_data()
    {
        if($this->users->check_Login_Status())
        {
            $session_data = $this->session->userdata('logged_in');
            $this->load->view('homeCtrl/homeViewHeader',$session_data);
            $data = $this->users->getOneBySingleValue('username',$session_data['username'],'username,email,fullName');
            $this->load->view('userCtrl/userDataView',$data);
        }
        else
        {
            $this->session->set_flashdata('verify_warning','Please login to proceed!');
            redirect('auth_ctrl/login','refresh');
        }
    }//function display_user_data()

    function change_user_data()
    {
    if($this->users->check_Login_Status())
        {
        $session_data = $this->session->userdata('logged_in');
        $this->load->view('homeCtrl/homeViewHeader',$session_data);

        $data = $this->users->getOneBySingleValue('username',$session_data['username'],'username,email,fullName');
        if($this->input->post('email'))
            {
            $this->load->view('homeCtrl/homeViewHeader',$session_data);
            $this->form_validation->set_error_delimiters('<font color="red">','</font>');
            $email = trim($this->input->post('email',TRUE));//ovo mora xss clean i trim!!
            $fullname = trim($this->input->post('fullname',TRUE));//ovo mora xss clean i trim!!

            if($email!==$data['email'])
                {
                $this->form_validation->set_rules('email','email',"trim|xss_clean|required|valid_email|is_unique[users.email]");
                $new_user_data['email'] = $email;
                $new_user_data['userStatus'] = users::USER_STATUS_NOT_VERIFIED;
                }
            if($fullname!== $data['fullName'])
                {
                $this->form_validation->set_rules('fullname','ime','xss_clean|trim');
                $new_user_data['fullName'] = $fullname;
                }

            if($this->form_validation->run() == FALSE)
                {
                    $this->load->view('/userCtrl/ChangeUserDataView',$data);
                }
            else
                {
                    $this->users->updateData('username',$session_data['username'],$new_user_data);
                    $data = $this->users->getOneBySingleValue('username',$session_data['username'],'username,email,fullName');
                    $this->load->view('/userCtrl/userDataView',$data);
                }
            }
            else
            {
                $this->load->view('/userCtrl/ChangeUserDataView',$data);

            }
        }
    else
        {
            $this->session->set_flashdata('verify_warning','Please login to proceed!');
            redirect('auth_ctrl/login','refresh');
        }
    }

    function change_user_password()
    {
        if($this->users->check_Login_Status())
        {
            $session_data = $this->session->userdata('logged_in');
            $this->load->view('homeCtrl/homeViewHeader',$session_data);
            if($this->input->post('old_password'))
            {
                $this->form_validation->set_error_delimiters('<font color="red">','</font>');
                $new_password = trim($this->input->post('new_password',TRUE));//ovo mora xss clean i trim!!
                $this->form_validation->set_rules('old_password', 'old password', "trim|required|callback_check_Old_Password[$session_data[username]]");
                $this->form_validation->set_rules('new_password', 'new password', 'trim|required|min_length[6]|callback_contain_number|callback_contain_Upper_Letter');//mora trim 2 puta
                $this->form_validation->set_rules('new_confpass','confirm password',"trim|xss_clean|required|callback_compare_pass[$new_password]");

                if($this->form_validation->run() === FALSE)
                {
                    $this->load->view('userCtrl/NewPassView');
                }
                else
                {
                    $this->users->updateData('username',$session_data['username'],array('password'=> $new_password));
                    $data = $this->users->getOneBySingleValue('username',$session_data['username'],'username,email,fullName');
                    $this->load->view('userCtrl/userDataView',$data);
                }
            }
            else
            {
                $this->load->view('userCtrl/NewPassView');
            }
        }
        else
        {
            $this->session->set_flashdata('verify_warning','Please login to proceed!');
            redirect('auth_ctrl/login','refresh');
        }



    }

    function check_old_password($password,$username)//
    {
        if($this->users->verifyUserData($username,$password))
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('check_Old_Password','Old password is not valid ');
            return false;
        }
    }

    function send_new_verify_code()
    {
        if($this->users->check_Login_Status())
        {
            $session_data = $this->session->userdata('logged_in');
            do
            {
                $new_verify_code = Generate_random_string(users::VERIFY_CODE_LENGTH);
            }while($this->users->chechValueExistsInDb('verifyCode',$new_verify_code));

            $this->users->updateData('username',$session_data['username'], array('verifyCode' => $new_verify_code,'verifyExpTime'=> time() + users::TIMESTAMP_HOUR));
            $email = $this->users->getOneBySingleValue('username',$session_data['username'],'email');

            if($email)
            {
                $email_message = array('subject' => 'Verification email', 'message' => 'smekeru klikni na: '.base_url().'index.php/user_ctrl/verify_email/'.$new_verify_code.'');
                $this->users->sendVerificationEmail($email,$email_message);
                $this->session->set_flashdata('verify_warning','New validation code sent!');
                redirect('home_ctrl','refresh');
            }
            else
            {
                $this->session->set_flashdata('verify_warning','Unknown error!');
                redirect('auth_ctrl/login','refresh');
            }
        }
        else
        {
            $this->session->set_flashdata('verify_warning','Please login to proceed!');
            redirect('auth_ctrl/login','refresh');
        }

    }

    function verify_email($email_verify_code = NULL)
    {
        if(strlen($email_verify_code)===users::VERIFY_CODE_LENGTH)
        {
            $result = $this->users->verifyEmailUsingCode($email_verify_code);

            $session_data = $this->session->userdata('logged_in');

            if($result === users::VERIFY_CODE_NOT_EXIST)
            {
                $this->session->set_flashdata('verify_warning','Verify code not exist');
                if($session_data)
                {
                    redirect('home_ctrl','refresh');
                }
                else
                {
                    redirect('auth_ctrl/login','refresh');
                }
            }
            elseif($result['userStatus'] === users::USER_STATUS_NOT_VERIFIED)
            {
                $this->session->set_flashdata('verify_warning','Verify code expired');
                if($session_data)
                {
                    redirect('home_ctrl','refresh');
                }
                else
                {
                    redirect('auth_ctrl/login','refresh');
                }
            }
            else if($result['userStatus'] === users::USER_STATUS_VERIFIED)
            {
                $this->session->set_flashdata('verify_warning','Email successfully verified');

                if($session_data === false)
                {
                    $this->session->set_userdata('logged_in',$result);
                }
                redirect('home_ctrl','refresh');
            }
        }
        else
        {
            $this->session->set_flashdata('verify_warning','Validation code length error');
            redirect('auth_ctrl/login','refresh');
        }
    }

    function contain_upper_letter($input)//TODO ove funkcije su duple, ne znam kako da izbacim iz kontrolera
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