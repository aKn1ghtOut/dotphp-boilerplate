<?php

class inputValidator
{
	static function email($toBeVal)
	{
		if(filter_var($toBeVal, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return false;
	}
}