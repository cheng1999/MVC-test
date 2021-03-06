<?php
include( PATH_Common . 'Router.class.php' );


/*	Route->get($route_uri , $controller_file , $action)

	examples:
		$Route->match("" , "Home.php" , "Home::index");
		$Route->match("sayhi" , null , function(){echo 'hi';});
		$Route->match_ignoreCase("bringmeto403" , null , function(){error403();});
		$Route->get("someone/{username}" , "Profile.php" , "Profile::index");
*/

$Route= new Route();

$Route->match("" , "Home.php" , "Home::index");	//if root require nothing

$Route->match("sayhi" , null , function(){echo 'hi';});

$Route->match_ignoreCase("bringmeto403" , null , function(){error403();});

$Route->get("someone/{username}" , null , function(){echo $_GET['username'];});

$Route->get("{username}/{id}", null, function(){
	echo $_GET['username'].$_GET['id'];
	}
	);

//check 404, must end with this line in router
$Route->check404();

?>
