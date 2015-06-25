<div class="row">
	<div class="columns">
		<h1>Our Staff</h1>
	</div>

	<?php

		// Get all staff members
		$allStaff = $this->model->getAllStaffMembers();

		// 

		// Loop through each staff member and present them in HTML
		while( $row = $allStaff->fetch_assoc() ) : ?>
			<div class="medium-4 large-3 columns">
				<img src="img/staff/thumbnails/<?php echo $row['ProfileImage']; ?>">
				<h2><?php echo $row['FirstName'].' '.$row['LastName']; ?></h2>
				<p><?php echo $row['Bio']; ?></p>
			</div>
		<?php endwhile; ?>

</div>