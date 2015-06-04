<?php

Class Route{

	//URI_ROOT is the path of $_SERVER['SCRIPT_NAME'],read more at __construct()
	protected $URI_ROOT;

	//URI_GET is the URI path which is require and chopped the path of URI_ROOT......  read more at __construct() too
	protected $URI_GET;



	function __construct() {

		//SCRIPT_NAME example: /post/Public/index.php
		//after replace : post/Public/
		$this->URI_ROOT = str_replace("/index.php" , "" , $_SERVER['SCRIPT_NAME']);
		
		//REDIRECT_URL example: /post/Public/haha/1/2/3
		//after chop : /haha/1/2/3
		//or if it is null, set it to /
		$this->URI_GET = str_replace($this->URI_ROOT , "" , (@$_SERVER['REDIRECT_URL'] ? $_SERVER['REDIRECT_URL'] : "/"));
	}


	//routing	

	/*
		$route_uri is the URI to catch to routing.

		$action is if $route_uri is catch as match, what to do.
		it may like this "home.controller.class.php@Controller::index()"
			"home.controller.php"	: the file which is controller at Controllers' path.
			"@"			: to divide both variable alongsides.
			"index()" 		: the function which is require from controller.
	*/
	public function get($router_uri , $action){
		global $PATH;
		if ($router_uri == $this->URI_GET){

			$controller_file = explode("@" , $action)[0];	//explode with @ and the array[0] is left side of @
			include($PATH['Controller'] . $controller_file);	//include controller

			$function = explode("@" , $action)[1];	//array[1] is right side of @
		}
	}

}

?>
