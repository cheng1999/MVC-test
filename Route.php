<?php

include( $PATH['Common'] . 'Router.class.php' );

$Route= new Route();

$Route->get("/" , "Home.php@index()");


?>
