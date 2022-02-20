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