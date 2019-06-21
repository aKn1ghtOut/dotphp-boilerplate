<?
/*
* This file contains everything about the website that will affect the user experience
* The $GLOBALS['siteMeta'][] variables contain the meta information and the basic details about the website that the end user would be able to look at.
*/

$config_json = file_get_contents(DocRoot . "config/" . "dyn.config.json");
$config_object = json_decode($config_json);
$meta_conf = $config_object->meta;

$GLOBALS['siteMeta'] = array(
				//This is the title of the website which appears in the title bar and may be used by Themes
				"title" => $meta_conf->siteMeta->title,
				
				//This is the meta description of the website and would be included on every page
				"desc" => $meta_conf->siteMeta->desc,
				
				//The meta tags to be used by search engines
				"tags" => $meta_conf->siteMeta->tags
				);

define("__domain", $meta_conf->domain);
/*
 * This is the domain or sub-domain you are installing the script to.
 * Note that this does not include the sub-folder heirarchy. It just contains the domain/sub-domain.
 * For example, "localhost", "c0mmand0.in" and "ins.c0mmand0.in" are
 * all valid values.
 * Remember to not keep a "/" in the end.
 */

$GLOBALS['subFol'] = $meta_conf->subFol;
/*
 * This will have the same value as the $GLOBALS['RootApp'] variable in sys.conf.php
 */
 
//Don't edit the following line
define("__host", ("http://" . __domain . "/") . ($GLOBALS['subFol'] != ""?("" . $GLOBALS['subFol'] . "/"):"") );
define("__assets", __host . 'assets/');

//ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
//ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
//session_set_cookie_params(604800, "/", __domain, false, true);
//session_name(str_replace(".", "_", __domain) . "session_cookie");

?>