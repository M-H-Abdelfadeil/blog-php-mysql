<?php
namespace App\Controllers\Web;

use App\Core\Web\Post\ShowPostCore;
use App\Core\Web\Profile\EditPasswordCore;
use App\Core\Web\Profile\EditProfileCore;

class ProfileController {

    private $editCore ; 
    private $editPasswordCore;
    private $posts;

    public function __construct()
    {
        $this->editCore         = new EditProfileCore;
        $this->editPasswordCore = new EditPasswordCore;
        $this->posts            = new ShowPostCore;     
    }

    public function edit(){
        return $this->editCore->edit();
    }

    public function editPassword(){
        return $this->editPasswordCore->editPassword();
    }

    public function posts(){
        return $this->posts->postsUser($_SESSION['user']['id']);
    }

}