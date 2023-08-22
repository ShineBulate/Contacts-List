<?php
namespace App\Validation;

use http\Params;

trait Validation
{
    public function validate($arr)
    {
        $this->arr = $arr;
        $userName = $this->arr['user_name'];
        $userPhone = $this->arr['user_phone'];

        if (!filter_var($userName, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[а-яА-ЯёЁ\s]+$/u")))) {
            return false;
        }
        if(!filter_var($userPhone, FILTER_VALIDATE_INT)){
            return false;
        }
        return ($this->arr);


        }
}


