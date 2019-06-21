<!DOCTYPE html>
<html>
	<head>
		<title>
            <? echo $GLOBALS['titleSub']; ?> - <? echo $GLOBALS['siteMeta']['title']; ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="description" content="<? echo $GLOBALS['siteMeta']['desc']; ?>" />
        <link rel="apple-touch-icon" sizes="57x57" href="<? echo __assets ; ?>images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<? echo __assets ; ?>images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<? echo __assets ; ?>images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<? echo __assets ; ?>images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<? echo __assets ; ?>images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<? echo __assets ; ?>images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<? echo __assets ; ?>images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<? echo __assets ; ?>images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<? echo __assets ; ?>images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<? echo __assets ; ?>images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<? echo __assets ; ?>images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<? echo __assets ; ?>images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<? echo __assets ; ?>images/favicon/favicon-16x16.png">
        <!--<link rel="manifest" href="/manifest.json">-->
        <meta name="msapplication-TileColor" content="#212121">
        <meta name="msapplication-TileImage" content="<? echo __assets ; ?>images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#212121">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<? echo __host; ?>themes/<? echo currTheme ; ?>/assets/cms/css/base.css" />
	</head>
	<body>
        <div id="pageBounds">
            <div class="com_rel">
                <div id="page_bg"></div>
                <div class="page_content">
                    <div class="com_rel">
                        <? $GLOBALS['printPage'](); ?>
                    </div>
                </div>
                <div class="navRibbon">
                    <div class="com_rel">
                        <div class="navRibbon_item selected" id="navRibbon_item_link_home">
                            <div class="navRibbon_item_bg"></div>
                            <span class="navRibbon_item_text">Home</span>
                        </div>
                        <div class="navRibbon_item" id="navRibbon_item_link_publisher">
                            <div class="navRibbon_item_bg"></div>
                            <span class="navRibbon_item_text">Publish</span>
                        </div>
                        <div class="navRibbon_item" id="navRibbon_item_link_about_us">
                            <div class="navRibbon_item_bg"></div>
                            <span class="navRibbon_item_text">About Us</span>
                        </div>
                        <div class="navRibbon_item navRibbon_item_right" id="navRibbon_item_link_account">
                            <div class="navRibbon_item_bg"></div>
                            <span class="navRibbon_item_text">Login / Register</span>
                        </div>
                    </div>
                </div>
                <div id="bookster_logo" class="centerSize">
                    <span class="logo_head"><img src="<? echo __assets ; ?>images/litico.png"></span><br>
                </div>
            </div>
        </div>
        <div id="cms-footer-area">
            <div class="com_rel"></div>
        </div>
        <?php
        if(isset($GLOBALS['jsInclude'])&&is_array($GLOBALS['jsInclude']))
        {
            foreach ($GLOBALS['jsInclude'] as $key)
            {
                $https = (strpos($key, "https://") !== false);
                $http = (strpos($key, "http://") !== false);
                if(($https != true) && ($http != true))
                    $key = __host . $key;
                ?>
                <script>console.log("<? echo $key . " " . ($https ? "https" : "no Https")  . " " . ($http ? "http" : "no Http"); ?>");</script>
                <script type="text/javascript" src="<? echo $key ; ?>"></script>
                <?php
            }
        }
        ?>
	</body>
</html>