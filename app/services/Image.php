<?php namespace Services;


class Image {

	public $errors = array();

	public $path;

	public function __construct() {

	}

	public function upload($file , $user_id , $directory)
	{
		$file_name = $file->getClientOriginalName();
		$path = public_path()."\\images\\".$directory."\\";
		$real_extension = $file->getClientOriginalExtension();
		$dest_file = $path.$file_name.".".$real_extension;
		if($file->move($path , $dest_file)) {
			$this->path = $dest_file;
		}
		else {
			$errors[] = 'Unable to upload image';
		}
	}

	public function create($path , $user_id)
	{
		$photo = new \Photo;
		$photo->user_id = $user_id;
		$photo->path = $path;
		$photo->save();	
		return $photo;	
	}
}