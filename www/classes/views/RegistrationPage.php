<?php

class RegistrationPage extends Page {

	// Properties
	private $usernameError;
	private $username;

	public function contentHTML() {

		include 'templates/registrationform.php';

	}

	public function __construct($model) {

		// Use the parent constructor code
		parent::__construct($model);

		// If the registration form has been submitted
		if( isset( $_POST['register-account'] ) ) {

			$this->processNewAccount();

		}

	}

	public function processNewAccount() {

		// Make life easier
		$uName = trim($_POST['username']);

		// Save the form data for use later on
		$this->username = $uName;

		// Validate the username
		if( $uName == '' ) {
			$this->usernameError = '* Required';
		} elseif( $this->model->checkUsernameExists( $uName ) ) {
			$this->usernameError = 'Username already in use';
		}

	}

}









