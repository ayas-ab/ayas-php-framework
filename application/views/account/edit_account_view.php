<!DOCTYPE html>
<html lang="en">
<?php include_once('application/views/templates/head.php');  ?>
<body>
<?php include_once('application/views/templates/nav.php');  ?>
<div class="container">


		<div class="col-md-6 offset-md-3 mt-2">
		
		<?php

        if (isset($data['edit_success'])) {
        
            echo $this->html_alerts::get_success_alert('Updated successfully!');
        }
        ?>
			<div class="card">
				<h5 class="card-header">Edit information</h5>
				<div class="card-body">



					<form id="edit_account_validate"
						action="<?php echo $data['nav_urls']['edit_account']['url']; ?>"
						method="POST" enctype="multipart/form-data" novalidate
						class="was-validated">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group ">
									<label>First Name</label> <input type="text" name="fname"
										class="form-control form-control-lg" placeholder="First Name"
										value="<?php echo $this->logged_user->first_name; ?>" required>


								</div>

							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Last Name</label> <input type="text" name="lname"
										class="form-control form-control-lg" placeholder="Last Name"
										value="<?php echo $this->logged_user->last_name; ?>" required />



								</div>
							</div>

						
						</div>

						<div class="row">
							<div class="col-md-12">

								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
										</div>
										<input type="text" class="form-control  form-control-lg"
											placeholder="Phone number" name="number"
											value="<?php echo $this->logged_user->number; ?>" required />
									</div>
								</div>






							</div>
						</div>


						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><span class="fa fa-lock"></span></span>
							</div>
							<input type="password" name="password"
								class="form-control form-control-lg"
								placeholder="Current Password" required>
					<?php  if(isset($data['edit_account_info']['errors']['password']['message'])) {?>
					<em class="error invalid-feedback"><?php echo( $data['edit_account_info']['errors']['password']['message']); ?></em>
					  <?php } ?>

						</div>

						<hr>
	<?php
// For any POST request to work, you must add this code. It is used for preventing CRF
echo $this->getFormToken();
?>
		
		<div class="form-group action">
							<input name="update_user_info" type="submit"
								class="btn btn-lg btn-primary" value="Update Profile ">
						</div>
					</form>

				</div>
			</div>


		</div>


	</div>
<?php include_once('application/views/templates/footer.php');  ?>
<?php

include_once ('application/views/templates/js_includes.php');  
echo $data['validation_js'];
?>

<!--  <script src="assets/js/account/edit_account.js"></script> -->

</body>
</html>