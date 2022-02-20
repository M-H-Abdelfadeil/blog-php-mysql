<?php
namespace App\Controllers\Web;

use App\Core\Web\Auth\LoginCore;
use App\Core\Web\Auth\RegisterCore;

class AuthController{
    private $registerCore;
    private $loginCore;

    public function __construct()
    {
        $this->registerCore=new RegisterCore;
        $this->loginCore = new LoginCore;
    }


    public function register(){
       
        return  $this->registerCore->register();
    }

    public function Login(){
        return $this->loginCore->login();
    }
}