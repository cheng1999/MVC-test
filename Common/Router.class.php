<?php

Class Route{

	//URI_ROOT is the path of $_SERVER['SCRIPT_NAME'],read more at __construct()
	protected $URI_ROOT;

	//URI_GET is the URI path which is require and chopped the path of URI_ROOT......  read more at __construct() too
	protected $URI_GET='haha';



	public function __construct() {

		//SCRIPT_NAME example: /post/Public/index.php
		//after chop : /post/Public/
		$this->URI_ROOT = chop($_SERVER['SCRIPT_NAME'] , "index.php");
		
		//REDIRECT_URL example: /post/Public/haha/1/2/3
		//after chop : haha/1/2/3
		//$this->URI_GET = chop($_SERVER['REDIRECT_URL'] , $this->URI_ROOT);
		$this->URI_ROOT = 'haha2';
		echo $this->URI_ROOT . $this->URI_GET;
		echo 'test';
	}


	//testing
//	print_r(explode("/", $_SERVER['REDIRECT_URL']));	

	//routing	
	public function get($router_uri , $controller_file , $function){
		echo $this->URI_GET;
		if ($router_uri == $this->URI_GET){
			include($PATH['Controllers'] . $controller_file);
			eval($function);
		}
	}

}

?>
