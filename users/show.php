<?php
session_start();

if(!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])){
    die ('An unexpected error occurred');
}
include '../inc/app.php';

use App\Controllers\Web\PostController;

$post = new PostController;
$posts = $post->postsUser($_GET['user_id']);
if(!$posts){
    die ('An unexpected error occurred');
}
$user = $post->getUser($_GET['user_id']);

include '../inc/head.php'
?>

<?php include '../inc/navbar.php' ?>
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
						<a href="index.html">Posts
							<i class="fa fa-chevron-right"></i>
						</a>
					</span>
                    <span class="mr-2">
						<a href="index.html">Posts User
							<i class="fa fa-chevron-right"></i>
						</a>
					</span>
                    <span class="mr-2">
						<a href="index.html">
                             <?php echo $user['name']?>
							<i class="fa fa-chevron-right"></i>
						</a>
					</span>
				</p>
				<h1 class="mb-3 bread">Posts : <?php echo $user['name']?></h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2>Posts User : <?php echo $user['name']?></h2>
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
                            <a href="../posts/show.php?post_id=<?php echo $post['id'];  ?>" class="block-20 img" style="background-image: url(../uploads/posts//images/<?php echo $post['image']; ?>)">
                            </a>
                            <div class="meta mb-3">
                                <!-- <div><a href="#">June 01, 2020</a></div> -->
                                <!-- <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div> -->
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
<?php include '../inc/footer.php' ?>

