<?php

namespace Attribute\Http\Controllers;

use Attribute\Model\Attribute;
use Attribute\Model\Attribute_value;
use App\Constants\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeController
{
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
        ]);
        if ($validator->passes()) {
            Attribute::create([
                'name' => $request->name
            ]);
            return response()->json([
                'status' => 200,
                'message' => Constants::Success_message
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => Constants::Data_error,
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function saveValue(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|string|min:3|max:50',
        ]);
        if ($validator->passes()) {
            Attribute_value::create([
                'attribute_id' => $id,
                'value' => $request->value
            ]);
            return response()->json([
                'status' => 200,
                'message' => Constants::Success_message
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => Constants::Data_error,
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
        ]);
        if ($validator->passes()) {
            $attribute = Attribute::where('id', $id)->first();
            $attribute->update([
                'name' => $request->name
            ]);
            return response()->json([
                'status' => 200,
                'message' => Constants::Success_message
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => Constants::Data_error,
                'validation_errors' => $validator->messages()
            ]);
        }
    }
    public function updateValue(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|string|min:3|max:50',
        ]);
        if ($validator->passes()) {
            $value = Attribute_value::where('id', $id)->first();
            $value->update([
                'value' => $request->value
            ]);
            return response()->json([
                'status' => 200,
                'message' => Constants::Success_message
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => Constants::Data_error,
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function index()
    {
        $attributes = Attribute::all();
        return response()->json([
            'status' => 200,
            'attributes' => $attributes
        ]);
    }

    public function indexValue($id)
    {
        $values = Attribute_value::where('attribute_id', $id)->get();
        return response()->json([
            'status' => 200,
            'values' => $values
        ]);
    }

    public function edit($id)
    {
        $attribute = Attribute::where('id', $id)->first();
        return response()->json([
            'status' => 200,
            'attribute' => $attribute
        ]);
    }

    public function delete($id)
    {
        $attribute = Attribute::where('id', $id)->first();
        $attribute->delete();
        return response()->json([
            'status' => 200,
            'message' => Constants::Success_message
        ]);
    }

    public function deleteValue($id)
    {
        $value = Attribute_value::where('id', $id)->first();
        $value->delete();
        return response()->json([
            'status' => 200,
            'message' => Constants::Success_message
        ]);
    }

    public function editValue($id)
    {
        $value = Attribute_value::where('id', $id)->first();
        return response()->json([
            'status' => 200,
            'value' => $value
        ]);
    }
}
