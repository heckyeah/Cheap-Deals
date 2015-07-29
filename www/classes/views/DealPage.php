<?php

class DealPage extends Page {

	private $dealInfo;

	public function __construct($model) {
		parent:: __construct($model);

		// Get id for the deal in the address bar
		$this->dealInfo = $this->model->getDealinfo();



	}

	public function contentHTML() {

		if( $this->dealInfo == false) {
			echo 'something went wrong';
			return;
		}

		// Short code the deal info
		$dealName 		= $this->dealInfo['deal_name'];
		$dealImage 		= $this->dealInfo['image'];
		$dealDesc 		= $this->dealInfo['deal_description'];
		$dealOPrice 	= $this->dealInfo['original_price'];
		$dealDisPrice 	= $this->dealInfo['discounted_price'];
		$dealCode 		= $this->dealInfo['code'];
		$businessName 	= $this->dealInfo['business_name'];
		$businessDesc 	= $this->dealInfo['business_description'];
		$businessLogo 	= $this->dealInfo['logo'];
		$businessPhone 	= $this->dealInfo['phone'];
		$businessURL 	= $this->dealInfo['website'];

		$percent = $dealOPrice - ($dealOPrice * ($dealDisPrice/100));

		include 'templates/deal.php';

	}

}