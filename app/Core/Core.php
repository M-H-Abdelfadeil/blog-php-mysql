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
}