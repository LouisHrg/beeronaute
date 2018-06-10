<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Hourrange implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(empty($value)){
            return true;
        }
        
        $array = explode('-',$value);

        if(count($array) != 2){
            return false;
        }else{
            if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $array[0])){
                return false;
            }

            if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $array[1])){
                return false;
            }

            return true;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "L'horraire d'ouverture est incorrecte (Format heure:minute-heure-minute)";
    }
}
