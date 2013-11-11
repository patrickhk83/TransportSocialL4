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
		$url = "/images/".$directory."/".$file_name;
		$real_extension = $file->getClientOriginalExtension();
		$dest_file = $path.$file_name;
		if($file->move($path , $dest_file)) {
			$this->path = $url;
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