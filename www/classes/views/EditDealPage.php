<?php

	class EditDealPage extends Page {

		public function __construct($model) {
		parent::__construct($model);

			// If user is an admin
			if( isset($_SESSION['privilege']) && $_SESSION['privilege'] == 'admin' ) {

				// If the admin submitted the edit-deal button
				if( isset($_POST['edit-deal']) ) {
					$this->processEditDeals();
				}

			}

		}

		public function contentHTML() {


			include 'templates/edit-deal.php';

		}

		private function processEditDeals() {

			$this->model->editDeals();

		}

	}