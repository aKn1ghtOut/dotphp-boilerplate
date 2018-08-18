<!DOCTYPE html>
<html>
	<head>
		<title>
            <? echo $GLOBALS['titleSub']; ?> - <? echo $GLOBALS['siteMeta']['title']; ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="description" content="<? echo $GLOBALS['siteMeta']['desc']; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<? echo $GLOBALS['astLink']; ?>src/<? echo $GLOBALS['currTheme'] ; ?>/cms/base.css" />
	</head>
	<body>
        <h1 style="margin:30px;">Basic theme</h1>
        <?php
        if(isset($GLOBALS['jsInclude'])&&is_array($GLOBALS['jsInclude']))
        {
            foreach ($GLOBALS['jsInclude'] as $key)
            {
                $https = (strpos($key, "https://") !== false);
                $http = (strpos($key, "http://") !== false);
                if(($https != true) && ($http != true))
                    $key = $GLOBALS['astLink'] . $key;
                ?>
                <script>console.log("<? echo $key . " " . ($https ? "https" : "no Https")  . " " . ($http ? "http" : "no Http"); ?>");</script>
                <script type="text/javascript" src="<? echo $key ; ?>"></script>
                <?php
            }
        }
        ?>
	</body>
</html>