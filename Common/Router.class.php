<?php

Class Route{

	//URI_ROOT is the path of $_SERVER['SCRIPT_NAME'],read more at __construct()
	protected $URI_ROOT;

	//URI_GET is the URI path which is require and chopped the path of URI_ROOT......  read more at __construct() too
	protected $URI_GET;



	function __construct() {

		//SCRIPT_NAME example: /post/Public/index.php
		//after replace : /post/Public/
		$this->URI_ROOT = dirname($_SERVER['SCRIPT_NAME']).'/';
		
		//REDIRECT_URL example: /post/Public/haha/1/2/3
		//output : /haha/1/2/3/
		//$this->URI_GET = @$_SERVER['REDIRECT_URL'] . '/';
		$this->URI_GET = str_replace($this->URI_ROOT , "" , @$_SERVER['REDIRECT_URL']);
		$this->URI_GET = rtrim($this->URI_GET, '/');
	}


	//routing	

	/*
		$route_uri : the URI to catch to routing.
		$controller_file : the file which require when run $action
		$action : if $route_uri is catch as match, what to do..
	*/
	
	//only match uri
	public function match($route_uri , $controller_file , $action){
		
		if ($route_uri == $this->URI_GET){	//directly run if match directly
			($controller_file ? include(PATH_Controller . $controller_file) : null);	//include controller if $controller_file is set
			call_user_func($action);	//do action
		}
	}
	
	//make uri available for $_GET
	public function get($route_uri , $controller_file , $action){	
		$array_route_uri = explode("/" , $route_uri);
		$array_URI_GET = explode("/" , $this->URI_GET);
		
		$match = (sizeof($array_route_uri)===sizeof($array_URI_GET)?true:false);	
		if($match){
			for($i=0; $i<=sizeof($array_route_uri) ; $i++){
				if(@substr($array_route_uri[$i],0,1)=='{'){
					
					//convert '{username}' to 'username'
					preg_match('~\{(.*?)\}~', $array_route_uri[$i], $get);	
					//echo $get;
					$_GET[$get[1]]=$array_URI_GET[$i];
				}
				else if(@$array_route_uri[$i]!==@$array_URI_GET[$i]){
					
					$match=false;
					break ;
				}
			}
		}
		
		if($match){
			call_user_func($action);
		}
	}

}

?>
