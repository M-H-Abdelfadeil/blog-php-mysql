<?php
namespace ValidatorFilterPHP;
use ValidatorFilterPHP\Validator\Validator;
use ValidatorFilterPHP\Validator\RuleValidator;
use ValidatorFilterPHP\Validator\Database;
class ValidatorPHP{
    use Validator;
    use RuleValidator;
    use Database;
    public $lang=[];

    private $errors=[];

    public function __construct(){

        $ds=DIRECTORY_SEPARATOR;
        $removeChars="vendor".$ds."mahmoud-abdelfadeil".$ds."validator-filter-php".$ds."src";
        $root= str_replace($removeChars,"",dirname(__FILE__)) ;    

        $config_file=$root.'config/validator-filter-config.php';
        if(file_exists($config_file)){
            $config=include $config_file;
            if(isset($config['lang'])){
                if($config['lang']=='ar'){
                    $this->lang=include 'Validator/lang/ar.php';
                }else{
                    $this->lang=include 'Validator/lang/en.php'; 
                }
            }
        }else{
            $this->lang=include 'Validator/lang/en.php'; 
        }

    }
    
    public function Validator($rule){
        $this->errors=$this->rule($rule);
        return $this->rule($rule);
    }

    public function has_error_validate(){
        return $this->errors;
    }
    
}