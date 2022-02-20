<?php

echo dirname(__FILE__);
exit;
session_start();

include 'inc/app.php'; 

if(isset($_SESSION['user'])){
    redirect("../users/profile.php");
}

use App\Controllers\Web\AuthController;
 
$errors=[];
$request=[];
if(isset($_POST['submit'])){
    $auth = new AuthController;
    $register=$auth->register();
    $request=$_POST;

   var_dump( $register);
}


?>

<form action="" method="post">

    <input type="text" name="name" id="">
    <input type="text" name="email" id="">
    <input type="text" name="password" id="">
    <input type="text" name="re_password" id="">
    <input type="submit" name="submit" id="">
</form>
