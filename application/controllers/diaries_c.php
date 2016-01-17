<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diaries_c extends MY_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->model('diary_m');
        $this->load->helper('date');
    }
    function index(){//mydo delete this 
    	$this->load->view('diaries_c/add_diary_entry_v');
        //this is main page, it would be changed to add
    }
//------------------------------------------------------------------------------

    function show_add_diary(){//mydo not working 
        $this->load->view('diaries_c/add_diary_entry_v');
    }//add food
    
    function show_diaries(){
        $page_number = ($this->input->get('page')!=null) ? $this->input->get('page') : 1;
        
        
        $date = ($this->input->get('date ')!=null)? $this->input->get('date ') : date('Y-m-d') ;
        $data=  $this->diary_m->getSinglePageDiaries($page_number,5,['diary_date'=> $date]);
        $data['day_dates'] = get_current_week_dates($date);
        $this->load->view('diaries_c/show_diaries_v',$data);
    }//show_diaries
    
    public function delete_diary(){
        $diary_id = trim($this->input->get('diary_id',TRUE));
        if($this->diary_m->deleteDiary($diary_id)){
            $this->session->set_flashdata('diary_messages',"Diary successfully deleted");
        } else {
            $this->session->set_flashdata('diary_messages',"Error deleting diary");
        }
        redirect('diaries_c/show_diaries','refresh');
    }//delete_grocery
    
}