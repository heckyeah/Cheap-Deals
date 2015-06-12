<?php

class RegistrationModel extends Model {

	public function checkUsernameExists( $username ) {

		// Prepare SQL
		$sql = "SELECT Username FROM users WHERE Username = '$username'";

		// Run the query
		$result = $this->dbc->query( $sql );

		// If there is a result
		if( $result->num_rows > 0 ) {

			// Account with that username exists
			return true;

		} else {

			// Account with that username does NOT exist
			return false;

		}

	}

}