<?php

class AccountModel extends Model {

	public function getAllUsernames() {

		return $this->dbc->query( "SELECT Username, Privilege, Active FROM users" );

	}

	public function checkPassword( $password ) {

		// Get the username of the person who is logged in
		$username = $_SESSION['username'];

		// Get the password of the account that is logged in
		$result = $this->dbc->query("SELECT Password FROM users WHERE Username = '$username'");

		// Convert into an associative array
		$data = $result->fetch_assoc();

		// Need the password compat library
		require 'vendor/password.php';

		// Compare the current password against user existing password
		if( password_verify($password, $data['Password']) ) {
			return true;
		} else {
			return false;
		}

	}

	public function updatePassword() {

		// Get the username of the person logged in
		$username = $_SESSION['username'];

		// Require the password compat library
		require 'vendor/password.php';

		// Hash the new password
		$hashedPassword = password_hash($_POST['new-password'], PASSWORD_BCRYPT);

		// Prepare UPDATE SQL
		$sql = "UPDATE users SET Password = '$hashedPassword' WHERE Username = '$username'";

		// Run the SQL
		$this->dbc->query($sql);

		// Ensure the password update worked
		if( $this->dbc->affected_rows != 0 ) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteAccount($username) {

		// Filter the username
		$username = $this->dbc->real_escape_string($username);

		//$this->dbc->query("DELETE FROM users WHERE Username = '$username'");
		$this->dbc->query("	UPDATE users 
							SET Active = 'disabled'
							WHERE Username = '$username'");
	}

	public function enableAccount( $username ) {
		// Filter the username
		$username = $this->dbc->real_escape_string($username);

		// Run the query
		$this->dbc->query(" UPDATE users
							SET Active = 'enabled'
							WHERE Username = '$username'");
	}

	public function addNewStaff( $imageName ) {

		// Extract the data from the form and filter too
		$firstName = $this->dbc->real_escape_string( $_POST['first-name'] );
		$lastName  = $this->dbc->real_escape_string( $_POST['last-name'] );
		$bio       = $this->dbc->real_escape_string( $_POST['bio'] );
		$jobTitle  = $this->dbc->real_escape_string( $_POST['job-title'] );
		$image     = $this->dbc->real_escape_string( $imageName );

		// Prepare SQL to insert the new staff member
		$sql = "INSERT INTO staff VALUES (  NULL,
											'$firstName',
											'$lastName',
											'$bio',
											'$image',
											'$jobTitle'
											) ";
		
		// Run the query
		$this->dbc->query($sql);

		// Make sure the insert actually worked
		if( $this->dbc->affected_rows == 0 ) {
			return false; // Failed
		} else {
			return true; // Success
		}

	}

}
