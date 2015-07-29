<?php

	class EditDealModel extends Model {

		public function editDeals() {

		// Filter the data
		$id = $this->dbc->real_escape_string($_GET['dealid']);
		$dealName   = $this->dbc->real_escape_string($_POST['deal-name']);
		
		
		// Prepare the SQL
		$sql = "	UPDATE deals
					SET name = '$dealName' 
					WHERE id = '$id'
					";

		$this->dbc->query($sql);

		if ($this->dbc->affected_rows == 1) {
			return true;
		} else {
			return false;
		}

	}

	}