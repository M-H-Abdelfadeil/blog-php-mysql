<?php
namespace App\Controllers\Web;

use App\Core\Web\Profile\EditProfileCore;

class ProfileController {

    private $editCore ; 

    public function __construct()
    {
        $this->editCore = new EditProfileCore;
    }

    public function edit(){
        return $this->editCore->edit();
    }

}