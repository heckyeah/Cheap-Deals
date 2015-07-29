<?php

class DealModel extends Model {

	public function getDealInfo() {
		// Filter the ID
		$dealID = $this->filter($_GET['dealid']);

		if( !is_numeric($dealID)) {
			return false;
		}

		// prepare sql
		$sql = " SELECT
					deals.name AS deal_name,
					original_price,
					discounted_price,
					image,
					start_date,
					end_date,
					deals.description AS deal_description,
					code,
					businesses.name AS business_name,
					logo,
					phone,
					website,
					businesses.description AS business_description
				 FROM
				 	deals 
				 JOIN 
				 	businesses
				 ON
				 	businesses.id = deals.businessID
				 WHERE
				 deals.id = $dealID
				 ";
				
		// run the query
		$result = $this->dbc->query($sql);

		if ($result->num_rows == 1) {
			return $result->fetch_assoc();
		} else {
			// either the deal diddnt exist or the ID was wrong
			return false;
		}


	}
	
}