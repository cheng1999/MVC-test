<?php

// Loading the configuration
require_once( __DIR__ . '/Config.php' );


// Set Path Variables (local Path not URI!)
define('PATH_ROOT', __DIR__ . '/'); 
define('PATH_Common', __DIR__ . '/Common/'); 

	// The path to run in web directory
	/*
		$_SERVER['SCRIPT_FILENAME'] may like this : /var/www/html/post/Public/index.php
		output: /var/www/html/post/Public/
	*/
define('PATH_Public', dirname($_SERVER['SCRIPT_FILENAME']) . '/');

	//MVC architecture
define('PATH_Model', __DIR__ . '/Models/');
define('PATH_Controller', __DIR__ . '/Controllers/');
define('PATH_View', __DIR__ . '/Views/');


// Loading some common functions
include( PATH_Common.'Common.inc.php' );

// For sql Usage
require_once( PATH_Common.'MysqliDb.php' );
$DB = new MysqliDb (
	$CONFIG['DB_HOST'],	//Database's Host
	$CONFIG['DB_USER'],	//user
	$CONFIG['DB_PASS'],	//password
	$CONFIG['DB_NAME']	//Database's Name
) or die( mysql_error() ); 


// Start session
session_start();

// Router to indicate MVC
include( __DIR__ . '/Route.php' );
?>

