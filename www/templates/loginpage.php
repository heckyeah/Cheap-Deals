<div class="row">
	<div class="columns">
		<form action="index.php?page=login" method="post" novalidate>
			<h1>Log into your account</h1>
			<div class="row">
				<div class="medium-6 columns">
					<label>Username: </label>
					<input type="text" name="username" placeholder="iambatman" value="<?php echo $this->username; ?>">
					<?php

						function errorMessage($message) {
							if( $message != '' ) {
								echo '<small class="error">';
								echo $message;
								echo '</small>';
							}
						}

						errorMessage($this->usernameError);

					?>
				</div>
				<div class="medium-6 columns">
					<label>Password: </label>
					<input type="password" name="password">
					<?php errorMessage($this->passwordError); ?>
				</div>
			</div>
			<input type="submit" class="button tiny" value="Log In">
			<?php errorMessage($this->loginError); ?>
		</form>
	</div>
</div>