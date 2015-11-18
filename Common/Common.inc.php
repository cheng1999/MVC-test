<?php

function error404(){
    header('HTTP/1.1 404 Not Found');
    include (PATH_View.'404.php');
    exit();
}

?>
