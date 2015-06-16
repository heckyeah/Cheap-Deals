<div class="row">
	<div class="columns">
		<form>
			<label>Users: </label>
			<select>
				<?php

					// Use the model to get all accounts
					$result = $this->model->getAllUsernames();

					// Loop through the result and display all the usernames
					while( $row = $result->fetch_assoc() ) {

						echo '<option>'.$row['Username'].'</option>';

					}

				?>
			</select>
		</form>
	</div>
</div>