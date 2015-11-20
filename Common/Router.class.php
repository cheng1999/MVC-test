<?php

Class Route{

	//URI_GET is the URI path which is require and chopped the path of URI_ROOT......  read more at __construct() too
	protected $URI_GET;

	
	protected $error404;

	function __construct() {
		
		//REDIRECT_URL example: /post/Public/haha/1/2/3
		//output : /haha/1/2/3/
		//$this->URI_GET = @$_SERVER['REDIRECT_URL'] . '/';
		$this->URI_GET = str_replace(URI_ROOT , "" , @$_SERVER['REDIRECT_URL']);
		$this->URI_GET = rtrim($this->URI_GET, '/');
		
		//if router do work after uri validation , $error404 will become false finally
		$this->error404=true;
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
			$this->error404=false;
		}
	}
	
	//match uri without case sensitive
	public function match_ignoreCase($route_uri , $controller_file , $action){
		
		//make both string lower case and check matches or not
		$route_uri = strtolower($route_uri);
		$uri_get = strtolower($this->URI_GET);
		
		if ($route_uri == $uri_get){
			($controller_file ? include(PATH_Controller . $controller_file) : null);	//include controller if $controller_file is set
			call_user_func($action);	//do action
			$this->error404=false;
		}
	}
	
	//make uri available for $_GET
	public function get($route_uri , $controller_file , $action){
		$array_route_uri = explode("/" , $route_uri);
		$array_uri_get = explode("/" , $this->URI_GET);
		
		$match = (sizeof($array_route_uri)===sizeof($array_uri_get)?true:false);	
		if($match){
			for($i=0; $i<=sizeof($array_route_uri) ; $i++){
				if(@substr($array_route_uri[$i],0,1)=='{'){
					
					//convert '{username}' to 'username'
					preg_match('~\{(.*?)\}~', $array_route_uri[$i], $get);	
					//echo $get;
					$_GET[$get[1]]=$array_uri_get[$i];
				}
				else if(@$array_route_uri[$i]!==@$array_uri_get[$i]){
					
					$match=false;
					break ;
				}
			}
		}
		
		if($match){
			call_user_func($action);
			$this->error404 = false;
		}
	}
	
	public function check404(){
		if($this->error404==true){
			error404();
		}
	}

}

?>
