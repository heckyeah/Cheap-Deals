<?php

class ImageUploader {

	// Properties
	private $imageName;
	private $imageType;
	private $imageSize;
	private $imageError;
	private $imageTemp;
	private $inputName;
	private $destination;
	public $errorMessage;
	private $imageTypes = ['image/jpeg', 'image/png', 'image/gif'];


	// Methods (functions)
	public function upload( $inputName, $destination ) {
	
		// Extract the information about the image
		$this->imageName  = $_FILES[$inputName]['name'];
		$this->imageType  = $_FILES[$inputName]['type'];
		$this->imageSize  = $_FILES[$inputName]['size'];
		$this->imageError = $_FILES[$inputName]['error'];
		$this->imageTemp  = $_FILES[$inputName]['tmp_name'];

		$this->inputName   = $inputName;
		$this->destination = $destination;

		// Show the max file size if needed
		if( $_POST['MAX_FILE_SIZE'] < 1000 ) {
			$maxSize = $_POST['MAX_FILE_SIZE'].' Bytes';
		} elseif($_POST['MAX_FILE_SIZE'] < 1000000) {
			$maxSize = ($_POST['MAX_FILE_SIZE'] / 1000) .' KiloBytes';
		} else {
			$maxSize = ($_POST['MAX_FILE_SIZE'] / 1000000) .' MegaBytes';
		}

		// Check for errors
		switch( $this->imageError ) {
			case 1: $this->errorMessage = 'Image too large for server';	break;
			case 2: $this->errorMessage = 'Image size exceeds form filesize limit of '.$maxSize; break;
			case 3: $this->errorMessage = 'Image only partially uploaded'; break;
			case 4: $this->errorMessage = 'Image failed to load / no image selected'; break;
		}

		// If an error occured
		if( $this->errorMessage != '' ) {
			return false;
		}

		// File type
		if( !in_array( $this->imageType, $this->imageTypes ) ) {
			$this->errorMessage = 'Invalid file type';
			return false;
		}

		// Generate a unique ID to be used on the file name
		$unique = uniqid('', true);
		$this->imageName = $unique.$this->imageName;

		// Move the image from the temp location to the final destination
		move_uploaded_file($this->imageTemp, $this->destination.$this->imageName);

	}

}