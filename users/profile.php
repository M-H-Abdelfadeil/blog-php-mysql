<?php
session_start();

include '../inc/app.php'; 

if(!isset($_SESSION['user'])){
    redirect("../auth/login.php");
}

//  include design files 
include '../inc/head.php';
include '../inc/navbar.php';

?>

<section class="hero-wrap hero-wrap-2 degree-right" style="background-image: url('../public/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-end">
				<div class="col-md-9 ftco-animate pb-5 mb-5">
					<p class="breadcrumbs">
                        <span class="mr-2">
                            <a href="index.html">Home
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </span>
                        <span class="mr-2">
                            <a href="#">Profile
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </span>
                    </p>
					<h1 class="mb-3 bread">Profile</h1>
				</div>
			</div>
		</div>
	</section>


<?php


include '../inc/footer.php';