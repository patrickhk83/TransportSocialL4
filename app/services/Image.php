<?php namespace Services;


class Image {

	public $errors = array();

	public $path;

	public function __construct() {

	}

	public function upload($file, $directory)
	{
		$file_name = $file->getClientOriginalName();
		$path = public_path()."/uploads/".$directory."/";
		$url = "/uploads/".$directory."/".$file_name;
		$real_extension = $file->getClientOriginalExtension();
		$dest_file = $path.$file_name;
		if($file->move($path , $dest_file)) {
			$this->path = $url;
		}
		else {
			$errors[] = 'Unable to upload image';
		}
	}
}