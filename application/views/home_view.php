<!DOCTYPE html>
<html lang="en">
<?php include_once('application/views/templates/head.php');  ?>
<body>
<?php include_once('application/views/templates/nav.php');  ?>
<div class="container">


		<div class="col-md-8 offset-md-2 mt-2">
			<div class="card">
				<h5 class="card-header">List of registred users</h5>
				<div class="card-body">
				
				     <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Personal page</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach($data['user_list'] as $user)
                            {
                                echo '<tr>
                                <td>'.$user['first_name'].'</td>
                                <td>'.$user['last_name'].'</td>
                                <td>'.$user['email'].'</td>
                                <td><a class="btn btn-success" href="'.$data['nav_urls']['profile_display']['url'].$user['id'].'">View Page</a></td>

                              </tr>';
                                
                                
                            }
                            ?>
                             
                            </tbody>
                          </table>


				</div>
			</div>
		</div>


	</div>	
<?php include_once('application/views/templates/footer.php');  ?>
<?php include_once('application/views/templates/js_includes.php');  ?>
</body>
</html>