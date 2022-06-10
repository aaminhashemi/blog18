<?php

namespace Slider\Http\Controllers;

use Slider\Models\Slider;
use Slider\Repositories\SliderRepository;
use App\Classes\FileUploader;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public $repository;
    public $image_height=500;
    public $image_weight=2800;
    public $slider_dir='uploads/slider/';
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->repository=$sliderRepository;
    }
    public function index()
    {
        $sliders=Slider::all();
        return response()->json(['status'=>200,'sliders'=>$sliders]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'file' => 'required|image|mimes:jpg,bmp,png,pdf',
        ]);
        if ($validator->passes()) {
            $this->repository->saveSlider($request, $this->slider_dir, $this->image_weight , $this->image_height);
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

    public function update(Request $request,$id)
    {
        $slider=Slider::where('id',$id)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'file' => 'nullable|image|mimes:jpg,bmp,png,pdf',
        ]);
        if ($validator->passes()) {
            $this->repository->updateSlider($slider, $request, $this->slider_dir,$this->image_weight , $this->image_height);
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

    public function edit($id)
    {
        $slider=Slider::where('id',$id)->first();
        return response()->json(['status'=>200,'slider'=>$slider]);
    }

    public function delete($id)
    {
        $slider=Slider::where('id',$id)->first();
        $this->repository->deleteSlider($slider);
        return response()->json(['status' => 200]);
    }
}
