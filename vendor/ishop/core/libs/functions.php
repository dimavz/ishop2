<?php

function debug($array){
	echo "<pre>";
	echo print_r($array, true);
	echo "</pre>";
}

function redirect($http = false)
{
	if($http)
	{
		$redirect = $http;
	}
	else{
		$redirect = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: PATH;
	}
	header("Location: $redirect");
	exit();
}