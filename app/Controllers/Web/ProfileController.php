<?php
namespace App\Controllers\Web;

use App\Core\Web\Profile\EditPasswordCore;
use App\Core\Web\Profile\EditProfileCore;

class ProfileController {

    private $editCore ; 
    private $editPasswordCore;

    public function __construct()
    {
        $this->editCore = new EditProfileCore;
        $this->editPasswordCore = new EditPasswordCore;
    }

    public function edit(){
        return $this->editCore->edit();
    }

    public function editPassword(){
        return $this->editPasswordCore->editPassword();
    }

}