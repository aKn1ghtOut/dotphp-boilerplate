<?php

    ini_set('memory_limit', '-1');

    //OS Dependent Directory separator defined for use
    define("DS", DIRECTORY_SEPARATOR);

    //The Root directory of the installation.
    define("DocRoot", dirname(__FILE__) . DS);

	include_once "config/sys.conf.php";
	include_once "config/db.conf.php";
	include_once "config/meta.conf.php";
	//TODO: Manage configuration includes better ^

    //TODO: Work upon the error management include further
    include_once "core/error_routing.php";

    //TODO: Improve include management. Maybe use one include to cover all general includes
    include_once "core/plugin_resources.php";

    //The User Management Plugin initial include. The plugin decides what goes in its include file
    //This would typically include the session/cookie initialisation
    //TODO: Change the description ^
    include_once DocRoot . "core" . DS . "includes.db.php";

	include_once "core" . DS . "routeHandler.php";

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
		$path = DocRoot . 'frontend' . DS . 'home.php';
		include $path;
	}
	else
	{
		routeHandler::execRoute($_SERVER['REQUEST_URI']);
		if (routeHandler::$routeFound == false) {
			$path = DocRoot . 'frontend' . DS . $path . '.php';
			if (!file_exists($path)) {
				header("Location: " . __host . '404');
			}
			include $path;
		}
	}
	$themePath = DocRoot .'themes' . DS . currTheme . DS . 'containers' . DS . $GLOBALS['themeVari'] . '.php' ;

	include $themePath;
?>