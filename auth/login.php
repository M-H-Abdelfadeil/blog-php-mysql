<?php
session_start();

include '../inc/app.php'; 

if(isset($_SESSION['user'])){
    redirect("../users/profile.php");
}


use App\Controllers\Web\AuthController;
 
$errors=[];
$request=[];
if(isset($_POST['submit'])){
    $auth = new AuthController;
    $login=$auth->login();
    $request=$_POST;
    if($login['status']==false){
        $errors=$login['data'];
    }else{
        $_SESSION['user']= $login['data'];
        redirect("../users/profile.php");
    }
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
                            <a href="#">Login
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </span>
                    </p>
					<h1 class="mb-3 bread">Login</h1>
				</div>
			</div>
		</div>
	</section>


<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Login</span>
                <h6 class="mb-4">If you do not have an account ! </h6>
                <a href="register.php"><p>Click here to create a new account</p></a>
            </div>
        </div>

        <div class="row block-9">
            <div class="col-md-12">
                <form action="" method="post" class="p-4 p-md-5 contact-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="email" value="<?php old('email') ?>" type="text" class="form-control is-invalid" placeholder="Your Email">
                                <div class="invalid-feedback">
                                    <?php echo isset($errors['email']) ? $errors['email'] : '';?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="password"  type="password" class="form-control is-invalid" placeholder="Password">
                                <div class="invalid-feedback">
                                    <?php echo isset($errors['password']) ? $errors['password'] : '';?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="submit" type="submit" value="LOGIN" class="btn btn-primary py-3 px-5">
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
