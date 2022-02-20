<?php
namespace App\Controllers\Web;

use App\Core\Web\Post\CreatePostCore ;

class PostController{
    private $createCore;
    public function __construct()
    {
        $this->createCore =  new CreatePostCore ;
    }

    public function create(){
        return $this->createCore->create();
    }
}