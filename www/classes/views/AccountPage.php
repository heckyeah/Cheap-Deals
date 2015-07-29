<?php

class AccountPage extends Page {

	// Properties
	private $existingPasswordError;
	private $newPasswordError;
	private $confirmPasswordError;
	private $passwordChangeMessage;
	private $userDeleteError;
	private $userEnableError;
	private $userEnableSuccess;
	private $userDeleteSuccess;
	private $profileImageError;

	private $firstName;
	private $firstNameError;
	private $lastName;
	private $lastNameError;
	private $bio;
	private $bioError;
	private $job;
	private $jobError;

	private $staffErrorMessage;
	private $staffSuccessMessage;

	private $newDealDateError;
	private $totalErrors = 0;

	private $userFirstNameError;
	private $userLastNameError;
	private $userBioError;
	private $userImageError;
	private $userFirstName;
	private $userLastName;
	private $userBio;

	private $userSuccess;
	private $userFail;


	public function __construct($model) {
		parent::__construct($model);

		// If the user has submitted the password change form
		if( isset($_POST['existing-password']) ) {
			$this->processPasswordChange();
		}

		// If the user is inserting/updating aditional information
		if( isset($_POST['user-data']) ) {
			$this->processAdditionalInfo();
		}

		// If user is an admin
		if( isset($_SESSION['privilege']) && $_SESSION['privilege'] == 'admin' ) {

			// If the admin submitted the delete function
			if( isset($_POST['delete-account']) ) {
				$this->processDeleteAccount();
			}

			// If the admin submitted the enable function
			if( isset($_POST['enable-account']) ) {
				$this->processEnableAccount();
			}

			// If the admin has submitted the add staff form
			if( isset($_POST['add-staff']) ) {
				$this->processAddStaff();
			}

			// If the add deal form has been submitted
			if( isset($_POST['add-deal']) ) {
				$this->processAddDeal();
			}

		}
		
	}
	
	public function contentHTML() {

		// Make sure the user is logged in
		// If not then offer them a login or registration link
		if( !isset($_SESSION['username']) ) {
			echo 'You need to be logged in';
			return;
		}


		include 'templates/accountpage.php';

		// If user is an admin
		if( $_SESSION['privilege'] == 'admin' ) {

			include 'templates/admincontrols.php';

		}

	}

	private function processPasswordChange() {

		// Make life easier
		$existingPass = $_POST['existing-password'];
		$newPass      = $_POST['new-password'];
		$confirmPass  = $_POST['confirm-password'];

		// Validate
		if( strlen($existingPass) == 0 ) {
			$this->existingPasswordError = 'Required';
		} elseif( !$this->model->checkPassword($existingPass) ) {
			$this->existingPasswordError = 'Incorrect password';
		}

		if( strlen($newPass) < 8 ) {
			$this->newPasswordError = 'Needs to be more than 8 characters';
		}

		if( strlen($confirmPass) < 8 ) {
			$this->confirmPasswordError = 'Needs to be more than 8 characters';
		} elseif( $confirmPass != $newPass ) {
			$this->confirmPasswordError = 'Does not match the new password';
		}

		// If no errors
		if( $this->existingPasswordError == '' && $this->newPasswordError == '' && $this->confirmPasswordError == '' ) {

			// Update the password
			$result = $this->model->updatePassword();

			// If updating the password was a success
			if( $result ) {
				$this->passwordChangeMessage = 'Successfully changed your password!';
			} else {
				$this->passwordChangeMessage = 'Something went wrong updating your password...';
			}

		}

	}

	private function processDeleteAccount() {

		// Get the username to delete from the form
		$username = $_POST['username'];

		// If the username is the same as the person who is logged in
		if( $username == $_SESSION['username'] ) {
			$this->userDeleteError = 'You cannot delete your own account!';
		}

		// If no errors
		if( $this->userDeleteError == '' ) {
			// Send it to the model for deleting
			$this->model->deleteAccount($username);
			$this->userDeleteSuccess = 'Successfully disabled the account!';
		}

	}

	private function processEnableAccount() {

		// Validation
		if( isset($_POST['username']) ) {
			$username = $_POST['username'];
		} else {
			$this->userEnableError = 'No username selected!';
		}

		// If there are no errors
		if( $this->userEnableError == '' ) {
			$this->model->enableAccount($username);
			$this->userEnableSuccess = 'Successfully enabled the account!';
		}
		
	}

