<?php
namespace App\Core\Web\Profile;

use App\Core\Core;
use App\Core\InterfaceCore;
use App\Models\ProfileModel;

class EditProfileCore extends Core implements InterfaceCore{

    public function edit(){
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
        // save user 
        $this->setData();
        return [
            'status'=>true,
            'msg'=>'Your data has been successfully updated'
        ];

    }


    public function rules()
    {
        return [
            'name'=>'required|string|max_length:100|min_length:5',
            'email'=>'required|email|unique:users,email,'.$_SESSION['user']['id']
        ];
        
    }

    public function required()
    {
        return ['name','email'];
    }

    public function validate()
    {
        $this->validate->Validator($this->rules());
        return $this->validate->has_error_validate();
    }

    private function setData(){
        $name       = $this->filter->string($_POST['name']);
        $email      = $this->filter->email($_POST['email']);
        $userId     = $_SESSION['user']['id'];
        $this->model()->edit($userId , $name , $email);

        $_SESSION['user']=[
            'id'=>$userId,
            'name'=>$name,
            'email'=>$email
        ];
    }

    private function model(){
        return new ProfileModel;
    }
}