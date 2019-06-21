<?php
/*
 * Created by @C0mmmand0 - Anant Bhasin
 * This makes file uploads much simpler.
 *
 * This is intended for this framework
 * only but I will also include a
 * version that can be used anywhere.
 */

class fUpManager
{
	/* Attributes of the uploaded file: */
	protected $type;
	protected $tmp_name;
	protected $file_size;
	protected $inpFile;

	/* Details of the path where the file would be uploaded.
	Instantiated in the constructor: */
	protected $defaultPath;
	protected $customPath = false;
	protected $pathAddOrSubst;

	public $errS;
	public $new_name;

	/* Filters to check against */
	protected $typesAllowed = "jpg|jpeg|png|gif|apk|zip|docx|doc|pdf|ppt|pptx";
	protected $maxSize;
	protected $random_name = true;

	function __construct($array_params)
	{
        $this->defaultPath = DocRoot . "assets1/" ;

        $this->inpFile = $array_params['inpFile'];
        $this->customPath = $array_params['customPath'];
        $this->pathAddOrSubst = $array_params['pathAddOrSubst'];
        $this->typesAllowed = $array_params['typesAllowed'];
        $this->maxSize = $array_params['maxSize'];
        $this->random_name = $array_params['random_name'];

        $this->errS = "";
        $this->errS .= $this->validateValues();
        $this->fileValues();
        $this->errS .= $this->validateFile();
        $this->errS .= $this->moveFile();
	}

	function validateValues()
	{
        $err = "Errors: ";
        if(!is_bool($this->customPath))
            $err .= "customPath needs to be a boolean. ";
        if(!is_bool($this->random_name))
            $err .= "randomName needs to be a boolean. ";
        if (!is_string($this->typesAllowed))
            $err .= "typesAllowed needs to be a String. ";
        if(!is_string($this->pathAddOrSubst))
            $err .= "pathAddOrSubst has to be a String. ";
        if(!is_string($this->inpFile['tmp_name']))
            $err .= "inpFile needs to be a \$_FILES resource. ";
        if(!is_int($this->maxSize))
            $err .= "maxSize needs to be an integer(in MB).";

        if($err != "Errors: ")
        {
            error_log($err);
            return 0;
        }
        else
            return 1;
	}
	function fileValues()
	{
        $this->type = pathinfo($this->inpFile['name'], PATHINFO_EXTENSION);
        $this->tmp_name = $this->inpFile['tmp_name'];
        $this->file_size = $this->inpFile['size'];
	}
	function validateFile()
	{
        if(     (!in_array($this->type, explode("|", $this->typesAllowed)))
            ||  $this->file_size > ($this->maxSize * 1000000)
            ||  strlen($this->tmp_name) > 249)
            return 0;
        else
            return 1;
	}
	function moveFile()
	{
        $newName = $this->random_name ? md5(uniqid(rand())) : $this->inpFile['name'];
        $this->new_name = $newName . "." . $this->type;
        $newPath = $this->customPath ? $this->pathAddOrSubst : ($this->defaultPath . $this->pathAddOrSubst);
        if(!move_uploaded_file($this->tmp_name, $newPath . $newName . "." . $this->type))
            return 0;
        else {
			chmod($newPath . $newName . "." . $this->type, 0777);
			return 1;
		}
	}
}