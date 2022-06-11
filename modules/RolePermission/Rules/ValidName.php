<?php

namespace RolePermission\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidName implements Rule
{

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        return preg_match('/^[پچجحخهعغآ؟.،آفقثصضشسیبلاتنمکگوئدذرزطظژ!!ؤإأءًٌٍَُِّ\s]+$/u', $value);
    }

    public function message()
    {
        return 'فرمت نام نامعتبر است.';
    }
}
