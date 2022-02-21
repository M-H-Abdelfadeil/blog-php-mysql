<?php
namespace App\Core\Web\Post;

use App\Core\Core;
use App\Core\InterfaceCore;
use App\Models\PostModel;

class UpdatePostCore extends Core implements InterfaceCore{


    public function update($postId){
        // check data
        if($this->notFoundDataRequestPost($this->required())){
            return [
                'status'=>false,
                'data'=>$this->notFoundDataRequestPost($this->required())
            ];
        }
        // validate 
        if($this->validate()){
            return [
                'status'=>false,
                'data'=>$this->validate()
            ];
        }
        // check is upload image 
        $imgNameUpload=false;
        if(!$this->notFoundDataRequestFile('image')){
            $uploadImage=$this->uploadFile('image','../uploads/posts/images',['image/jpeg','image/png'],2);
            if(!$uploadImage['status']){
                return [
                    'status'=>false,
                    'data'=>['image'=>$uploadImage['msg']]
                ];
            }else{
                $imgNameUpload=$uploadImage['filename'];
            }
        }

        return $this->setData($postId,$imgNameUpload);
    }

    public function rules()
    {
        return [
            'title'=>'required|string|max_length:100',
            'description'=>'required|string|max_length:5000'
        ];  
    }

    public function validate()
    {
        $this->validate->Validator($this->rules());
        return $this->validate->has_error_validate();
    }

    public function required()
    {
        return ['title','description'];
    }

    private function setData($postId,$image){
        $postId         = $this->filter->num_int($postId);
        $title          = $this->filter->string($_POST['title']);
        $description    = $this->filter->string($_POST['description']);
        $this->model()->update($postId,$title,$description,$image);
        return [
            'status'=>true,
            'msg'=>'Updated successfully',
            'image'=>$image
        ];
    }


    private function model(){
        return new PostModel;
    }

    

}