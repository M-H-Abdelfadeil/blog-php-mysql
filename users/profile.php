<?php

use App\Controllers\Web\ProfileController;

session_start();

include '../inc/app.php'; 

if(!isset($_SESSION['user'])){
    redirect("../auth/login.php");
}
$profile = new ProfileController;
$posts   = $profile->posts(); 
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


<div class="container">
    <div class="row">
        <div class="col-6 col-md-4 mt-2">
            <div>
                <a href="edit.php" class="btn btn-primary">EDIT <i class="fa fa-edit"></i></a>
            </div>
        </div>
        <div class="col-6 col-md-4 mt-2 ">
            <div>
                <a href="edit-password.php" class="btn btn-primary">EDIT PASSWORD <i class="fa fa-edit"></i></a>
            </div>
        </div>
        <div class="col-6 col-md-4 mt-2">
            <div>
                <a href="../posts/create.php" class="btn btn-primary">CREATE POST <i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2>My Posts</h2>
			</div>
		</div>
		<div class="row d-flex">
		<?php
            foreach($posts as $post){
                ?>

                <!--  -->

                <div class="col-md-3 d-flex ftco-animate">
                    <div class="blog-entry justify-content-end">
                        <div class="text">
                            <h3 class="heading mb-3"><a href="../posts/show.php?post_id=<?php echo $post['id'];  ?>"><?php echo $post['title']; ?></a></h3>
                            <a href="../posts/show.php?post_id=<?php echo $post['id'];  ?>" class="block-20 img" style="background-image: url(../uploads/posts/images/<?php echo $post['image']; ?>)">
                            </a>
                            <div class="meta mb-3">
                                <!-- <div><a href="#">June 01, 2020</a></div> -->
                                <!-- <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div> -->
                            </div>
                            <div class="meta mb-3">
                                <div><a class="p-1 bg-info rounded m-1 text-light" href="../posts/edit.php?post_id=<?php echo $post['id'] ?>"><i class="fa fa-edit"></i></a></div>
                                <div><a class="p-1 bg-danger rounded m-1 text-light" onclick="return confirm('Are you sure?')" href="../posts/delete.php?post_id=<?php echo $post['id'] ?>" class="meta-chat"><i class="fa fa-trash"></i></a></div>
                            </div>

                            <p><?php echo $post['description']."..."; ?></p>
                        </div>
                    </div>
                </div>

                <!--  -->
                <?php
            }
					
			?>
			

		</div>
		<div class="row mt-5 pb-5">
			<div class="col text-center">
				<!-- <div class="block-27">
      <ul>
        <li><a href="#">&lt;</a></li>
        <li class="active"><span>1</span></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&gt;</a></li>
      </ul>
    </div> -->
			</div>
		</div>
	</div>
</section>










<?php


include '../inc/footer.php';