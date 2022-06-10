<?php


namespace Slider\Repositories;


use Product\Models\Product;
use Slider\Models\Slider;
use Uploader\Services\UploaderService;
use App\Classes\FileUploader;
use App\Constants\Constants;

class SliderRepository
{
    public function saveSlider($request, $path, $width=null , $height=null)
    {
        return Slider::create([
            'name' => $request->name,
            'address' => UploaderService::UploadService($request, $path, $width , $height),
        ]);
    }
    public function deleteSlider($slider)
    {
        return $slider->delete();
    }

    public function updateSlider($slider, $request, $path,$width=null , $height=null)
    {
        if ($request->has('file')) {
            $slider->update([
                'name' => $request->name,
                'address' => UploaderService::UploadService($request, $path, $width , $height),
            ]);
        } else {
            $slider->update([
                'name' => $request->name,
            ]);
        }

    }

}
