<?php
session_start();

if(!isset($_GET['post_id']) || !is_numeric($_GET['post_id'])){
    die ('An unexpected error occurred');
}
include '../inc/app.php';

use App\Controllers\Web\PostController;


$post = new PostController;
$getPost =$post->show($_GET['post_id']);
$recentPosts=$post->recentPosts();
if(!$getPost){
    die ('An unexpected error occurred');
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
                        <a href="#">Posts
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </span>
                    <span class="mr-2">
                        <a href="#">
                            <?php echo $getPost['title']; ?>
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </span>
                </p>
                <h1 class="mb-3 bread"><?php echo $getPost['title']; ?></h1>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
          	<p>
              <img src="../uploads/posts//images/<?php echo $getPost['image']; ?>" alt="" class="img-fluid">
            </p>
            <h2 class="mb-3"><?php echo $getPost['title']; ?></h2>
            <p><?php echo $getPost['description']; ?></p>

          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar ftco-animate">
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Created By : </h3>
                <li><a href="../users/show.php?user_id=<?php echo $getPost['user_id'] ?>"><?php echo $getPost['name'] ?></li>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
                <h3 class="mb-5">Recent Blog</h3>
              <?php
                foreach($recentPosts as $post){
                    ?>
                    
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(../uploads/posts//images/<?php echo $post['image']; ?>);"></a>
                        <div class="text">
                        <h3 class="heading"><a href="../posts/show.php?post_id=<?php echo $post['post_id'];  ?>"><?php echo $post['title']; ?></a></h3>
                        <div class="meta">
                            <!-- <div><a href="#"><span class="icon-calendar"></span> Jul 22, 2020</a></div> -->
                            <div> By : <a href="../users/show.php?user_id=<?php echo $post['user_id'];  ?>"><span class="icon-person"></span> <?php echo $post['name']; ?></a></div>
                            <!-- <div><a href="#"><span class="icon-chat"></span> 19</a></div> -->
                        </div>
                        </div>
                    </div>
                    <?php
                }
              ?>
            </div>
          </div>

        </div>
      </div>
    </section> <!-- .section -->	
<?php

include '../inc/footer.php';