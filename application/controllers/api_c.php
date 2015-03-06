<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_c extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('user_reasons_m');
        $this->load->model('user_groceries_m');
    }
            
    function getAutocompleteReasons(){
        //check login status
        //mydo add form validatio
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->user_reasons_m->api_searchReasons($like_value);
        echo json_encode($result);//TODO vrati
        
    }
    function getAutocompleteGroceries(){
        //check login status
        //mydo add form validatio
        $like_value = strtolower($this->input->get('term'));//mydo xss clean and trim!
        $result = $this->user_groceries_m->api_searchGroceries($like_value);
        echo json_encode($result);//TODO vrati
        
    }
}

