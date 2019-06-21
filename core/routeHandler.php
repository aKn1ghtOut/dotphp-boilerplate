<?
/*
 * TODO: Update the router model. This has remained relatively the same since it was initially created.
 * Revise the Router model and make changes as necessary. Also, prepare proper documentation for when needed.
 */
class routeHandler
{
	protected $subDir = "handler";
	protected $defPage = "home";
	protected $logNeeded = false;
	public static $routeFound = false;
	public static $theURI;
	function __construct()
	{

	}

	//abstract function Handle($routeAndReq); //the method that will handle the routes. To be defined by route handlers

	static function RedirToDefault()
	{
		header("Location: " . __host . self::$subDir . "/" . self::$defPage);
	}
	static function RouteDoesntExist()
	{
		routeHandler::$routeFound = false;
	}
	static function routeExists($handler)
	{
		routeHandler::$routeFound=true;
		include_once DocRoot . preg_replace("/\{DS}/", DS,$handler['handlerFile']) . ".router.php";
		if(class_exists("currHandler")) {
            new currHandler(self::$theURI);
        }
		else
			error_log("Could not find routeHandler class. File - " . $handler['handlerFile']);
	}
	static function getExistingHandlers($rName)
	{
	    $query_result = global_db\db_conn()->query("SELECT * FROM routes WHERE routeName='{$rName}'");
		if(mysqli_num_rows($query_result) != 1)
			return false;
		//print_r($routeRes[1]);
		//exit();
		return mysqli_fetch_assoc($query_result);
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
	static function redirToLogin()
    {
        header("Location: " . __host . "account/login");
    }
    static function redirTo404()
    {
        header("Location: " . __host . "404");
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