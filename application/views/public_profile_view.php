<!DOCTYPE html>
<html lang="en">
<?php include_once('application/views/templates/head.php');  ?>
<body>
<?php include_once('application/views/templates/nav.php');  ?>
<div class="container">


		<div class="col-md-8 offset-md-2 mt-2">
			<div class="card">
				<h5 class="card-header">Sample profile page</h5>
				<div class="card-body">
					<p class="card-text ">
					<b>First Name: </b><?php echo $data['view_user']->first_name; ?>
					<br>
				    <b>Last Name: </b><?php echo $data['view_user']->last_name; ?>
				    <br>
				    <b>Email: </b><?php echo $data['view_user']->email; ?>
				    <br>
				    <b>Phone number: </b><?php echo $data['view_user']->number; ?>
					</p>
					</div>
			</div>
		</div>


	</div>	
<?php include_once('application/views/templates/footer.php');  ?>
<?php include_once('application/views/templates/js_includes.php');  ?>

</body>
</html>