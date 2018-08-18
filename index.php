<?php
	include_once "config/sys.conf.php";
	include_once "config/db.conf.php";
	include_once "config/meta.conf.php";
	include_once "core/routeHandler.php";
	session_start();
	$linkPre = explode("/", $GLOBALS['subFol']);
	$path = strtok($_SERVER['REQUEST_URI'], '?');
	$path1 = explode("?", $path);
	$path = ltrim($path1[0], '/');
	$elem = explode('/', $path);

	/*
	* Getting the URL back together.
	*/
	$path = join("/", $elem);
	if(strlen($path) == 0) {
		$path = $GLOBALS['DocRoot'] . 'frontend/Home.php';
		include $path;
	}
	else
	{
		routeHandler::execRoute($_SERVER['REQUEST_URI']);
		if (routeHandler::$routeFound == false) {
			$path = $GLOBALS['DocRoot'] . '/' . 'frontend/' . $path . '.php';
			if (!file_exists($path)) {
				header("Location: " . $GLOBALS['host'] . 'Errors/404');
			}
			include $path;
		}
	}
	$themePath = $GLOBALS['DocRoot'] .'themes/'. $GLOBALS['currTheme'].'/' . $GLOBALS['themeVari'] . '.php' ;

	include $themePath;
?>