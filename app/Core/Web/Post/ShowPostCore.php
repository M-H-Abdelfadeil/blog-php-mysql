<?php
namespace App\Core\Web\Post;

use App\Core\Core;
use App\Models\PostModel;

class ShowPostCore extends Core {


    public function show($postId){

        $postId= $this->filter->num_int($postId);
        $userId=$_SESSION['user']['id'];

        return  $this->model()->show($postId,$userId);

    }

    private function model(){
        return new PostModel;
    }




}