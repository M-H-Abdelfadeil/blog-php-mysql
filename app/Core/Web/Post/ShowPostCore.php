<?php
namespace App\Core\Web\Post;

use App\Core\Core;
use App\Models\PostModel;

class ShowPostCore extends Core {


    public function showToUser($postId){

        $postId= $this->filter->num_int($postId);
        $userId=$_SESSION['user']['id'];

        return  $this->model()->showToUser($postId,$userId);

    }

    public function show($postId){
        $postId= $this->filter->num_int($postId);
        return  $this->model()->show($postId);
    }


    public function postsUser($userId){

        $userId= $this->filter->num_int($userId);
        return $this->model()->postsUser($userId);

    }

    public function getUser($userId){

        $userId= $this->filter->num_int($userId);
        return $this->model()->getUser($userId);

    }

    public function index(){
        return $this->model()->index();
    }

    private function model(){
        return new PostModel;
    }




}