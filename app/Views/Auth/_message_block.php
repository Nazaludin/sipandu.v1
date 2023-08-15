<script src="<?php echo base_url(); ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/toastr/build/toastr.min.js"></script>
<script>
	function makeToast(message, category) {
		switch (category) {
			case 'warning':
				toastr.warning(message, capitalize(category));
				break;
			case 'error':
				toastr.error(message, capitalize(category));
				break;

			default:
				toastr.success(message, 'Success');
				break;
		}
	}

	function capitalize(s) {
		return s[0].toUpperCase() + s.slice(1);
	}
</script>
<?php if (session()->has('message')) : ?>

	<?php echo "<script>setTimeout(makeToast, 50, '" . session('message') . "');</script>"; ?>

<?php endif ?>

<?php if (session()->has('error')) : ?>


	<?php echo "<script>setTimeout(makeToast, 50, '" . session('error') . "', 'error');</script>"; ?>
<?php endif ?>

<?php if (session()->has('errors')) : ?>

	<?php foreach (session('errors') as $error) : ?>

		<?php echo "<script>setTimeout(makeToast, 50, '" . $error . "', 'error');</script>"; ?>
	<?php endforeach ?>



<?php endif ?>