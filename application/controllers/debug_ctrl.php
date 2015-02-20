<?php
class debug_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users');
        $this->load->model('food_types');
        $this->load->model('meals_diary');
        $this->load->model('default_reasons');
        
    }
    function index()
    {
         
        
        //var_dump( $this->users->verifyUserData('dusan','Zile33'));
        //var_dump ($this->users_reasons->GetUserReasons('fo'));
        //$this->load->view('debugCtrl/debug_view');
        $res = $this->default_reasons->getDefaultReasons();
        var_dump($res);
       

    }
    function vrati(){
    //$like_value = $this->input->post("like_value");
    //$result = $this->users_reasons->getUserreasons($like_value);
    //echo json_encode($result);
 
                
        echo ' [{"value":"item1"},{"value":"item2"},{"value":"item3"},{"value":"item4"}]';//TODO brisi

        

    }


}