<?php
class debug_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users','',TRUE);
        $this->load->model('food_types','',TRUE);
        $this->load->model('meals_diary','',TRUE);
        $this->load->model('intake_reasons','',TRUE);
        
    }
    function index()
    {
         
        
        //var_dump( $this->users->verifyUserData('dusan','Zile33'));
        //var_dump ($this->intake_reasons->GetUserReasons('fo'));
        $this->load->view('debugCtrl/debug_view');
       

    }
    function vrati(){
    $like_value = $this->input->post("like_value");
    $result = $this->intake_reasons->getUserreasons($like_value);
    echo json_encode($result);
    //echo 'cao';
    }


}