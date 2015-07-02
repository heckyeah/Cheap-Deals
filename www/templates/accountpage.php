<div class="row">
	<div class="columns">
		<h1>Hello <?php echo $_SESSION['username']; ?></h1>
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