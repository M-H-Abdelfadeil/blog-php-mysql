<?php
namespace App\Core\Web\Auth;
use App\Core\Core;
use App\Core\InterfaceCore;
use App\Models\AuthModel;

class RegisterCore extends Core implements InterfaceCore{

     /**
     * function register You run the data verification function,
     * the validate function, and the user data register function
     * 
     * @return array  
     * 
     */
    
    public function register(){
        
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


        // save user 
        return $this->save();
        
    }

    /**
     * Terms of data I need 
     * 
     * @return array
     * 
     */

    public function rules(){
        return [
            'name'=>'required|string|max_length:100|min_length:5',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min_length:8',
            're_password'=>'required|string|min_length:8',
        ];
    }

     /**
     * Ensure that the data is entered correctly
     * 
     * @return array
     * 
     */
    public function validate(){
        $this->validate->Validator($this->rules());
        return $this->validate->has_error_validate();
    }

    /**
     * request required
     * 
     * @return array
     * 
     */
    public function required(){
        return [
            'name','email','password','re_password'
        ];
    }

    /**
     * register data
     * 
     * @return array
     * 
     */
    private function save(){
        // filter inputs use package validate filter 

        $name       = $this->filter->string($_POST['name']);
        $email      = $this->filter->email($_POST['email']);
        $password   = $this->filter->string($_POST['password']);
        // register database
        $id= $this->model()->register($name,$email,password_hash($password,PASSWORD_DEFAULT));
        return [
            'status'=>true,
            'data'=>[
                'id'=>$id,
                'email'=>$_POST['email'],
                'name'=>$_POST['name']
            ]
        ];
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


     /**
     *  cahek  confirm Password 
     * 
     * @return bool
     * 
     */
    private function confirmPassword(){
        if($_POST['password']!=$_POST['re_password']){
            return false;
        }else{
            return true;
        }
    }


    


}