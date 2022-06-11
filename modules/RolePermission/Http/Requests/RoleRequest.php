<?php

namespace RolePermission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title"=>"required|min:3|unique:roles,name",
            "permissions" =>"required|array|min:1"
        ];
    }
}
