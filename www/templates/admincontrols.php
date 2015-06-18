<div class="row">
	<div class="columns">
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
		</form>
	</div>
</div>