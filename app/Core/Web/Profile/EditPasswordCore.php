<?php
namespace App\Core\Web\Profile;

use App\Core\Core;
use App\Core\InterfaceCore;
use App\Models\ProfileModel;

class EditPasswordCore extends Core implements InterfaceCore{


    public function editPassword(){
        //Verify that all data is present

        if($this->notFoundDataRequestPost($this->required())){
            return  [
                'status'=>false,
                'data'=>$this->notFoundDataRequestPost($this->required())
            ];
        }

        if($this->validate()){
            return  [
                'status'=>false,
                'data'=>$this->validate()
            ];
        }

        // check confirm password  
        if(!$this->confirmPassword()){
            return  [
                'status'=>false,
                'data'=>['password'=>'Password does not match']
            ];
        }

        // check old password 
        if(!$this->checkOldPassword()){
            return  [
                'status'=>false,
                'data'=>['old_password'=>'Old Password Error !']
            ];
        }

        $this->setData();
        return [
            'status'=>true,
            'msg'=>'Your password has been successfully updated'
        ];



    }

    public function rules(){
        return [
            'password'=>'required|string|min_length:8',
            're_password'=>'required|string|min_length:8',
            'old_password'=>'required|string'
        ];
    }

    public function validate(){
        $this->validate->Validator($this->rules());
        return $this->validate->has_error_validate();
    }
    public function required(){
        return [
            'old_password','password','re_password'
        ];
    }

    private function setData(){
        $passowrd   = $this->filter->string($_POST['password']);
        $userId     = $_SESSION['user']['id'];
        $this->model()->editPassword($userId ,password_hash($passowrd,PASSWORD_DEFAULT));
    }

    


    private function confirmPassword(){
        if($_POST['password']!=$_POST['re_password']){
            return false;
        }else{
            return true;
        }
    }

    private function checkOldPassword(){
        $userId = $_SESSION['user']['id'];
        $oldPassword=$this->filter->string($_POST['old_password']);
        $oldPasswordHash=$this->model()->getOldPassword($userId);
        return password_verify($oldPassword,$oldPasswordHash) ? true : false;
    }

    private function model(){
        return new ProfileModel;
    }
}