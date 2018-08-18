<?php
$GLOBALS['themeVari'] = "basic";
$GLOBALS['titleSub'] = $GLOBALS['siteMeta']['desc'];
$GLOBALS['jsInclude'] = array("src/front/js/Home.js");
$GLOBALS['printPage'] = function()
{
	?>
    <link rel="stylesheet" href="<? echo $GLOBALS['astLink'] ; ?>src/front/css/Home.css">
<?php
}
?>