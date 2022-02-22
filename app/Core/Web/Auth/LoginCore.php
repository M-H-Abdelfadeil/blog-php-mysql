<?php
namespace App\Core\Web\Auth;

use App\Core\Core;
use App\Core\InterfaceCore;
use App\Models\AuthModel;

class LoginCore extends Core implements InterfaceCore{

    /**
     * function login You run the data verification function,
     * the validate function, and the user data verification function
     * 
     * @return array
     * 
     */

    public function login(){
        // check found data required
        if($this->notFoundDataRequestPost($this->required())){
            return[
                'status'=>false,
                'data'=>$this->notFoundDataRequestPost($this->required())
            ];
        }

        // validate 

        if($this->validate()){
            return[
                'status'=>false,
                'data'=>$this->validate()
            ];
        }

        // check email and password

        if(!$this->check()){
            return [
                'status'=>false,
                'data'=>['email'=>'It does not match any records']
            ];
        }

        return [
            'status'=>true,
            'data'=>$this->check()
        ];


    }

    /**
     * Terms of data I need 
     * 
     * @return array
     * 
     */
    public function rules()
    {

        return [
            'email'=>'required|email',
            'password'=>'required|string'
        ];  
        
    }

    /**
     * Ensure that the data is entered correctly
     * 
     * @return array
     * 
     */
    public function validate()
    {
        $this->validate->Validator($this->rules());
        return $this->validate->has_error_validate();
    }


    /**
     * request required
     * 
     * @return array
     * 
     */
    public function required()
    {
        return ['email','password'];
    }

    /**
     * the user data verification
     * 
     * @return bool
     * 
     */
    private function check(){
        $email=$this->filter->email($_POST['email']);
        $password=$this->filter->string($_POST['password']);
        return $this->model()->login($email,$password);
    }

    /**
     * Authentication Model 
     * 
     * @return \App\Models\AuthModel
     * 
     */
    private function model(){
        return new AuthModel;
    }
}