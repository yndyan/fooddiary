<?php
function get_needed_locations($method){

	$files = [];
	array_push($files, 'bootstrap.min.css','custom.css');

	switch($method){
		case 'show_add_course':
			array_push($files,	'jquery-2.1.1.min.js',
								'jquery-ui.css',
								'jquery-ui.js',	
								'add_course.js');
		break;
		case 'show_courses':
			array_push($files,	'jquery-2.1.1.min.js',
								'jquery-ui.css',
								'jquery-ui.js',
								'courses.js');
		break ;
		case 'show_add_diary':
			array_push($files,	'jquery-ui-timepicker-addon.css',
								'jquery-2.1.1.min.js',
								'jquery-ui.css',
								'jquery-ui.js',
								'jquery-ui-timepicker-addon.js',
								'common.js',
								'add_diary.js');
		break;
	   
	 } 
	return $files;
}

function create_script_url($file_location){
	$js_url = base_url("public/js/");
	return ' <script src="' . $js_url.'/'.$file_location. '"> </script> ';
}

function create_css_url($file_location){
	$css_url = base_url("public/css/");
	return  '  <link rel = "stylesheet" href = "'.$css_url.'/'.$file_location.'"> </link> ';

}
function get_file_extension($file_name){
	return  pathinfo($file_name)["extension"];
}
