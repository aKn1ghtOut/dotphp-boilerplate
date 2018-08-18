<?php
include 'config/db.conf.php';
include 'config/meta.conf.php';
include 'config/sys.conf.php';
session_start();
if(isset($_GET['plug']) && isset($_GET['a']))
{
	$filetoInc = "plugins/".$_GET['plug']."/back/".$_GET['a'] . ".php";
}
else if(isset($_GET['a']))
{
	$filetoInc = 'backend/'.$_GET['a'].'.php';
}
if(file_exists($filetoInc))
{
	include $filetoInc;
}
else
{
	header("Location: " . $GLOBALS['host'] . "Errors/404");
}
?>