<?php
namespace App\Core\Web\Post;

use App\Models\PostModel;

class RecentPostCore {

    public function recent(){
        return $this->model()->recent();
    }

    private function model (){
        return new PostModel;
    }

}