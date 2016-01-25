<?php

function is_ajax_request(){
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
	&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){    
    	return true;
	} else {
		return false;
	}

}