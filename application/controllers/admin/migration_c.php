<?php

class Migration_c extends CI_Controller
{

	function __construct (){
		parent::__construct();
	}

	function index(){
       echo "welcome to migrations";
    }
    
    //fooddiary/index.php/admin/migration_c/migration/ahirgubfahgbn325344mhb56b4j7j57hkj67hn5n67knj76lk5nlj5nl7nkl567nl7n5nj765h4hkj5b64hj5b6hbj
	function migration($code = 0){
	    if($code === 'ahirgubfahgbn325344mhb56b4j7j57hkj67hn5n67knj76lk5nlj5nl7nkl567nl7n5nj765h4hkj5b64hj5b6hbj'){	
	    	$this->load->library('migration');
			if (! $this->migration->latest()) {
				show_error($this->migration->error_string());
			} else {
				echo 'Migration worked!';
			}//if
	       

	    } else {
	    	$this->session->set_flashdata('verify_warning','Wrong code!');
	    	redirect('auth_c/login','refresh');
	    
	    }//else if code
	}//migration


	//fooddiary/index.php/admin/migration_c/copy_default_tables/ahirgubfahgbn325344mhb56b4j7j57hkj67hn5n67knj76lk5nlj5nl7nkl567nl7n5nj765h4hkj5b64hj5b6hbj
	function copy_default_tables($code = 0){
	 	if($code === 'ahirgubfahgbn325344mhb56b4j7j57hkj67hn5n67knj76lk5nlj5nl7nkl567nl7n5nj765h4hkj5b64hj5b6hbj'){	
        	$this->load->model('reasons_m');
        	$this->load->model('groceries_m');
        	$this->reasons_m->copyDefaultReasonsToNewUser();
        	$this->groceries_m->copyDefaultGroceriesToNewUser();
                echo 'copy finished';
    	} else {
    		$this->session->set_flashdata('verify_warning','Wrong code!');
	    	redirect('auth_c/login','refresh');
    	}
    }//reasons
}
