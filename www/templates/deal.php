
<div class="row" style="margin-top: 20px;">
	<div class="column large-6">
		<img src="<?php echo $dealImage; ?>" alt="">
	</div>
	<div class="column large-6">
		<h2><?php echo $dealName; ?></h2>
		<div class="row">
			<div class="column large-4">Was: <?php echo $dealOPrice; ?></div>
			<div class="column large-4">Now: <?php echo $dealDisPrice; ?></div>
			<div class="column large-4"><?php echo $percent; ?>% OFF</div>
			<p class="column large-12">Code: <?php echo $dealCode; ?></p>
		</div>
		<p><?php echo $dealDesc; ?></p>
		<p>Posted by: <?php echo $businessName; ?></p>
	</div>
</div>
<div class="row">
	<div class="column large-12">
		<hr>
		<div class="row">
			<div class="column large-6">
				<h3><?php echo $businessName; ?></h3>
				<p><?php echo $businessDesc; ?></p>
				<div><?php echo $businessPhone; ?></div>
				<a href="http://<?php echo $businessURL; ?>"><?php echo $businessURL; ?></a>
			</div>
			<div class="column large-6">
				<img src="img/business/logo/<?php echo $businessLogo; ?>" alt="<?php echo $businessName; ?>">
			</div>
		</div>
		<div class="row">
			<div class="column">
				<?php if (isset($_SESSION['privilege']) && $_SESSION['privilege'] == 'admin' ) : ?>
				<a href="index.php?page=edit-deal&dealid=<?php echo $_GET['dealid']; ?>" class="tiny button">Edit</a>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>