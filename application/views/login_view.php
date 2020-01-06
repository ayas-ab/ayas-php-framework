<!DOCTYPE html>
<html lang="en">
<?php include_once('application/views/templates/head.php');  ?>
<body>
		<?php include_once('application/views/templates/nav.php');  ?>
			<div class="container">
		<div class="row justify-content-md-center align-items-center mt-4">
			<div class="col-md-4 col-lg-4 col-xs-12">

				<div class="card mb-3">
					<h5 class="card-header">Login to your account</h5>

					<div class="card-body">
						<form id="login_form" method="post" enctype="multipart/form-data">
							<div class="form-group ">

								<div class="input-group mb-3 ">
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-at"></span></span>
									</div>
									<input id="email" type="email" name="email"
										class="form-control form-control-lg" placeholder="Email"
										value="<?php if(isset($data['last_form_values']['login']['email'])) echo $data['last_form_values']['login']['email']; ?>"
										required>

								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fa fa-lock"></span></span>
									</div>
									<input id="password" type="password" name="password"
										class="form-control form-control-lg <?php if(isset($data['wrong_password'])) {echo 'is-invalid'; }?>"
										placeholder="Password" required>
												<?php echo $this->getFormToken(); ?>
												
											
											<?php  if(isset($data['wrong_password'])) {?>
											<em class="error invalid-feedback"><?php echo $data['wrong_password']; ?></em>
										    <?php } ?>
										</div>

							</div>

							<p class="text-lg-right">
								<a href="forgot-password.html">Forgot Password</a>
							</p>

							<button type="submit" name="login" class="btn btn-primary btn-lg">Sign
								In</button>
						</form>
					</div>
				</div>
				<div></div>
			</div>


		</div>
	</div>

	<?php include_once('application/views/templates/footer.php');  ?>
	<?php include_once('application/views/templates/js_includes.php');  ?>
	<script>
    var checkEmailUrl = "<?php echo $data['nav_urls']['ajax_check_email']['url']; ?>";
	</script>
	<script src="assets/js/login/login.js"></script>

</body>
</html>
