<?php

namespace Uploader\Repositories;

use Uploader\Services\UploaderService;
use App\Constants\Constants;
use Image;
use File;
class UploaderRepository
{

    public static function uploader($request, $path)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(Constants::Min_number, Constants::Max_number) . '.' . $extension;
        $file->move($path, $fileName);
        return $path . $fileName;
    }

    public function resizeUploader($request, $path, $width = null, $height = null)
    {
        //UploaderService::
        $this->directionCreator($path);
        $image = $request->file('file');
        $input['file'] = time() . '.' . $image->getClientOriginalExtension();
        $imgFile = Image::make($image->getRealPath());
        $width = $this->autoAspect($image->getRealPath(), $width);
        $imgFile->resize($width, $height)->save($path . $input['file']);
        return $path . $input['file'];
    }

    public function autoAspect($file, $width)
    {
        return ($width == null) ? Image::make($file)->width() : $width;
    }


}
