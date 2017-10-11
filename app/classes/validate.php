<?php
class Validate {
    private $data;
    function __construct(){

    }

    public function string($string){        
            if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $string))
            {
                $_SESSION["statusMessage"] .= $string." : special characters are not allowed<br>"; 
                return false;
            }
            else
                return true;
    }

    public function number($number,$field="",$min=null,$max=null) {
        if(is_number($number) && is_integer($number)) {
            if($number >= $min && $number <= $max){
                return true;
            }            
            else{
                //echo "$field must be between $min and $max</br>"; 
                return $errorMessage[] = [$field => "$field must be between $min and $max"];
            }
        }
        else {
            //echo "$field is not a number </br>";
            return $errorMessage[] = [$field => "$field is not a number"];
        }
    }

    public function email($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
          }
        return false;
    }

    public function mobile($mobile){
        if (is_integer($mobile)) {
            return true;
        } else {
            $_SESSION["statusMessage"] .= $mobile." : invalid Mobile Number<br>"; 
            return false;
        }
    }

    public function place($place){
        if (Places::validate($place)){
            return true;
        }
        return false;
    }
}