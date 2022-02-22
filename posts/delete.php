<?php
session_start();

if(!isset($_GET['post_id']) || !is_numeric($_GET['post_id'])){
    die ('An unexpected error occurred');
}
if (!isset($_SESSION['user'])) {
    redirect("../auth/login.php");
}

include '../inc/app.php';

use App\Controllers\Web\PostController;
$post = new PostController;
$getPost =$post->showToUser($_GET['post_id']);
if(!$getPost){
    die ('An unexpected error occurred');
}
$post->delete($_GET['post_id']);
redirect('../users/profile.php');


