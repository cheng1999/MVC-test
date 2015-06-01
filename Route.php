<pre>
<?php

	//SCRIPT_NAME example: /post/Public/index.php
	//after chop : /post/Public/
	$URI_ROOT = chop($_SERVER['SCRIPT_NAME'],"/index.php");

	//REDIRECT_URL example: /post/Public/haha/1/2/3
	//after chop : haha/1/2/3
	$URI_PATH = chop($_SERVER['REDIRECT_URL'],$URI_ROOT);

	//testing
	print_r(explode("/", $_SERVER['REDIRECT_URL']));	
	print_r($_SERVER);
	print_r($PATH);
?>