	private function processAddStaff() {

		// Make forms sticky
		$this->firstName = trim($_POST['first-name']);
		$this->lastName  = trim($_POST['last-name']);
		$this->bio       = trim($_POST['bio']);
		$this->job       = trim($_POST['job-title']);

		// Validate the form and make sure the user has provided all the appropriate fields
		if( strlen($this->firstName) < 2 ) {
			$this->firstNameError = 'Name must be at least 2 characters';
		} elseif( strlen($this->firstName) > 20 ) {
			$this->firstNameError = 'Name must be at most 20 characters';
		} elseif( !preg_match('/^[a-zA-Z-]{2,20}$/', $this->firstName) ) {
			$this->firstNameError = 'Only allowed letters and hyphens. No spaces.';
		}

		if( strlen($this->lastName) < 2 ) {
			$this->lastNameError = 'Name must be at least 2 characters';
		} elseif( strlen($this->lastName) > 20 ) {
			$this->lastNameError = 'Name must be at most 20 characters';
		} elseif( !preg_match('/^[a-zA-Z-]{2,20}$/', $this->lastName) ) {
			$this->lastNameError = 'Only allowed letters and hyphens. No spaces.';
		}

		if( strlen($this->bio) > 200 ) {
			$this->bioError = 'Bio must be at most 200 characters. You have gone over by '.(strlen($this->bio) - 200);
		} elseif( !preg_match('/^[\w.\-\s]{2,200}$/', $this->bio ) ) {
			$this->bioError = 'Only allowed letters, hyphens, spaces and full stops.';
		}

		if( strlen($this->job) > 30 ) {
			$this->jobError = 'Job must be at most 30 characters. You have '.strlen($this->job);
		} elseif( !preg_match('/^[\w\-\s\.]{2,30}$/', $this->job) ) {
			$this->jobError = 'Only allowed letters, hyphens, spaces and full stops.';
		}

		// Make life easier
		$file      = $_FILES['profile-image'];
		$imageName = $file['name'];

		// If the user has not provided an image
		if( $imageName == '' ) {
			$this->profileImageError = 'Required!';
		} elseif( 	$this->firstNameError == ''
					&& $this->lastNameError == ''
					&& $this->bioError == ''
					&& $this->jobError == '' ) {

			// Require the image upload class
			require 'vendor/ImageUploader.php';

			// Instantiate (create) the class
			$imageUploader = new ImageUploader();

			// Make a new file name based on the staff members name
			$fileName = $this->firstName.'-'.$this->lastName;

			// Upload the image and make sure all went well
			$result = $imageUploader->upload( 'profile-image', 'img/staff/original/', $fileName );

			// If something went wrong
			if( !$result ) {
				$this->profileImageError = $imageUploader->errorMessage;
			} else {
				$newImage = $imageUploader->getImageName();
				$imageUploader->resize( 'img/staff/original/'.$newImage, 320, 'img/staff/thumbnails/', $newImage );
			}

			// If there are no errors then insert a new staff member!
			if( $this->profileImageError == '' ) {
				$result = $this->model->addNewStaff( $newImage );

				// If success
				if( $result ) {
					$this->staffSuccessMessage = 'Success!';
				} else {
					$this->staffErrorMessage = 'Something went wrong in the database :(';
				}

			}

		}

	}

	private function processAddDeal() {

		// Validation
		// Make sure the start date is before the end date
		$startDate 	= $_POST['start-year'].'-'.$_POST['start-month'].'-'.$_POST['start-day'];
		$startDate	.= $_POST['start-hour'].':'.$_POST['start-minute'].':'.$_POST['start-second'];

		$endDate 	= $_POST['end-year'].'-'.$_POST['end-month'].'-'.$_POST['end-day'];
		$endDate	.= $_POST['end-hour'].':'.$_POST['end-minute'].':'.$_POST['end-second'];

		if( new DateTime($startDate) > new DateTime($endDate) ) {
			$this->newDealDateError = 'End date is before start date';
			$this->totalErrors++;
		} elseif ( new DateTime() > new DateTime($endDate) ) {
			$this->newDealDateError = 'End date is before today';
			$this->totalErrors++;
		}

		// Add the deal
		if($this->totalErrors == 0) {
			$this->model->addNewDeal();
		}

	}

	private function processAdditionalInfo() {

		// Validation
		if( strlen($_POST['first-name']) < 2 ) {
			$this->userFirstNameError = 'Needs to be at least 2 characters.';
			$this->totalErrors++;
		} elseif( strlen($_POST['first-name']) > 20) {
			$this->userFirstNameError = 'Needs to be at most 20 characters.';
			$this->totalErrors++;
		} elseif( !preg_match('/^[a-zA-Z \-]{2,20}$/', $_POST['first-name']) ) {
			$this->userFirstNameError = 'Can only use characters of the alphabet, spaces and hyphens.';
			$this->totalErrors++;
		}

		if( strlen($_POST['last-name']) < 2 ) {
			$this->userLastNameError = 'Needs to be at least 2 characters.';
			$this->totalErrors++;
		} elseif( strlen($_POST['last-name']) > 20) {
			$this->userLastNameError = 'Needs to be at most 20 characters.';
			$this->totalErrors++;
		} elseif( !preg_match('/^[a-zA-Z \-]{2,20}$/', $_POST['last-name']) ) {
			$this->userLastNameError = 'Can only use characters of the alphabet, spaces and hyphens.';
			$this->totalErrors++;
		}

		if( strlen($_POST['last-name']) > 2000) {
			$this->userBioError = 'Needs to be at most 2000 characters.';
			$this->totalErrors++;
		}

		// Attemp to upload the image
		if( $this->totalErrors == 0 && isset($_FILES['profile-image']) && $_FILES['profile-image']['name'] != '' ) {

			//require image uploader
			require 'vendor/ImageUploader.php';

			// Create an instance
			$imageUploader = new ImageUploader();

			// Attemp to upload the file
			$result = $imageUploader->upload('profile-image', 'img/profile-images/original/');

			// If the upload was a success
			if ($result) {
				// Get the file name
				$imageName = $imageUploader->getImageName();

				// Prepare the variables
				$fileLocation = "img/profile-images/original/$imageName";
				$fileDestination = "img/profile-images/avatar/";

				// Make the avatar version
				$imageUploader->resize($fileLocation, 320, $fileDestination, $imageName);

				// Make icons
				$fileDestination = "img/profile-images/icon/";
				$imageUploader->resize($fileLocation, 32, $fileDestination, $imageName);

				$_POST['newUserImage'] = $imageName;

			} else {
				// Something went wrong
				$this->userImageError = $imageUploader->errorMessage;
				$this->totalErrors++;
			}
		} elseif ( isset($_FILES['profile-image']) && $_FILES['profile-image']['name'] == '') {
			$_POST['newUserImage'] = 'default.png';
		}


		if( $this->totalErrors == 0 ) {
			$result = $this->model->additionalInfo();

			//If the result was good
			if( $result ) {
				$this->userSuccess = 'Account has been updated';
			} else {
				$this->userFail = 'You have entered the same information';
			}
		}	
	}

}
