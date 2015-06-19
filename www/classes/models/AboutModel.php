<?php

class AboutModel extends Model {

	public function getAllStaffMembers() {

		return $this->dbc->query("SELECT FirstName, LastName, Bio, ProfileImage, Job FROM staff");

	}
	
}