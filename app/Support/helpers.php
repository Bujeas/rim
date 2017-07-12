<?php
// My common functions

define('CONSULTANT', 	1);
define('CONTRACTOR', 	2);
define('SUPPLIER', 		3);

define('LDAP_HOST',	'rkl-ads02.prasarana.com.my');
define('LDAP_PORT',	389);
// define('LDAP_USER',	'prasarana\khairulnizam.dahari');
//define('LDAP_PASS',	'Fjme90Q!');
define('LDAP_USER',	'prasarana\itapps');
define('LDAP_PASS',	'Zaq1@wsxCde3');

function set_active($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function bootstrap_alert()
{
	if(Session::has('STATUS_OK')) {
		echo '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h5>
				<div class="text-left"><i class="fa fa-check"></i> ' . Session::get('STATUS_OK') . '</div>
			</h5>
		</div>';
		
	}else if(Session::has('STATUS_FAIL')) {
		echo '<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h5>
				<div class="text-left"><i class="fa fa-warning"></i> ' . Session::get('STATUS_FAIL') . '</div>
			</h5>
		</div>';
	}else if(Session::has('STATUS_WARNING')) {
		echo '<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h5>
				<div class="text-left"><i class="fa fa-info-circle"></i> ' . Session::get('STATUS_WARNING') . '</div>
			</h5>
		</div>';
	}
}

function randomId() 
{
	$digits_needed = 8;
	$random_number = ''; // set up a blank string
	$count=0;

	while ( $count < $digits_needed ) {
	    $random_digit = mt_rand(0, 9);
	    
	    $random_number .= $random_digit;
	    $count++;
	}

	return $random_number;
}

function convert_sequence($number)
{
	$index = $number;
    $new_index = str_pad($index, 8, "0", STR_PAD_LEFT);
    $running_no = $new_index;

    return $running_no;
}

function stampToPicker($dt)
{
	if (strtotime($dt) <= 0) {
		return Date::today()->format('d/m/Y');
	} else {
		$date = new Date($dt);
		return $date->format('d/m/Y');
	}
}

function stampToTime($tm)
{
	if(strtotime($tm) <= 0){
		return Date::today()->format('h:i A');
	}else{
		$time = new Date($tm);
		return $time->format('h:i A');
	}
}

?>