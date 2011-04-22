<?php include('template/session_header.php'); ?>

<div id="wrapper">
	<div id="delete-account">
		<a href="<?php echo $_SESSION['id']; ?>" id="delete-account-user"><?php echo $lan->l('delete_account'); ?></a>
	</div>

	<div id="tickets">
		<?php include('dispatchers/get_tickets.php'); ?>
	</div>
</div>

<?php include('template/footer.php'); ?>