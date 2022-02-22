<?php
session_start();
use App\Controllers\Web\PostController;

include '../inc/app.php';
include '../inc/head.php';
$post = new PostController;
$data  = $post->recentPosts();

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
				</p>
				<h1 class="mb-3 bread">Home</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2>Recent Blog</h2>
			</div>
		</div>
		<div class="row d-flex">
		<?php
					if(!$data){
						echo "not fount posts";
					}else{
						foreach($data as $post){
							?>

							<!--  -->

							<div class="col-md-3 d-flex ftco-animate">
								<div class="blog-entry justify-content-end">
									<div class="text">
										<h3 class="heading mb-3"><a href="../posts/show.php?post_id=<?php echo $post['post_id'];  ?>"><?php echo $post['title']; ?></a></h3>
										<a href="../posts/show.php?post_id=<?php echo $post['post_id'];  ?>" class="block-20 img" style="background-image: url(../uploads/posts//images/<?php echo $post['image']; ?>)">
										</a>
										<?php
											if(isset($_SESSION['user']) && $_SESSION['user']['id']==$post['user_id']){
												?>
												<div class="meta mb-3">
													<div><a class="p-1 bg-info rounded m-1 text-light" href="../posts/edit.php?post_id=<?php echo $post['post_id'] ?>"><i class="fa fa-edit"></i></a></div>
													<div><a class="p-1 bg-danger rounded m-1 text-light" onclick="return confirm('Are you sure?')" href="../posts/delete.php?post_id=<?php echo $post['post_id'] ?>" class="meta-chat"><i class="fa fa-trash"></i></a></div>
												</div>
												<?php
											}
										?>
										<div class="meta mb-3">
											<!-- <div><a href="#">June 01, 2020</a></div> -->
											<div>by : <a href="../users/show.php?user_id=<?php echo $post['user_id'];  ?>"><?php echo $post['name']; ?></a></div>
											<!-- <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div> -->
										</div>
										<p><?php echo $post['description']."..."; ?></p>
									</div>
								</div>
							</div>

							<!--  -->
							<?php
						}
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


