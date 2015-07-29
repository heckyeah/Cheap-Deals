<div class="row">
	<div class="columns">
		<?php 
			$result = $this->model->getAdditionalInfo();
			if ( $result->num_rows == 1 ) {
			$data = $result->fetch_assoc();

			$image 	= $data['ProfileImage'];
			$firstName 	= $data['FirstName'];
			$lastName	= $data['LastName'];

			} else {
				$image 	= 'default.png';
			}
		?>
		<img src="img/profile-images/avatar/<?php echo $image; ?>" alt="">
		<h1>Hello 
			<?php 

				if ( $result->num_rows == 0 ) {
					echo $_SESSION['username'];
				} else {
					echo $firstName.' '.$lastName;
				}
			?>
		</h1>
	</div>
</div>

<div class="row">
	<div class="columns">
		<form action="index.php?page=account" method="post">
			<h2>Change your password</h2>
			<p>Are you worried that someone might know your password, or do you think it's time to better your security? Use the form below to set a new password for your account!</p>
			<div class="row">
				<div class="medium-4 columns">
					<label>Existing password: </label>
					<input type="password" name="existing-password">
					<?php

						function errorMessage($message) {
							if( $message != '' ) {
								echo '<small class="error">';
								echo $message;
								echo '</small>';
							}
						}

						errorMessage($this->existingPasswordError);

					?>
				</div>
				<div class="medium-4 columns">
					<label>New Password: </label>
					<input type="password" name="new-password">
					<?php errorMessage($this->newPasswordError); ?>
				</div>
				<div class="medium-4 columns">
					<label>Confirm new password: </label>
					<input type="password" name="confirm-password">
					<?php errorMessage($this->confirmPasswordError); ?>
				</div>
			</div>
			<input type="submit" class="tiny button" value="Set new password!">
			<?php if($this->passwordChangeMessage != '') : ?>
			<small class="alert-box info"><?php echo $this->passwordChangeMessage; ?></small>
			<?php endif; ?>
		</form>
	</div>
</div>

<?php
	// Get the users additional info if it exists
	$result = $this->model->getAdditionalInfo();

	//If there is a result
	if ($result->num_rows == 1) {
		//extract data
		$data = $result->fetch_assoc();

		$firstName 	= $data['FirstName'];
		$lastName 	= $data['LastName'];
		$bio 		= $data['bio'];

	} else {
		$firstName 	= '';
		$lastName 	= '';
		$bio 		= '';
	}

	//If the user has submitted the form then we want to use the newer data instead
	if( isset($_POST['user-data']) ) {
		$firstName 	= $_POST['first-name'];
		$lastName 	= $_POST['last-name'];
		$bio 		= $_POST['bio'];
	}
	
?>

<div class="row">
	<div class="columns">
		<h2>User Information</h2>
		<form action="index.php?page=account" method="post" enctype="multipart/form-data">
			<label for="first-name">First Name: </label>
			<input type="text" value="<?php echo $firstName; ?>" name="first-name" id="first-name" placeholder="Bruce">
			<?php $this->foundationAlert($this->userFirstNameError, 'error'); ?>

			<label for="last-name">Last Name: </label>
			<input type="text" value="<?php echo $lastName; ?>" name="last-name" id="last-name" placeholder="Wayne">
			<?php $this->foundationAlert($this->userLastNameError, 'error'); ?>
			
			<label for="bio">About Me: </label>
			<textarea name="bio" id="bio" cols="30" rows="5"><?php echo $bio; ?></textarea>
			<?php $this->foundationAlert($this->userBioError, 'error'); ?>

			<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
			<label for="profile-image">Profile Image:</label>
			<input type="file" name="profile-image" id="profile-image">
			<?php $this->foundationAlert($this->userImageError, 'error'); ?>

			<input type="submit" name="user-data" class="tiny button" value="Update">
			<?php $this->foundationAlert($this->userSuccess, 'success'); ?>
			<?php $this->foundationAlert($this->userFail, ''); ?>
		</form>
	</div>
</div>