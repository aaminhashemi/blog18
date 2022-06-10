<?php

namespace Brand\Http\Controllers;

use Brand\Models\Brand;
use Category\Models\Category_brand;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index()
    {
        $brands=Brand::all();
        return response()->json([
            'status' => 200,
            'brands'=>$brands
        ]);

    }

    public function brandCategoryIndex($id)
    {
        $used_brands=Category_brand::where('category_id',$id)->pluck('brand_id')->toArray();
        $brands=Brand::whereNotIn('id',$used_brands)->get();
        return response()->json([
            'status' => 200,
            'brands'=>$brands
        ]);

    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'status' => 'required|string',
        ]);
        if ($validator->passes()) {
            Brand::create([
                'name'=>$request->name,
                'status'=>$request->status,
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

    public function find($id)
    {
        $brand=Brand::findOrFail($id);
        return response()->json([
            'status' => 200,
            'brand' => $brand
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'status' => 'required|string',
        ]);
        $brand=Brand::where('id',$id)->first();
        if ($validator->passes()) {
            $brand->update([
                'name'=>$request->name,
                'status'=>$request->status,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'ویرایش دسته با موفقیت انجام شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }
}
