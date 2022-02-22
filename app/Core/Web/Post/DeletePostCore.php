<?php
namespace App\Core\Web\Post;

use App\Core\Core;
use App\Models\PostModel;

class DeletePostCore extends Core{


    public function delete($postId){
        $postId =   $this->filter->num_int($postId);
        $userId =   $_SESSION['user']['id'];
        $this->model()->delete($postId,$userId);
    }

    private function model(){
        return new PostModel;   
    }
}
