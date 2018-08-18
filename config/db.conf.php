<?
//This is the configuration file for the database.
//Please edit the values here when installing on a new server
$GLOBALS['DB'] = array(
						//The database host
						"host" => "localhost",

						//The Database user
						"user" => "root",

						//The Database user's password
						"pass" => "",

						//The name of the database to use. Please make sure it is empty before using it
						"dbname" => "database_name",

						//The timezone to be used for entering time
						"timezone" => "Asia/Kolkata"
				);
class dbC
{
	public $conne = "";
	function construct()
	{
		$this->conne = new mysqli($GLOBALS['DB']['host'], $GLOBALS['DB']['user'], $GLOBALS['DB']['pass'], $GLOBALS['DB']['dbname']);
		if($this->conne->connect_errno)
			exit("Internal Error occured: " . $this->conne->connect_error);
		$this->conne->query('SET time_zone="' . $GLOBALS['DB']['timezone'] . '" ; ');
		return $this->conne;
	}
	function runQ($str)
	{
		//Function for manipulative statements. Retuns true/false based on success or failure or query.
		$ret = $this->conne->query($str);
		if(!$ret)
			die($this->conne->error);
			//return false;
		else
			return true;
	}
	function getV($str)
	{
		//Function to get values as an associative array; For running SELECT statements
		$ret = $this->conne->query($str);
		$aRet = array();
		$i=1;
		if(!$ret)
			return array(false, $str);
		elseif ($ret->num_rows < 1) {
			return array(false, "not found");
		}
		else
			{
            $aRet[0] = true;
			while ($tempRet = $ret->fetch_assoc()) {
				$aRet[$i] = $tempRet;
				$i++;
			}
			//unset($aRet[sizeof($aRet) - 1]);
			return $aRet;
			}
	}
	function _stop()
	{
		mysqli_close($this);
	}
	function verifySQLEntry($str)
	{
		return true;
	}

	function Conn()
	{
		return $this->conne;
	}
}

$GLOBALS['dbOB'] = new dbC();
$GLOBALS['dbOB']->construct();
?>