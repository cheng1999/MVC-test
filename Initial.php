<?php


// Loading the configuration
require_once( __DIR__ . '/Config.php' );


// Set Path Variables (local Path not URI!)
$PATH=array(
	'ROOT'  => __DIR__ . '/',
	'Common'=> __DIR__ . '/Common/',

	// The path to run in web directory
	/*
		$_SERVER['SCRIPT_FILENAME'] may like this : /var/www/html/post/Public/index.php
		after chop: /var/www/html/post/Public
	*/
	'Public'=> chop($_SERVER['SCRIPT_FILENAME'],'index.php'),

	// MVC architecture
	'Model'		=> __DIR__ . '/Models/',
	'Controller'	=> __DIR__ . '/Controllers/',
	'View'		=> __DIR__ . '/Views/',
);


// For sql Usage
require_once( $PATH['Common'].'MysqliDb.php' );
$DB = new MysqliDb (
	$CONFIG['DB_HOST'],	//Database's Host
	$CONFIG['DB_USER'],	//user
	$CONFIG['DB_PASS'],	//password
	$CONFIG['DB_NAME']	//Database's Name
) or die( mysql_error() ); 


// Start session
session_start();


// Router to indicate MVC
include( $PATH['ROOT'] . 'Route.php' );
?>

