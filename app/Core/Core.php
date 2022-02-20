<?php
namespace App\Core;

use ValidatorFilterPHP\FilterPHP;
use ValidatorFilterPHP\ValidatorPHP;
abstract class Core{

    protected  $validate;
    protected $filter;
    public function __construct()
    {
        $this->validate =new ValidatorPHP();
        $this->filter=new FilterPHP;
    }

    /**
     * Check the requests to make sure all the data was sent with the rquest
     * 
     * @param   array $dataRequired 
     * 
     * @return  array
     */
    public function notFoundDataRequestPost(array $dataRequired){
        return array_diff($dataRequired,array_keys($_POST));
    }


     /**
     * Verify whether the file was sent with the request or not
     * 
     * @param   string  $filename 
     * 
     * @return  bool
     */


    protected function notFoundDataRequestFile(string $filename){
        if(!isset($_FILES[$filename])){
            
            return true;
            
        }else{
            if($_FILES[$filename]['error']==4){
                return true;
            }
            return false;
        }
    }

    /**
     * Upload files -  4 params the first is the file name and the second is the file folder
     * The third is the allowed file type and the fourth is the maximum file size MB
     * 
     * @param   string  $filename 
     * 
     * @param   string  $dir 
     * 
     * @param   array  $allowed 
     * 
     * @param   int   $maximum 
     * 
     * @return  array
     */ 


    protected  function  uploadFile(string $filename,string $dir,array $allowed , int $maximum){
        if(!isset($_FILES[$filename])){
            return [
                'status'=>false,
                'msg'=>'file not found'
            ];
        }

        $name       =$_FILES[$filename]['name']; // file name 
        $tmp_name   =$_FILES[$filename]['tmp_name']; // file temp
        $size       =$_FILES[$filename]['size']; // file size  [ byte ]
        $type       =$_FILES[$filename]['type'];
        
        $validateFile=$this->validateFile($type,$allowed,$size,$maximum);
        
        // validate size and extension
        if(!$validateFile['status']){
            return $validateFile;
        }
        
        // upload file 
        $ext=$this->getExt($name);
        $nameHash=randomString(10).time().randomString(10).'.'.$ext;
        move_uploaded_file($tmp_name,$dir.'/'.$nameHash);
        return [
            'status'=>true,
            'filename'=> $nameHash
        ];
    }

    private function validateFile(string $ext , array $allowed , int $size , int $maximum){
        if(!in_array($ext,$allowed)){
            return [
                'status'=>false,
                'msg'=>'Unsupported file'
            ];
        }
        $maximumByte = $maximum * 1024 * 1024 ;
        if($size > $maximumByte){
            return [
                'status'=>false,
                'msg'=>'The  file size is large, max '.$maximum.' MB'
            ];
        }
        return [
            'status'=>true
        ];
    }

    private function getExt($name){
        $ext        =explode('.',$name);
        return strtolower(end($ext));
    }


}