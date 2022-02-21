<?php

function old($value,$defualt=false){
    if(isset($_REQUEST[$value])){
        echo $_REQUEST[$value];
    }elseif($defualt){
        echo $defualt;
    }
}

function redirect($page){
    $header="location:".$page;
    header($header);
}

function randomString($length = 20){
    // [1-9]  ,  [a-z] , [A-Z]
    $randomString =  str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
    
    return substr($randomString , 1 , $length);
}

function deleteOldImagePost($image){
    $link = '../uploads/posts/images/'.$image;
    if(file_exists($link)){
        unlink($link);
    }
}