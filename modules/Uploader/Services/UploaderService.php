<?php

namespace Uploader\Services;
use File;
use Image;
class UploaderService
{
    public static function UploadService($request, $path, $width = null, $height = null)
    {
        self::directionCreator($path);
        $image = $request->file('file');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $imgFile = Image::make($image->getRealPath());
        $width = self::autoAspect($image->getRealPath(), $width);
        $imgFile->resize($width, $height)->save($path . $fileName);
        return $path . $fileName;
    }

    public static function directionCreator($path)
    {
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
    }

    public static function autoAspect($file, $width)
    {
        return ($width == null) ? Image::make($file)->width() : $width;
    }
}
