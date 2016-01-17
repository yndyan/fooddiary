<?php

function get_current_week_dates($date){
    
    
$days_dates_array = [ 'Mon' => '','Tue' => '','Wed' => '','Thu' => '','Fri' => '','Sat' => '','Sun' => ''];
       
foreach ($days_dates_array as $day => $value) {
	$timestamp = strtotime($day.' this week', strtotime($date));
	$days_dates_array[$day] = date( 'Y-m-d', $timestamp);
}
    
    
    return $days_dates_array;
}


