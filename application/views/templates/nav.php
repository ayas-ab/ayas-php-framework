

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand"
			href="<?php echo $data['nav_urls']['home']['url']; ?>">Ayas's PHP
			Framework</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarResponsive" aria-controls="navbarResponsive"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">

				<li
					class="nav-item <?php if($data['nav_urls']['home']['active'] == true) echo "active"; ?>"><a
					class="nav-link"
					href="<?php echo $data['nav_urls']['home']['url']; ?>">Home </a></li>
				<li class="nav-item"><a class="nav-link"
					href="<?php echo $this->getCurrentUrl(); ?>#">About</a></li>


                     <?php
                    
                    if (isset($data['logged_in_user_info'])) {?>
     <li class="nav-item dropdown">               
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
         <a class="dropdown-item <?php if($data['nav_urls']['account']['active'] == true) echo "active"; ?>" href="<?php echo $data['nav_urls']['account']['url']; ?>">Profile</a>
         <a class="dropdown-item <?php if($data['nav_urls']['edit_account']['active'] == true) echo "active"; ?>" href="<?php echo $data['nav_urls']['edit_account']['url']; ?>">Edit profile</a>
          <a class="dropdown-item" href="<?php echo $data['nav_urls']['home']['url']."?logout"; ?>">Logout</a>
        </div>
      </li>
                    
                <?php } else{ ?>    
                  <li
					class="nav-item <?php if($data['nav_urls']['register']['active'] == true) echo "active"; ?>">
          
          
                    <?php
                    $url = $data['nav_urls']['register']['url'];
                    echo '<a class="nav-link" href="' . $url . '">Register</a>';
                    ?>

				<li
					class="nav-item <?php if($data['nav_urls']['login']['active'] == true) echo "active"; ?>">
                    <?php
                    $url = $data['nav_urls']['login']['url'];
                    $text = "Login";
                    echo '<a class="nav-link" href="' . $url . '">' . $text . '</a>';
                    ?>
          

				</li>
				
				<?php } ?>
				
				
				
				
				
				

			</ul>
		</div>
	</div>
</nav>


