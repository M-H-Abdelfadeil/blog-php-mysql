<?php
use App\Controllers\Web\PostController;

session_start();

include '../inc/app.php';
//  include design files 
include '../inc/head.php';
include '../inc/navbar.php';

if (!isset($_SESSION['user'])) {
    redirect("../auth/login.php");
}
$succes=false;
if(isset($_POST['submit'])){
    $post = new PostController;
    $create=$post->create();
    if(!$create['status']){
        $errors= $create['data'];
    }else{
        $success=$create['msg'];
        unset($_REQUEST);
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
                        <a href="#">Create
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </span>
                </p>
                <h1 class="mb-3 bread">Create Post</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Create Post</span>
            </div>
        </div>

        <div class="row block-9">
            <div class="col-md-12">
                <form action="" method="post" class="p-4 p-md-5 contact-form"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="title" value="<?php old('title') ?>" type="text" class="form-control  is-invalid" placeholder="Title">
                                <div class="invalid-feedback">
                                    <?php echo isset($errors['title']) ? $errors['title'] : '';?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                               <textarea name="description" id="" cols="30" rows="7" class="form-control is-invalid" placeholder="Description"><?php old('description') ?></textarea>
                                <div class="invalid-feedback">
                                    <?php echo isset($errors['description']) ? $errors['description'] : '';?>
                                </div>
                            </div>
                        </div>
                         <input name="image" id="image" type="file" onchange="readURL(this);" class="form-control d-none">

                        <div class="col-md-12">
                            <div class="form-group">
                               <label class="btn btn-success" for="image">
                                   Select Image
                                   <i class="fa fa-picture-o"></i>
                                </label><br>
                                <div class="img-box border border-primary rounded d-inline-block">
                                     <img id="" class="d-none" src="#" alt="your image" />
                                </div>
                                
                                <div class="text-danger">
                                    <?php echo isset($errors['image']) ? $errors['image'] : '';?>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input image name="submit" type="submit" value="SAVE" class="btn btn-primary py-3 px-5">
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
 
