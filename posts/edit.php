<?php
session_start();

if(!isset($_GET['post_id']) || !is_numeric($_GET['post_id'])){
    die ('An unexpected error occurred');
}
include '../inc/app.php';

use App\Controllers\Web\PostController;




if (!isset($_SESSION['user'])) {
    redirect("../auth/login.php");
}

$post = new PostController;
$getPost =$post->show($_GET['post_id']);
if(!$getPost){
    die ('An unexpected error occurred');
}
//  include design files 
include '../inc/head.php';
include '../inc/navbar.php';

$succes=false;

$imgUpdate=false;
if(isset($_POST['submit'])){
    
    $update=$post->update($_GET['post_id']);
    if(!$update['status']){
        $errors= $update['data'];
    }else{
        $success=$update['msg'];
        $imgUpdate=$update['image'];
    }
}


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
                        <a href="#">Edit Post
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </span>
                </p>
                <h1 class="mb-3 bread">Edit Post</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Edit Post</span>
            </div>
        </div>

        <div class="row block-9">
            <div class="col-md-12">
                <form action="" method="post" class="p-4 p-md-5 contact-form"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="title" value="<?php old('title',$getPost['title']) ?>" type="text" class="form-control  is-invalid" placeholder="Title">
                                <div class="invalid-feedback">
                                    <?php echo isset($errors['title']) ? $errors['title'] : '';?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                               <textarea name="description" id="" cols="30" rows="7" class="form-control is-invalid" placeholder="Description"><?php old('description',$getPost['description']) ?></textarea>
                                <div class="invalid-feedback">
                                    <?php echo isset($errors['description']) ? $errors['description'] : '';?>
                                </div>
                            </div>
                        </div>
                         <input name="image" id="image" type="file" onchange="readURL(this);" class="form-control d-none">

                        <div class="col-md-12">
                            <div class="form-group">
                               <label class="btn btn-success" for="image">
                                   Edit Image
                                   <i class="fa fa-picture-o"></i>
                                </label><br>
                                <div class="img-box border border-primary rounded d-inline-block">
                                     <img id="" width="400" height="400"  class="" src="<?php echo $imgUpdate ? '../uploads/posts/images/'.$imgUpdate : '../uploads/posts/images/'.$getPost['image'] ?>" alt="your image" />
                                </div>
                                
                                <div class="text-danger">
                                    <?php echo isset($errors['image']) ? $errors['image'] : '';?>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input image name="submit" type="submit" value="EDIT" class="btn btn-primary py-3 px-5">
                            </div>
                        </div>
                       

                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<?php


include '../inc/footer.php';
?>
<script>
 
        function readURL(input) {
        $('img').removeClass('d-none')
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('.img-box img').attr('src', e.target.result).width(400).height(400);
            };
            reader.readAsDataURL(input.files[0]);
        }
        }

        let notifier = new AWN({
            position : "top-right",
            durations :{
                global: 3000,
            }
        });
</script>
?>
<?php
if($success){
    ?>
        <script>
            notifier.success("<?php echo $success ?>")
        </script>
    <?php
}
if(isset($errors)){
    
    ?>
    <script>
        notifier.alert("<?php echo end($errors) ?>")
    </script>
<?php
}
 
