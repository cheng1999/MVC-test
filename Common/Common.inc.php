<?php

function error404(){
    header('HTTP/1.1 404 Not Found');
    include (PATH_View.'errors/404.php');
    exit();
}

function error403(){
    header('HTTP/1.1 403 Forbidden');
    include (PATH_View.'errors/403.php');
    exit();
}
?>
