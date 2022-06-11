<?php

namespace Aamin\RolePermission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "required|min:3|unique:roles,name," .request()->id,
            "permissions" => "required|array|min:1"
        ];
    }
}
