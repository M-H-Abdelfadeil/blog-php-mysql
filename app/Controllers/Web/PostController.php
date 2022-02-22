<?php
namespace App\Controllers\Web;

use App\Core\Web\Post\CreatePostCore ;
use App\Core\Web\Post\DeletePostCore;
use App\Core\Web\Post\RecentPostCore;
use App\Core\Web\Post\ShowPostCore;
use App\Core\Web\Post\UpdatePostCore;

class PostController{
    private $createCore;
    private $showCore;
    private $updateCore;
    private $recentCore;
    private $deleteCore;
    public function __construct()
    {
        $this->createCore =     new CreatePostCore ;
        $this->showCore   =     new ShowPostCore;
        $this->updateCore =     new UpdatePostCore;
        $this->recentCore =     new RecentPostCore; 
        $this->deleteCore =     new DeletePostCore;  
    }

    public function create(){
        return $this->createCore->create();
    }

    public function showToUser($postId){
        return $this->showCore->showToUser($postId);
    }

    public function show($postId){
        return $this->showCore->show($postId);
    }

    public function update($postId){
        return $this->updateCore->update($postId);
    }

    public function recentPosts(){
        return $this->recentCore->recent();
    }

    public function postsUser($userId){
        return $this->showCore->postsUser($userId);
    }

    public function getUser($userId){
        return $this->showCore->getUser($userId);
    }

    public function delete($postId){
        $this->deleteCore->delete($postId);
    }

    public function index(){
        return $this->showCore->index();
    }
}

