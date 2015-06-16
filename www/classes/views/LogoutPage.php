<?php

class LogoutPage extends Page {

	// Properties

	public function __construct( $model ) {

		parent::__construct( $model );

		// Log the user out
		if( isset($_SESSION['username']) ) {

			unset($_SESSION['username']);
			unset($_SESSION['privilege']);

		}

	}
	
	public function contentHTML() {

		include 'templates/logoutpage.php';

	}

}









