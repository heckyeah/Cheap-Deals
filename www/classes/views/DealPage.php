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

		echo '<pre>';
		print_r($this->dealInfo);
		echo '</pre>';

		include 'templates/deal.php';

	}

}