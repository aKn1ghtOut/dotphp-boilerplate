<?
/*
* This file contains everything about the website that will affect the user experience
* The $GLOBALS['siteMeta'][] variables contain the meta information and the basic details about the website that the end user would be able to look at.
*/

$GLOBALS['siteMeta'] = array(
				//This is the title of the website which appears in the title bar and may be used by Themes
				"title" => "A New PHP Site",
				
				//This is the meta description of the website and would be included on every page
				"desc" => "Made using the dotPHP Boilerplate",
				
				//The meta tags to be used by search engines
				"tags" => "dotphp, php, web, boilerplate"
				);

$GLOBALS['domain'] = "dotphp";
/*
 * This is the domain or sub-domain you are installing the script to.
 * Note that this does not include the sub-folder heirarchy. It just contains the domain/sub-domain.
 * For example, "localhost", "c0mmand0.in" and "ins.c0mmand0.in" are
 * all valid values.
 * Remember to not keep a "/" in the end.
 */
 
$GLOBALS['subFol'] = "";
/*
 * This will have the same value as the $GLOBALS['RootApp'] variable in sys.conf.php
 */
 
 //Don't edit the following line
 $GLOBALS['host'] = ("http://" . $GLOBALS['domain'] . "/") . ($GLOBALS['subFol'] != ""?("" . $GLOBALS['subFol'] . "/"):"") ;
 $GLOBALS['astLink'] = $GLOBALS['host'] . 'assets/';


ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
session_set_cookie_params(604800, "/", $GLOBALS['domain'], false, true);
session_name(str_replace(".", "_", $GLOBALS['domain']) . "session_cookie");

?>