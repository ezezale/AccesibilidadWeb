<?php
// src/AppBundle/FileUploader.php
namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
	private $targetDir;

	public function __construct($targetDir)
	{
		$this->targetDir = $targetDir;
	}

	public function upload(&$obj)
	{
		if ($obj->getImage()){
			$fileName = $obj->getName().'.'.$obj->getImage()->guessExtension();
	
			$obj->getImage()->move($this->targetDir, $fileName);
		
			return $fileName;
		}
		return null;
	}
	
	public function getTargetDir(){
		return $this->targetDir;
	}
}
