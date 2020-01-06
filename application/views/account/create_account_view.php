<!DOCTYPE html>
<html lang="en">
<?php include_once('application/views/templates/head.php');  ?>
<body>
<?php include_once('application/views/templates/nav.php');  ?>
<div class="container">


		<div class="col-md-6 offset-md-3 mt-2">
			<div class="card">
				<h5 class="card-header">Create Account</h5>
				<div class="card-body">



					<form id="create_account"
						action="<?php echo $data['nav_urls']['register']['url']; ?>"
						method="POST" enctype="multipart/form-data" novalidate
						class="was-validated">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group ">
									<label>First Name</label> <input type="text" name="fname"
										class="form-control form-control-lg" placeholder="First Name"
										 required>


								</div>

							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Last Name</label> <input type="text" name="lname"
										class="form-control form-control-lg" placeholder="Last Name"
										 required />



								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<label>Email</label> <input type="text" name="email"
										class="form-control form-control-lg" placeholder="Email"
										 required />

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
											placeholder="Phone number(just type 1234567890)" name="number"
											 required />
									</div>
								</div>
							</div>
						</div>


						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><span class="fa fa-lock"></span></span>
							</div>
							<input type="password" name="password"
								class="form-control form-control-lg pass1"
								placeholder="Password" required>
								
					
					

						</div>
						
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><span class="fa fa-lock"></span></span>
							</div>
							<input type="password" name="password2"
								class="form-control form-control-lg"
								placeholder="Retype Password" required>
								
					
					

						</div>

						<hr>
                        	<?php
                        // For any POST request to work, you must add this code. It is used for preventing CRF
                        echo $this->getFormToken();
                        ?>
		
		         <div class="form-group action">
							<input name="register" type="submit"
								class="btn btn-lg btn-primary" value="Register Account ">
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
<script>
var show_message = <?php if(isset($data['create_success'])){ echo 'true';}else{echo 'false';} ?>

if(show_message)

{

	Swal.fire(
			  'Account has been created!!',
			  'You can now log in',
			  'success'
			)
}
</script>

</body>
</html>