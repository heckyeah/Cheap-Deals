<?php

class SearchPage extends Page {

	private $searchResults;

	public function __construct($model) {
		parent:: __construct($model);

		// Get id for the deal in the address bar
		$this->searchResults = $this->model->search();

	}

	public function contentHTML() {
		
		include 'templates/search.php';

	}

}