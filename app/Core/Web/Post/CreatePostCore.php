<?php
namespace App\Core\Web\Post;

use App\Core\Core;
use App\Core\InterfaceCore;
use App\Models\PostModel;

class CreatePostCore extends Core implements InterfaceCore{

    /**
     * function create post  You run the data verification function,
     * the validate function, and the user data verification function and upload image
     * 
     * @return array
     * 
     */

    public function create(){
        // check data
        if($this->notFoundDataRequestPost($this->required())){
            return [
                'status'=>false,
                'data'=>$this->notFoundDataRequestPost($this->required())
            ];
        }
        if($this->validate()){
            return [
                'status'=>false,
                'data'=>$this->validate()
            ];
        }
        // check image 
        if($this->notFoundDataRequestFile('image')){
            return [
                'status'=>false,
                'data'=>['image'=>'The image field is required']
            ];
        }
        // check upload image
        $uploadImage=$this->uploadFile('image','../uploads/posts/images',['image/jpeg','image/png'],2);
        if(!$uploadImage['status']){
            return [
                'status'=>false,
                'data'=>['image'=>$uploadImage['msg']]
            ];
        }
        $imgNameUpload=$uploadImage['filename'];
        return $this->save($imgNameUpload);

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
            'title'=>'required|string|max_length:100',
            'description'=>'required|string|max_length:5000'
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
        return ['title','description'];
    }


    /**
     * register data post
     * 
     * @return array
     * 
     */
    private function save($imgName){
        $title = $this->filter->string($_POST['title']);
        $description=$this->filter->string($_POST['description']);
        $user_id = $_SESSION['user']['id'];
        $this->model()->create($title,$description,$imgName,$user_id);

        return [
            'status'=>true,
            'msg'=>'The post has been created successfully'
        ];
    }


     /**
     * Post Model 
     * 
     * @return \App\Models\PostModel
     * 
     */
    private function model(){
        return new PostModel;
    }
    
}