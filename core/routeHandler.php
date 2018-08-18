<?
class routeHandler
{
	protected $subDir = "handler";
	// protected $baselink = $GLOBALS['host'] . $subDir . "/";
	protected $defPage = "index";
	protected $logNeeded = false;
	public static $routeFound = false;
	public static $theURI;
	function __construct()
	{

	}

	//abstract function Handle($routeAndReq); //the method that will handle the routes. To be defined by route handlers

	static function RedirToDefault()
	{
		header("Location: " . $GLOBALS['host'] . self::$subDir . "/" . self::$defPage);
	}
	static function RouteDoesntExist()
	{
		routeHandler::$routeFound = false;
	}
	static function routeExists($handler)
	{
		routeHandler::$routeFound=true;
		include_once $GLOBALS['DocRoot'] . $handler['handlerFile'] . ".router.php";
		if(class_exists("currHandler")) {
            new currHandler(self::$theURI);
        }
		else
			error_log("Could not find routeHandler class. File - " . $handler['handlerFile']);
	}
	static function getExistingHandlers($rName)
	{
		$routeRes = $GLOBALS['dbOB']->getV("SELECT * FROM routes WHERE routeName='" .  $rName . "'");
		if($routeRes[0] == false)
			return false;
		//print_r($routeRes[1]);
		//exit();
		return $routeRes[1];
	}
	static function extractSubName()
	{
		$theLink = substr(self::$theURI,
            (
                $GLOBALS['subFol']==""?
                    0
                :
                    (strlen($GLOBALS['subFol']) + 2)
            )
        );
		$theLink = ltrim($theLink, '/');
		$elem = explode('/', $theLink);
		$subName = array_shift($elem);
		$retArr = array('sub' => $subName
						);
		return $retArr;
	}
	static function getRoute()
	{
		$currSub = routeHandler::extractSubName();
		$handlerArr = routeHandler::getExistingHandlers($currSub['sub']);
		if(!$handlerArr)
		{
			return false;
		}
		else
			return $handlerArr;
	}
	static function execRoute($uri)
	{
	    self::$theURI = $uri;
		$handler = routeHandler::getRoute();
		if($handler == false)
		{
			routeHandler::RouteDoesntExist();
		}
		else
		{
			routeHandler::routeExists($handler);
		}
	}
}