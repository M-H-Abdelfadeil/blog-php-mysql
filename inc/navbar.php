<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="../pages">BL<span>O</span>G</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="../" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="../posts/" class="nav-link">Blog</a></li>
					<!-- <li class="nav-item"><a href="../contact-us/" class="nav-link">Contact Us</a></li> -->
					<?php
						if(isset($_SESSION['user']['id'])){
							?>
								<li class="nav-item"><a href="../posts/craete.php" class="nav-link">Craete</a></li>
								<li class="nav-item"><a href="../users/profile.php" class="nav-link">Profile</a></li>
							<?php
						}else{
							?>
							<li class="nav-item"><a href="../auth/login.php" class="nav-link">LOGIN</a></li>
							<li class="nav-item"><a href="../auth/register.php" class="nav-link">Register</a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</div>
	</nav>