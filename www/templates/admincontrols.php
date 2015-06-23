<div class="row">
	<div class="columns">
		<h2>Enable / Disable Accounts</h2>
	</div>
	<div class="medium-6 columns">
		<h3>Disable an account</h3>
		<form action="index.php?page=account" method="post">
			<label>Users: </label>
			<select name="username">
				<?php

					// Use the model to get all accounts
					$result = $this->model->getAllUsernames();

					// Loop through the result and display all the usernames
					while( $row = $result->fetch_assoc() ) {

						// Make sure the user is not an admin
						if( $row['Privilege'] == 'admin' || $row['Active'] == 'disabled' ) {
							continue;
						}

						echo '<option>'.$row['Username'].'</option>';

					}

				?>
			</select>
			<input type="submit" class="tiny button" value="Delete this account" name="delete-account">
			<?php if( $this->userDeleteError != '' ) : ?>
			<small class="error"><?php echo $this->userDeleteError; ?></small>
			<?php endif; ?>
			<?php if( $this->userDeleteSuccess != '' ) : ?>
			<small class="alert-box success"><?php echo $this->userDeleteSuccess; ?></small>
			<?php endif; ?>
		</form>
	</div>
	<div class="medium-6 columns">
		<h3>Enable an account</h3>
		<form action="index.php?page=account" method="post">
			<label>Users: </label>
			<select name="username">
				<?php

					// Use the model to get all accounts
					$result = $this->model->getAllUsernames();

					// Loop through the result and display all the usernames
					while( $row = $result->fetch_assoc() ) {

						// Make sure the user is not an admin
						if( $row['Active'] == 'enabled' ) {
							continue;
						}

						echo '<option>'.$row['Username'].'</option>';

					}

				?>
			</select>
			<input type="submit" class="tiny button" value="Enable this account" name="enable-account">
			<?php if( $this->userEnableError != '' ) : ?>
			<small class="error"><?php echo $this->userEnableError; ?></small>
			<?php endif; ?>
			<?php if( $this->userEnableSuccess != '' ) : ?>
			<small class="alert-box success"><?php echo $this->userEnableSuccess; ?></small>
			<?php endif; ?>
		</form>
	</div>
</div>


<div class="row">
	<div class="columns">
		<h2>Add new Staff Member</h2>
		<form action="index.php?page=account" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="medium-4 columns">
					<label for="first-name">First Name: </label>
					<input type="text" name="first-name" id="first-name" value="<?php echo $this->firstName; ?>" placeholder="Bruce">
					<?php errorMessage($this->firstNameError); ?>
				</div>
				<div class="medium-4 columns">
					<label for="last-name">Last Name: </label>
					<input type="text" name="last-name" id="last-name" value="<?php echo $this->lastName; ?>" placeholder="Wayne">
					<?php errorMessage($this->lastNameError); ?>
				</div>
				<div class="medium-4 columns">
					<label for="job-title">Job Title: </label>
					<input type="text" name="job-title" id="job-title" value="<?php echo $this->job; ?>" placeholder="Crimefighter">
				
				</div>
				<div class="medium-6 columns">
					<label for="bio">Bio: </label>
					<textarea name="bio" id="bio" rows="4" cols="20"><?php echo $this->bio; ?></textarea>
					<?php errorMessage($this->bioError); ?>
				</div>
				<div class="medium-6 columns">
					<label for="profile-image">Proile Image: </label>
					<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
					<input type="file" class="button tiny" name="profile-image" id="profile-image">
					<?php
						errorMessage($this->profileImageError);
					?>
				</div>
				<div class="columns">
					<input type="submit" class="button tiny" value="Add new staff member" name="add-staff">
				</div>
			</div>
		</form>
	</div>
</div>














