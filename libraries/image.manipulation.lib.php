<?php

/**
 * Image library created for the core of Comfest.in
 * By: Anant Bhasin/C0mmand0
 */
class imageMan
{
	protected $realImage = false;

	//Properties of the provided image
	protected $img_type;
	protected $img_width;
	protected $img_height;
	protected $img_resource;
	protected $img_size;
	protected $img_name;
	protected $img_loc;

	protected $new_resource;
	public $new_name;

	/*
	 * Planned functions:
	 * 		createThumbnail(width, height)
	 * 		checkSizeRange(lWidth, lHeight, tWidth, tHeight)
	 * 		checkRatioRange(lRatio, tRatio) //width:height
	 * 		resize(width, height)
	 * 		resizeConst(max_dimen)
	 * 		crop(width, height, alignX, alignY)
	 * 		moveNewTo(location, name)
	 * 		openImage(imageLocation)
	 */

	function __construct($imageLocation = null)
	{
		if($imageLocation == null||!is_string($imageLocation))
			return;
		$image = $this->openImage($imageLocation);
		$this->img_loc = $imageLocation;
		if($image)
			$this->realImage = true;
	}
	function openImage($im)
	{
		if(!is_file($im))
			return false;

		switch (pathinfo($im, PATHINFO_EXTENSION))
		{
			case "png":
				$this->img_resource = imagecreatefrompng($im);
				break;
			case "jpg":
				$this->img_resource = imagecreatefromjpeg($im);
				break;
			case "jpeg":
				$this->img_resource = imagecreatefromjpeg($im);
				break;
			default:
				return false;
		}
		list($this->img_width, $this->img_height, $this->img_type) = getimagesize($im);

		return true;
	}
	function checkSizeRange($lW, $lH, $tW, $tH)
	{
		if($this->img_width > $tW || $this->img_width < $lW ||$this->img_height > $tH ||$this->img_height < $lH)
			return false;
	}
	function checkRatioRange($lR, $tR)
	{
		$ratio = $this->img_width / $this->img_height ;
		if ($ratio > $tR)
			return "Higher";
		if ($ratio < $lR)
			return "Lower";
		return true;
	}
	function createThumbnail($w, $h)
	{
		if($this->img_width < $w || $this->img_height < $h)
			return false;
		if(is_resource($this->new_resource))
			return false;

		$resultRatio = $w/$h;
		$orRatio = $this->img_width/$this->img_height;

		$this->new_resource = imagecreatetruecolor($w, $h);
		$orDim = array("w" => 0, "h" => 0);
		$toCut = array("x" => 0, "y" => 0);

		if($orRatio > $resultRatio) {

			$orDim["h"] = $this->img_height;
			$orDim["w"] = $w * ($orDim["h"] / $h);

			$toCut["x"] = ($this->img_width - $orDim["w"]) / 2;
		}
		else
		{

			$orDim["w"] = $this->img_width;
			$orDim["h"] = $h * ($orDim["w"] / $w);

			$toCut["y"] = ($this->img_height - $orDim["h"]) / 2;
		}

		imagecopyresampled($this->new_resource, $this->img_resource, 0, 0, $toCut["x"], $toCut["y"], $w, $h, $orDim["w"], $orDim["h"]);
	}
	function moveNewTo($loc)
	{
		if(!is_resource($this->new_resource))
			return false;
		$this->new_name = md5(uniqid(rand()));
		$imagethis = imagejpeg($this->new_resource, $loc, 99);
		if(file_exists($loc))
			chmod($loc, 0777);
		return($imagethis);
	}
}