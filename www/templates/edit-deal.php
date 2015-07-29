<div class="row">
	<div class="column">
		<form action="index.php?page=edit-deal&dealid=<?php echo $_GET['dealid']; ?>" method="post" enctype="multipart/form-data">
			<div class="columns">
				<label for="deal-name">Deal Name: </label>
				<input type="text" name="deal-name" placeholder="Cheap pizza" id="deal-name">
				<input type="submit" class="button tiny" value="Edit deal!" name="edit-deal">
			</div>
		</form>
	</div>
</div>