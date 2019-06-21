<?

$config_json = file_get_contents(DocRoot . "config/" . "dyn.config.json");
$config_object = json_decode($config_json);
$sys_conf = $config_object->sys_config;


//The name of the theme to use
//Edit this only if you have created a new theme
define("currTheme", $sys_conf->currTheme);

define("UserMgmtPlugin", $sys_conf->user_plugin);
 ?>
