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
		//$_SERVER['HTTP_REFERER'] - страница откуда пришёл пользователь
	}
	header("Location: $redirect");
	exit();
}

function h($str){
    return htmlspecialchars($str,ENT_QUOTES); // константа ENT_QUOTES преобразует одинарные кавчки
}