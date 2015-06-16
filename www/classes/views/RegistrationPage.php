<?php

class RegistrationPage extends Page {

	// Properties
	private $usernameError;
	private $username;
	private $email;
	private $emailError;
	private $passwordError;

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
		$email = trim($_POST['email']);
		$pass1 = $_POST['password1'];
		$pass2 = $_POST['password2'];

		// Save the form data for use later on
		$this->username = $uName;
		$this->email    = $email;

		// Validate the username
		if( strlen($uName) > 20 || strlen($uName) < 3 ) {
			$this->usernameError = 'Username must be between 3 and 20 characters';
		} elseif( !preg_match( '/^[a-zA-Z0-9_\-.]{3,20}$/', $uName ) ) {
			$this->usernameError = 'Use only letters, numbers, hyphens, underscores and periods';
		} elseif( $this->model->checkUsernameExists( $uName ) ) {
			$this->usernameError = 'Username already in use';
		}

		// Validate the E-Mail
		if( strlen($email) < 6 || strlen($email) > 254 ) {
			$this->emailError = 'E-Mail is an invalid length';
		} elseif( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			$this->emailError = 'Invalid E-Mail format. example@example.com';
		} elseif( $this->model->checkEmailExists( $email ) ) {
			$this->emailError = 'E-Mail already in use';
		}

		// Validate the passwords
		if( strlen($pass1) < 8 ) {
			$this->passwordError = 'Passwords must be at least 8 characters long';
		} elseif( $pass1 != $pass2 ) {
			$this->passwordError = 'Passwords do not match';
		}

		// If there are no errors, then register a new account!
		if( $this->usernameError == '' && $this->emailError == '' && $this->passwordError == '' ) {

			$this->model->registerNewAccount( $uName, $email, $pass1 );
			
			// Redirect the user
			header('Location: index.php?page=account');

		}

	}

}









