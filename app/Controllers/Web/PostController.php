<?php
namespace App\Controllers\Web;

use App\Core\Web\Post\CreatePostCore ;
use App\Core\Web\Post\ShowPostCore;
use App\Core\Web\Post\UpdatePostCore;

class PostController{
    private $createCore;
    private $showCore;
    private $updateCore;
    public function __construct()
    {
        $this->createCore =     new CreatePostCore ;
        $this->showCore   =     new ShowPostCore;
        $this->updateCore =     new UpdatePostCore;   
    }

    public function create(){
        return $this->createCore->create();
    }

    public function show($postId){
        return $this->showCore->show($postId);
    }

    public function update($postId){
        return $this->updateCore->update($postId);
    }
}