<?php

include( $PATH['Common'] . 'Router.class.php' );

$Route= new Route();


//Route->get($router_uri , $controller_file , $action)
$Route->get("/" , "Home.php" , "Home::index");


?>
