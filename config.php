<?php
ob_start();
session_start();
ini_set('memory_limit', '-1');

include_once('config-settings.php');

if(localhost()) {
	define('DEVMODE', true);
	define('ERROR_REPORT', false);
} else if(strpos($_SERVER['SERVER_NAME'], 'tailsweb')) {
	define('DEVMODE', true);
	define('ERROR_REPORT', false);
} else {
	define('DEVMODE', false);
	define('ERROR_REPORT', false);
}


if(ERROR_REPORT) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('xdebug.var_display_max_depth', '10');
	ini_set('xdebug.var_display_max_children', '256');
	ini_set('xdebug.var_display_max_data', '1024');
}
define( 'ERROR', 0 );
define( 'SUCCESS', 1 );

function localhost() {
	$whitelist = array('127.0.0.1', '::1');
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

$curren_link = $_SERVER['SCRIPT_NAME'];

function baseURL(){
	$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$base_url .= "://";
	$base_url .= $_SERVER['SERVER_NAME'];
	 $base_url;
}

function is_ssl() {
	if ( isset($_SERVER['HTTPS']) ) {
		if ( 'on' == strtolower($_SERVER['HTTPS']) )
		return true;
		if ( '1' == $_SERVER['HTTPS'] )
		return true;
	} elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
		return true;
	}
	return false;
}

include_once('config-db.php');
include_once('classes/db.php');
include_once('classes/user.php');

$User = new UserManager( $conn );

